<?php

namespace App\Http\Controllers;

use App\Models\ItemAccessDetail;
use App\Http\Requests\StoreItemAccessDetailRequest;
use App\Http\Requests\UpdateItemAccessDetailRequest;

class ItemAccessUserDetailController extends Controller
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
     * @param  \App\Http\Requests\StoreItemAccessDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemAccessDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemAccessDetail  $itemAccessDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ItemAccessDetail $itemAccessDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemAccessDetail  $itemAccessDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemAccessDetail $itemAccessDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemAccessDetailRequest  $request
     * @param  \App\Models\ItemAccessDetail  $itemAccessDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemAccessDetailRequest $request, ItemAccessDetail $itemAccessDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemAccessDetail  $itemAccessDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemAccessDetail $itemAccessDetail)
    {
        //
    }
}
