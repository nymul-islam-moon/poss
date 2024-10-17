<?php

namespace App\Repositories\Services;

use App\Models\Customer;
use App\Repositories\Interfaces\CustomerServiceInterface;

class CustomerService implements CustomerServiceInterface
{
    public function get( $searchTerm ) {
        // $customers = Customer::all();


        $customers = Customer::when($searchTerm, function($query) use ($searchTerm) {
            return $query->search($searchTerm); // Call the search method
        })->get();

        return $customers;
    }

    public function store( array $data ) {
        return Customer::create($data);
    }

    public function update ( $id, array $data ) {

    }

    public function destroy ( $id ) {
        $customer = Customer::find($id);

        if ( ! $customer ) {
            return false;
        }

        $clonedCustomer = $customer->replicate();

        $customer->delete();

        return $clonedCustomer;
    }
}

