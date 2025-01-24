<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class User extends Controller
{
    public function store(UserRequest $request){
        $data = $request->validated();
    }

    public function show(UserRequest $request){
        $data = $request->validated();
    }

    public function update(UserRequest $request){
        $data = $request->validated();
    }

    public function delete(UserRequest $request){
        $data = $request->validated();
    }
}
