<?php

namespace App\Repositories\Services;

use App\Models\Job;
use App\Repositories\Interfaces\JobServiceInterface;

class JobService implements JobServiceInterface
{
    public function get( $searchTerm ) {

        $jobs = Job::when( $searchTerm, function ( $query ) use ( $searchTerm ) {
            return $query->search( $searchTerm );
        })->get();

        return $jobs;
    }

    public function store( array $data ) {
        return Job::create( $data );
    }

    public function update( $job, array $data ) {
        $job = Job::findOrFail( $job );
        if ( ! $job ) {
            return false;
        }

        $job->update( $data );

        return $job;
    }

    public function destroy( $id ) {
        $job = Job::find( $id );

        if (! $job ) {
            return false;
        }

        $clonedJob = $job->replicate();

        $job->delete( $id );

        return $clonedJob;
    }
}
