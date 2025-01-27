<?php

namespace App\Repositories\Interface;

interface CustomerContract
{
    public function all(int $active);
    public function create(array $data);
    public function update(array $data, int $id);
    public function findCustomer(int $id);
    public function delete(int $id);

}