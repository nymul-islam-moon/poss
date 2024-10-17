<?php

namespace App\Repositories\Interfaces;

interface BaseServiceInterface
{
    public function get( string $searchTerm );

    public function store( array $data );

    public function update( int $id, array $data );

    public function destroy( int $id );
}
