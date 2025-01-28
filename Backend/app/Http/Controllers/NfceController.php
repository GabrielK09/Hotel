<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NfceController extends Controller
{
    protected $nfceService;

    public function __construct(NfceService $nfceService){
        $this->nfceService = $nfceService;
    }

    public function getAll(){
        return $this->nfceService->getAll();
    }

    public function store(NfceRequest $request){
        $data = $request->validated();
        return $this->nfceService->store($data);
    }

    public function findByID(int $id){
        return $this->nfceService->findByID();
    }

    public function update(NfceRequest $request, int $id){
        $data = $request->validated();
        return $this->nfceService->update($data, $id);
    }

    public function delete(int $id){
        return $this->nfceService->delete($id);
    }
}
