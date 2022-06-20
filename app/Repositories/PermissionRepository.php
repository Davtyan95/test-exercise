<?php

namespace App\Repositories;

use App\Interfaces\PermissionInterface;
use App\Models\Permission;
use Illuminate\Support\Facades\Cache;

class PermissionRepository implements PermissionInterface
{
    private Permission $model;

    private string $keyName = 'permissions';

    public function __construct(Permission $permission)
    {
        $this->model = $permission;
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
