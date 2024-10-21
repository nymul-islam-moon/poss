<?php

namespace App\Repositories\Services;

use App\Models\Department;
use App\Repositories\Interfaces\DepartmentServiceInterface;

class DepartmentService implements DepartmentServiceInterface
{
    public function get( $searchTerm ) {
        
        $departments = Department::when( $searchTerm, function ( $query ) use ( $searchTerm ) {
            return $query->search( $searchTerm );
        })->get();

        return $departments;
    }

    public function store( array $data ) {
        return Department::create( $data );
    }

    public function update( $department, array $data ) {
        $department = Department::find( $department );

        if ( ! $department ) {
            return false;
        }

        $department->update( $data );

        return $department;
    }

    public function destroy( $id ) {
        $department = Department::find( $id );

        if (! $department ) {
            return false;
        }

        $clonedDepartment = $department->replicate();

        $department->delete( $id );

        return $clonedDepartment;
    }
}
