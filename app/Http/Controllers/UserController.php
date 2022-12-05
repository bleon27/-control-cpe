<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', ['roles' => $roles]);
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        if (request()->ajax()) {
            $user = User::create($data);
            return response()->json(['message' => 'Usuario creado con éxito']);
        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        if (request()->ajax()) {
            $user->update($request->validated());
            return response()->json(['message' => 'Actialización exitosa']);
        }
    }
}
