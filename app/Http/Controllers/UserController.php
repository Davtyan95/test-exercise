<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $search = $request->search;
        $query = User::select('id', 'name', 'created_at')->where('id', '!=', auth()->id());

        if ($search) {
            $query->where('name', 'like', "$search%");
        }

        $users = $query->with('roles')->orderBy('name')->get();

        return view('user.index', compact('users', 'search'));
    }
}
