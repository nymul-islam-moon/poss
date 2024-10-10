<?php

namespace App\Http\Controllers\Api\V1\HRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreEmployeeRequest;
use App\Http\Requests\Api\V1\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employee = User::all();

        return EmployeeResource::collection($employee);
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
    public function store(StoreEmployeeRequest $request)
    {
        $formData = $request->validated();

        $employee = User::create($formData);

        return new EmployeeResource($employee);

    }

    /**
     * Display the specified resource.
     */
    public function show(User $employee)
    {
        // Return the employee resource
        return new EmployeeResource($employee);
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
    public function update(UpdateEmployeeRequest $request,User $employee)
    {
        $formData = $request->validated();

        if (isset($formData['password'])) {
            $formData['password'] = bcrypt($formData['password']);
        } else {
            unset($formData['password']);
        }

        $employee->update($formData);

        return new EmployeeResource($employee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $employee)
    {
        $deletedEmployee = $employee->replicate();

        $employee->delete();

        return response()->json([
            'message' => 'Employee deleted successfully.',
            'data' => new EmployeeResource($deletedEmployee),
        ], Response::HTTP_OK);
    }
}
