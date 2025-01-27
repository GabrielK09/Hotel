<?php

namespace App\Repositories\Interface;

interface CustomerContract
{
    public function all(int $active);

}