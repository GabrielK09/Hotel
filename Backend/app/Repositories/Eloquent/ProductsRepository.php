<?php

namespace App\Repositories\Eloquent;

use App\Models\Products;

class ProductsRepository
{
    public function getAll(int $active){
        return Products::where('active', $active)->get();
    }

    public function search(int $active, string $params, int $id){
        return Products::where('active', $active)
                       ->where(function ($query) use ($params, $id) {
                           $query->where('name', 'like', '%' . $params . '%')
                                 ->orWhere('id', $id);
                       })
                       ->limit(10)
                       ->get();
    }

    public function findByID(int $id){
        return Products::where('id', $id)->first();
    }

    public function store(array $data){
        return Products::create($data);
    }

    public function update(array $data, int $id){
        return Products::where('id', $id)->update($data, $id);
    }

    public function delete(int $id){
        return Products::where('id', $id)->update([
            'active' => 0,
        ]);
    }
}