<?php

namespace App\Repositories;

use App\Interfaces\RoleInterface;
use App\Models\Role;
use Illuminate\Support\Facades\Cache;

class RoleRepository implements RoleInterface
{
    private Role $model;

    private string $keyName = 'roles';

    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes): mixed
    {
        $data = $this->model::create($attributes);

        Cache::forget($this->keyName);

        return $data;

    }

    /**
     * @return mixed
     */
    public function all(): mixed
    {
        return Cache::rememberForever($this->keyName, function () {
            return $this->model::select('id', 'name')->orderBy('name')->get();
        });
    }
}
