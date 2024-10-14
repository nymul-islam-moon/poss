<?php

namespace App\Repositories\Interface;

interface CustomerServiceInterface
{
    public function get();

    public function store( array $data );

    public function destroy( int $id );
}
