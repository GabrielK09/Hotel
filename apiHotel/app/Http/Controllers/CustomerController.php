<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Service\CustomerService;

class CustomerController extends Controller
{
    protected $customerService;
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function allCustomers()
    {
        return $this->customerService->all(1);
    }

    public function create(CustomerRequest $request)
    {
        $data = $request->validated();
        return $this->customerService->create($data);
        
    }
}
