<?php

namespace App\Repositories\Services;

use App\Models\Customer;
use App\Repositories\Interface\CustomerServiceInterface;

class CustomerService implements CustomerServiceInterface
{
    public function get() {
        $customers = Customer::all();

        return $customers;
    }

    public function store( array $data ) {
        return Customer::create($data);
    }
}

