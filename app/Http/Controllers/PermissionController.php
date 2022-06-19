<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::select('id', 'name')->orderBy('name')->get();

        return view('permission.index', compact('permissions'));
    }
}
