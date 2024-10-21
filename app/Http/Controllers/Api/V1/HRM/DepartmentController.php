<?php

namespace App\Http\Controllers\Api\V1\HRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreDepartmentRequest;
use App\Http\Requests\Api\V1\UpdateDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Repositories\Interfaces\DepartmentServiceInterface;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    protected $departmentService;

    public function __construct(DepartmentServiceInterface $departmentService) 
    {
        $this->departmentService = $departmentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        $departments = $this->departmentService->get($searchTerm);

        return DepartmentResource::collection($departments);
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
    public function store(StoreDepartmentRequest $request)
    {
        $formData = $request->validated();

        try {
            $department = $this->departmentService->store($formData);
        } catch ( \Exception $e ) {
            return response()->json([
                'error' => 'Failed to create department.',
                'message' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => 'Department created successfully',
            'data' => $department,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $department)
    {
        return new DepartmentResource($department);
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
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $formData = $request->validated();

        try {
            $updatedDepartment = $this->departmentService->update($department->id, $formData);
        } catch ( \Exception $e ) {
            return response()->json([
                'error' => 'Failed to update department.',
               'message' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
           'message' => 'Department updated successfully.',
            'data' => $updatedDepartment,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $destroyedDepartment = $this->departmentService->destroy( $id );
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete department.',
               'message' => $e->getMessage(),
            ], 400);
        }

        return response()->json([
            'message' => 'Department deleted successfully.',
            'data' => $destroyedDepartment,
        ], 200);
    }
}
