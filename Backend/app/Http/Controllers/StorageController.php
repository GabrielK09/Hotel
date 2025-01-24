<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorageRequest;
use Illuminate\Http\Request;

class Storage extends Controller
{
    public function store(StorageRequest $request){
        $data = $request->validated();
    }

    public function show(StorageRequest $request){
        $data = $request->validated();
    }

    public function update(StorageRequest $request){
        $data = $request->validated();
    }

    public function delete(StorageRequest $request){
        $data = $request->validated();
    }
}
