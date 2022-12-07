<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\DataTables\ItemsDataTable;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Imports\ItemsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:item-list|item-create|item-edit|item-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:item-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:item-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:item-delete', ['only' => ['destroy']]);
    }
    public function index(ItemsDataTable $dataTable)
    {
        return $dataTable->render('admin.items.index');
    }

    public function create()
    {
        $estados = ['Bueno', 'Regular', 'Malo'];
        return view('admin.items.create', ['estados' => $estados]);
    }

    public function store(StoreItemRequest $request)
    {
        if (request()->ajax()) {
            $item = Item::create($request->validated());
            return response()->json(['message' => 'Item registrado con éxito']);
        }
    }

    public function show(Item $item)
    {
        //
    }

    public function edit(Item $item)
    {
        $estados = ['Bueno', 'Regular', 'Malo'];
        return view('admin.items.edit', ['item' => $item, 'estados' => $estados]);
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        //if (request()->ajax()) {
        $item->update($request->validated());
        return response()->json(['message' => 'Ítem Actualizado con éxito']);
        //}
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return response()->json(['message' => 'Ítem eliminado con éxito']);
    }

    public function import(Request $request)
    {
        if (request()->ajax()) {
            Excel::import(new ItemsImport, $request->file('file')->store('files'));
            return redirect()->back();
        }
    }
}
