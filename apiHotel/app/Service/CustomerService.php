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
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
                'line' => $th->getLine()

            ]);
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
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
                'line' => $th->getLine()

            ]);
        }
    }

    public function update(array $data, int $id)
    {
        try {
            $this->customerRepository->update($data, $id);
            
            return response()->json([
               'success' => true

            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
                'line' => $th->getLine()

            ]);
        }
    }

    public function findCustomer(int $id)
    {
        try {
            
            return response()->json([
                'success' => true,
                'customer' => $this->customerRepository->findCustomer($id)

            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
                'line' => $th->getLine()

            ]);
        }
    }

    public function delete(int $id)
    {
        try {
            $this->customerRepository->delete($id);
            return response()->json([
                'success' => true,
                'customer' => $this->customerRepository->findCustomer($id)

            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
                'line' => $th->getLine()

            ]);
        }
    }
}