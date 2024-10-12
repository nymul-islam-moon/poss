<?php

namespace App\Repositories\Interface;

interface CustomerServiceInterface
{
    public function get();

    public function store( array $data );
}
