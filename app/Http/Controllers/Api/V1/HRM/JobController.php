<?php

namespace App\Http\Controllers\Api\V1\HRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreJobRequest;
use App\Http\Requests\Api\V1\UpdateJobRequest;
use App\Http\Resources\JobsResource;
use App\Models\Job;
use App\Repositories\Interfaces\JobServiceInterface;
use Illuminate\Http\Request;

class JobController extends Controller
{

    protected $jobService;

    public function __construct(JobServiceInterface $jobService)
    {
        $this->jobService = $jobService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        $jobs = $this->jobService->get($searchTerm);

        return JobsResource::collection($jobs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        $formData = $request->validated();

        try {
            $job = $this->jobService->store($formData);
        } catch ( \Exception $e ) {
            return response()->json([
                'error' => 'Failed to create department.',
                'message' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => 'Job created successfully',
            'data' => $job,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        $formData = $request->validated();

        try {
            $updatedJob = $this->jobService->update($job->id, $formData);
        } catch ( \Exception $e ) {
            return response()->json([
                'error' => 'Failed to update job.',
               'message' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
           'message' => 'Job updated successfully.',
            'data' => $updatedJob,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id )
    {
        try {
            $destroyedJob = $this->jobService->destroy( $id );
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete job.',
               'message' => $e->getMessage(),
            ], 400);
        }

        return response()->json([
            'message' => 'Job deleted successfully.',
            'data' => $destroyedJob,
        ], 200);
    }
}
