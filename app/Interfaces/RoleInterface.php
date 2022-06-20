<?php

namespace App\Interfaces;

interface RoleInterface
{
    public function create(array $attributes);

    public function all();
}
