<?php

namespace App\Repositories\Eloquent;

use App\Models\User;

class UserRepository
{
    public function getAll(int $active){
        return User::where('active', $active)->get();
    }

    public function findByID(int $id){
        return User::where('id', $id)->first();
    }

    public function store(array $data){
        return User::create($data);
    }

    public function update(array $data, int $id){
        return User::where('id', $id)->update($data, $id);
    }

    public function delete(int $id){
        return User::where('id', $id)->update([
            'active' => 0,
        ]);
    }
}