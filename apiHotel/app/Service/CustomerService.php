<?php

namespace App\Service;

use App\Repositories\Eloquent\CustomerRepository;

class CustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;

    }

    public function all(int $active)
    {
        try {
            return response()->json([
                'success' => true,
                'all' => $this->customerRepository->all($active)

            ], 200);

        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function create(array $data)
    {
        try {
            $this->customerRepository->create($data);
            
            return response()->json([
               'success' => true

            ], 201);

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}