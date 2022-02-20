<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Inertia\Inertia;
use Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::query()
        ->when(Request::input('search'), function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })
        ->paginate(6)
        ->withQueryString()
        ->through(fn($user) => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => 'https://i.pravatar.cc/150?u='.$user->email,
            'role' => 'user',
            'joint' => $user->created_at,
            'can' => [
                'edit' => Auth::user()->can('edit', $user)
            ]
            ]);
        return Inertia::render('Users/Index', [
            'users' => $users,

            'filters' => Request::only(['search']),
            'can' => [
                'createUser' => Auth::user()->can('create', User::class)
            ]
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store()
    {
        $attributes = Request::validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        User::create($attributes);

        return redirect('/users');
    }
    public function edit($id, User $user)
    {
        $user = User::where('id',$id)->first();
        // return $user;
        return Inertia::render('Users/Edit', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                // 'password' => $user->password,
            ],
        ]);
    }
    public function update()
    {
        $attributes = Request::validate([
            'id' => 'required',
            'name' => 'required',
            'email' => ['required', 'email'],
            // 'password' => 'sometimes',
        ]);
        // return $attributes['id'];

        $user = User::findOrFail($attributes['id']);
        $user->update([
            'name' => $attributes['name'],
            'email' => $attributes['email']
        ]);

        return redirect('/users')->with(['success' => true, 'message'=>'User updated.']);
    }
}
