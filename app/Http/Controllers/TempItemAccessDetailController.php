<?php

namespace App\Http\Controllers;

use App\Models\TempItemAccessDetail;
use App\Http\Requests\StoreTempItemAccessDetailRequest;
use App\Http\Requests\UpdateTempItemAccessDetailRequest;

class TempItemAccessDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTempItemAccessDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTempItemAccessDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TempItemAccessDetail  $tempItemAccessDetail
     * @return \Illuminate\Http\Response
     */
    public function show(TempItemAccessDetail $tempItemAccessDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TempItemAccessDetail  $tempItemAccessDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(TempItemAccessDetail $tempItemAccessDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTempItemAccessDetailRequest  $request
     * @param  \App\Models\TempItemAccessDetail  $tempItemAccessDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTempItemAccessDetailRequest $request, TempItemAccessDetail $tempItemAccessDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TempItemAccessDetail  $tempItemAccessDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(TempItemAccessDetail $tempItemAccessDetail)
    {
        //
    }
}
