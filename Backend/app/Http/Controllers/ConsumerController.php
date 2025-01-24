<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConsumerRequest;
use App\Models\Consumer;
use App\Services\ConsumerService;
use Illuminate\Http\Request;

class Consumers extends Controller
{
    protected $consumerService;

    public function __construct(ConsumerService $consumerService){
        $this->consumerService = $consumerService;
    }

    public function getAll(){
        return $this->consumerService->getAll();
    }

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
