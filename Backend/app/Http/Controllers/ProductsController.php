<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsRequest;
use App\Services\ProductsService;

class ProductsController extends Controller
{
    protected $productsService;

    public function __construct(ProductsService $productsService){
        $this->productsService = $productsService;
    }

    public function getAll(){
        return $this->productsService->getAll();
    }

    public function search(int $active, string $params, int $id){
        return $this->productsService->search($active, $params, $id);
    }

    public function store(ProductsRequest $request){
        $data = $request->validated();
        return $this->productsService->store($data);
    }

    public function findByID(int $id){
        return $this->productsService->findByID($id);
    }

    public function update(ProductsRequest $request, int $id){
        $data = $request->validated();
        return $this->productsService->update($data, $id);
    }

    public function delete(int $id){
        return $this->productsService->delete($id);
    }
}
