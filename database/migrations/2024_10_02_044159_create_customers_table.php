<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('address_line1');
            $table->string('address_line2')->nullable();
            $table->string('postal_code');
            $table->string('city_corporation')->nullable();
            $table->string('upazila')->nullable();
            $table->string('zillah');
            $table->string('district');
            $table->string('country');
            $table->timestamp('data_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
