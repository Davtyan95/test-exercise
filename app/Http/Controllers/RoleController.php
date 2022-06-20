<?php

namespace App\Http\Controllers;

use App\Interfaces\RoleInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class RoleController extends Controller
{
    private RoleInterface $role;

    public function __construct(RoleInterface $role)
    {
        $this->role = $role;
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $roles = $this->role->all();

        return view('role.index', compact('roles'));
    }
}
