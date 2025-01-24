<?php

namespace App\Repositories\Eloquent;

use App\Models\Consumer;

class ConsumerRepository
{
    public function getAll(int $active){ 
        return Consumer::where('active', $active)->get();
    }

    public function findByID(int $id){
        return Consumer::where('id', $id)->first();
    }

    public function store(array $data){
        return Consumer::create($data);
    }

    public function show(int $id){
        return Consumer::where('id', $id)->first();
    }

    public function update(array $data, int $id){
        return Consumer::where('id', $id)->update($data);
    }

    public function delete(int $id){
        return Consumer::where('id', $id)->update([
            'active' => 0,
        ]);
    }
}