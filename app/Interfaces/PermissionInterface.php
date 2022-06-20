<?php

namespace App\Interfaces;

interface PermissionInterface
{
    public function create(array $attributes);

    public function all();
}
