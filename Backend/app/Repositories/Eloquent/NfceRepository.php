<?php

namespace App\Repositories\Eloquent;

class NfceRepository
{
    public function getAll(int $active){
        return Nfce::where('active', $active)->get();
    }

    public function findByID(int $id){
        return Nfce::where('id', $id)->first();
    }

    public function store(array $data){
        return Nfce::create($data);
    }

    public function update(array $data, int $id){
        return Nfce::where('id', $id)->update($data, $id);
    }

    public function delete(int $id){
        return Nfce::where('id', $id)->update([
            'active' => 0,
        ]);
    }

}