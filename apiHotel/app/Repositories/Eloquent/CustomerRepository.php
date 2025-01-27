<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interface\CustomerContract;
use App\Models\Customer;

class CustomerRepository implements CustomerContract
{
    public function all(int $active)
    {
        return Customer::where('active', $active)->get();

    }

    public function create(array $data)
    {
        return Customer::create($data);
        
    }

}