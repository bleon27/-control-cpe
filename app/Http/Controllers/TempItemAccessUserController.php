<?php

namespace App\Http\Controllers;

use App\Models\TempItemAccessUser;
use App\Http\Requests\StoreTempItemAccessUserRequest;
use App\Http\Requests\UpdateTempItemAccessUserRequest;

class TempItemAccessUserController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreTempItemAccessUserRequest $request)
    {
        TempItemAccessUser::create($request->validated());
        return response()->json(['message' => 'Ítem agregado']);
    }

    public function show(TempItemAccessUser $tempItemAccessUser)
    {
        //
    }

    public function edit(TempItemAccessUser $tempItemAccessUser)
    {
        //
    }

    public function update(UpdateTempItemAccessUserRequest $request, TempItemAccessUser $tempItemAccessUser)
    {
        //
    }

    public function destroy(TempItemAccessUser $tempItemAccessUser)
    {
        //dd('sdfds');
        $tempItemAccessUser->delete();
        return response()->json(['message' => 'Ítem eliminado con éxito']);
    }
}
