<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository with service and interface in app repositories directory';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the name of the repository
        $name = $this->argument('name');

        $servicePath = app_path("Repositories/Services/{$name}Service.php");
        $interfacePath = app_path("Repositories/Interfaces/{$name}ServiceInterface.php");

        if (!File::exists(app_path('Repositories/Interfaces')) && !File::exists(app_path('Repositories/Services'))) {
            File::makeDirectory(app_path('Repositories/Interfaces'));
            File::makeDirectory(app_path('Repositories/Services'));
        }

        if ( File::exists( $servicePath ) ) {
            $this->error( "Service for $name already exists." );
            return;
        }

        if ( File::exists( $interfacePath ) ) {
            $this->error( "Interface for $name already exists." );
            return;
        }

        // Interface content
        $interfaceContent = "<?php\n\n";
        $interfaceContent .= "namespace App\Repositories\Interface;\n\n";
        $interfaceContent .= "interface {$name}ServiceInterface extends BaseServiceInterface\n{\n";
        $interfaceContent .= "    // Define your methods here\n";
        $interfaceContent .= "}\n";

        
        $serviceContent = "<?php\n\n";
        $serviceContent .= "namespace App\Repositories\Services;\n\n";
        $serviceContent .= "use App\Repositories\Interface\\{$name}ServiceInterface;\n\n";
        $serviceContent .= "class {$name}Service implements {$name}ServiceInterface\n{\n";
        $serviceContent .= "    // Define your methods here\n";
        $serviceContent .= "}\n";

        File::put($interfacePath, $interfaceContent);
        File::put($servicePath, $serviceContent);

        $this->info("{$name}ServiceInterface created successfully: {$servicePath}");
        $this->info("{$name}Interface created successfully: {$interfacePath}");

    }
}
