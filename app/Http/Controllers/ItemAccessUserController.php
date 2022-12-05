<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\TempItemAccessUser;
use App\DataTables\ItemAccessUsersDataTable;
use App\DataTables\TempItemsAccessUsersDataTable;
use App\Http\Requests\StoreItemUsersRequest;
use App\Http\Requests\UpdateItemUsersRequest;
use Illuminate\Http\Request;
use URL;
use DataTables;

class ItemAccessUserController extends Controller
{
    public function index(ItemAccessUsersDataTable $dataTable)
    {
        return $dataTable->render('admin.itemAccessUser.index');
    }

    public function create(TempItemsAccessUsersDataTable $dataTable)
    {
        return view('admin.itemAccessUser.create');
    }

    public function ajaxCreateItem(Request $request)
    {
        $items = Item::query();

        return DataTables::eloquent($items)
            ->addColumn('actions', function ($item) {
                $str = "<button class='btn btn-success btn-sm btn-assign'";
                $str .= "title='Asignar'><i class='fa-solid fa-plus'></i></button>";
                return $str;
            })
            ->setRowId('id')
            ->setRowClass(function ($item) use ($request) {
                foreach ($request->accessUser as $key => $value) {
                    $tempItemAccessUser = TempItemAccessUser::where('item_id', $item->id)
                        ->where('access_user_id', $request->accessUser);
                    if ($tempItemAccessUser->exists()) {
                        return 'selected';
                    }
                }
                return '';
            })
            ->setRowAttr(['data-id' => '{{$id}}'])
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function ajaxCreateTemp($accessUser)
    {
        $item = new Item;
        $itemTemp = new TempItemAccessUser;
        $tableItemp = $item->getTable();
        $tableTemp = $itemTemp->getTable();
        $itemTemp = $itemTemp->join($tableItemp, "$tableItemp.id", "$tableTemp.item_id")
            ->where('access_user_id', $accessUser)
            ->select(["$tableTemp.id", 'name', 'brand', 'model', 'serie', 'cne_code', 'processor', 'ram', 'disk', 'state'])
            ->newQuery();

        return DataTables::eloquent($itemTemp)
            ->addColumn('actions', function ($itemTemp) {
                //$urlShow = URL::route('item.show', $item->id);
                $urlDestroy = URL::route('tempItems.destroy', $itemTemp->id);
                $str = '<div class="btn-group">';
                $str .= "<a class='btn btn-danger btn-sm delete-item' href='$urlDestroy' title='Eliminar'><i class='fa-solid fa-xmark'></i></a>";
                $str .= '</div>';
                return $str;
            })
            ->setRowId('id')
            ->rawColumns(['actions'])
            ->toJson();
    }

    /*public function store(StoreItemUsersRequest $request)
    {
    if (request()->ajax()) {
    $item = Item::create($request->validated());
    return response()->json(['message' => 'Item registrado con éxito']);
    }
    }*/

    public function show(Item $item)
    {
        //
    }

    public function edit(Item $item)
    {
        $estados = ['Bueno', 'Regular', 'Malo'];
        return view('admin.itemAccessUser.edit', ['item' => $item, 'estados' => $estados]);
    }

    /*public function update(UpdateItemUsersRequest $request, Item $item)
    {
    //if (request()->ajax()) {
    $item->update($request->validated());
    return response()->json(['message' => 'Ítem Actualizado con éxito']);
    //}
    }*/

    public function destroy(Item $item)
    {
        $item->delete();
        return response()->json(['message' => 'Ítem eliminado con éxito']);
    }
}
