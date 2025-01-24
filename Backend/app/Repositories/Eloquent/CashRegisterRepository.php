<?php

namespace App\Repositories\Eloquent;

use App\Models\CashRegister;
use Illuminate\Support\Facades\Hash;

class CashRegisterRepository
{
    public function getAll(int $active){ 
        return CashRegister::where('active', $active)->get();
    }

    public function findByID(int $id){
        return CashRegister::where('id', $id)->first();
    }

    public function store(array $data){
        return CashRegister::create($data);
    }

    public function update(array $data, int $id){
        return CashRegister::where('id', $id)->update($data);
    }

    public function delete(int $id){
        return CashRegister::where('id', $id)->update([
            'active' => 0,
        ]);
    }
}
