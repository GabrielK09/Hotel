<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConsumerRequest;
use Illuminate\Http\Request;

class Consumers extends Controller
{
    public function store(ConsumerRequest $request){
        $data = $request->validated();
    }

    public function show(ConsumerRequest $request){
        $data = $request->validated();
    }

    public function update(ConsumerRequest $request){
        $data = $request->validated();
    }

    public function delete(ConsumerRequest $request){
        $data = $request->validated();
    }
}
