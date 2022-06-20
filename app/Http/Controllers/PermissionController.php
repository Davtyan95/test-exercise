<?php

namespace App\Http\Controllers;

use App\Interfaces\PermissionInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PermissionController extends Controller
{
    private PermissionInterface $permission;

    public function __construct(PermissionInterface $permission)
    {
        $this->permission = $permission;
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $permissions = $this->permission->all();

        return view('permission.index', compact('permissions'));
    }
}
