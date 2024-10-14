<?php

namespace App\Http\Controllers\Api\V1\CRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Repositories\Interface\CustomerServiceInterface;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    protected $customerService;

    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(Request $request)
    {
        $customers = $this->customerService->get();
        return CustomerResource::collection($customers);
    }


    /**
     * Store a newly created customer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCustomerRequest $request)
    {

        $formData = $request->validated();

        try {
            $customer = $this->customerService->store($formData);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating customer.',
                'errors' => [$e->getMessage()]
            ], 400);
        }
    
        return response()->json([
            'message' => 'Customer created successfully!',
            'data'    => $customer,
        ], 201);
    }
}
