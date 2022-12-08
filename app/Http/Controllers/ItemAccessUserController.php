<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\TempItemAccessUser;
use App\Models\ItemAccessUser;
use App\Models\ItemAccessUserDetail;
use App\DataTables\ItemAccessUsersDataTable;
use App\DataTables\TempItemsAccessUsersDataTable;
use App\Http\Requests\StoreItemUsersRequest;
use App\Http\Requests\UpdateItemAccessUserRequest;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use URL;
use DB;
use DataTables;
use Carbon\Carbon;

class ItemAccessUserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:item-access-list|item-access-create|item-access-edit|item-access-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:item-access-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:item-access-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:item-access-delete', ['only' => ['destroy']]);
    }

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
            })->editColumn('amount', function ($item) use ($request) {
            $tempItemAccessUser = TempItemAccessUser::where('item_id', $item->id)
                ->where('user_id', auth()->user()->id)
                ->where('access_user_id', $request->accessUser)->first();
            $str = '';
            if (!is_null($tempItemAccessUser)) {
                $str = '<input type="text" class="form-control cantidad" id="floatingInput" placeholder="1" value="' . $tempItemAccessUser->amount . '">';
            } else {
                $str = '<input type="text" class="form-control cantidad" id="floatingInput" placeholder="1" value="1">';
            }
            return $str;
        })
            ->setRowId('id')
            ->setRowClass(function ($item) use ($request) {
                foreach ($request->accessUser as $key => $value) {
                    $tempItemAccessUser = TempItemAccessUser::where('item_id', $item->id)
                        ->where('user_id', auth()->user()->id)
                        ->where('access_user_id', $request->accessUser);
                    if ($tempItemAccessUser->exists()) {
                        return 'selected';
                    }
                }
                return '';
            })
            ->setRowAttr(['data-id' => '{{$id}}'])
            ->rawColumns(['actions', 'amount'])
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
            ->select(["$tableTemp.id", 'name', 'brand', 'model', 'serie', 'cne_code', 'processor', 'ram', 'disk', 'state', "$tableTemp.amount"])
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

    public function store(StoreItemUsersRequest $request)
    {
        if (request()->ajax()) {
            $items = new Item;
            $itemsTable = $items->getTable();
            $tempItemAccessUser = new TempItemAccessUser;
            $tempItemAccessUserTable = $tempItemAccessUser->getTable();
            $tempItemAccessUser = $tempItemAccessUser->where('user_id', auth()->user()->id)
                ->where('access_user_id', $request->access_user_id);

            $tempStore = $tempItemAccessUser->join("$itemsTable", "$tempItemAccessUserTable.item_id", "$itemsTable.id")
                ->select([
                    "$tempItemAccessUserTable.amount",
                    'user_id',
                    'item_id',
                    'access_user_id',
                    'name',
                    'brand',
                    'model',
                    'serie',
                    'cne_code',
                    'processor',
                    'ram',
                    'disk',
                    'state'
                ])
                ->get();

            DB::transaction(function () use ($request, $tempStore, $tempItemAccessUser) {

                $itemAccess = ItemAccessUser::create([
                    'status' => '',
                    'access_user_id' => $request->access_user_id,
                    'observation' => $request->observation,
                    'user_id' => auth()->user()->id,
                    'assigned_at' => Carbon::now(),
                ]);

                foreach ($tempStore as $key => $value) {
                    $itemAccessDetail = ItemAccessUserDetail::create([
                        'name' => $value->name,
                        'brand' => $value->brand,
                        'model' => $value->model,
                        'serie' => $value->serie,
                        'cne_code' => $value->cne_code,
                        'processor' => $value->processor,
                        'ram' => $value->ram,
                        'disk' => $value->disk,
                        'type' => $value->type,
                        'amount' => $value->amount,
                        'state' => $value->state,
                        'item_id' => $value->item_id,
                        'item_access_user_id' => $itemAccess->id,
                    ]);
                }

                $tempItemAccessUser->delete();

                return response()->json(['message' => 'Asignación Exitosa']);
            }, 5);
        }
        return response()->json(['message' => 'Acceso denegado']);
    }

    public function show(ItemAccessUser $item)
    {
        //
    }

    public function exportAssignment(ItemAccessUser $itemAccessUser)
    {
        set_time_limit(0);
        ini_set("memory_limit", -1);
        ini_set('max_execution_time', 0);

        $fecha = Carbon::now();
        $fechaTexto = $fecha->formatLocalized('%d del mes de %B del %Y');
        $user = $itemAccessUser->user;
        $accessUser = $itemAccessUser->accessUser;

        $header = view::make('admin.itemAccessUser.pdf.asigned.header')->render();

        $pdf = SnappyPdf::loadView('admin.itemAccessUser.pdf.asigned.index', ['itemAccessUser' => $itemAccessUser, 'accessUser' => $accessUser, 'user' => $user, 'fechaTexto' => $fechaTexto])
            ->setPaper('a4')
            ->setOption('margin-top', '3.5cm')
            ->setOption('margin-bottom', '2.5cm')
            ->setOption('margin-left', '2cm')
            ->setOption('margin-right', '2cm')
            ->setOption('header-html', $header);
        return $pdf->inline('Control Acceso.pdf');
    }

    public function edit(ItemAccessUser $item)
    {
        //
    }

    public function update(UpdateItemAccessUserRequest $request, ItemAccessUser $itemAccessUser)
    {
        if (request()->ajax()) {
            $itemAccessUser->update($request->validated());
            return response()->json(['message' => 'Ficha de recepción registrada']);
        }
    }

    public function exportReceived(ItemAccessUser $itemAccessUser)
    {
        set_time_limit(0);
        ini_set("memory_limit", -1);
        ini_set('max_execution_time', 0);

        $fecha = Carbon::now();
        $fechaTexto = $fecha->formatLocalized('%d del mes de %B del %Y');
        $user = $itemAccessUser->user;
        $accessUser = $itemAccessUser->accessUser;

        $header = view::make('admin.itemAccessUser.pdf.received.header')->render();

        $pdf = SnappyPdf::loadView('admin.itemAccessUser.pdf.received.index', ['itemAccessUser' => $itemAccessUser, 'accessUser' => $accessUser, 'user' => $user, 'fechaTexto' => $fechaTexto])
            ->setPaper('a4')
            ->setOption('margin-top', '3.5cm')
            ->setOption('margin-bottom', '2.5cm')
            ->setOption('margin-left', '2cm')
            ->setOption('margin-right', '2cm')
            ->setOption('header-html', $header);
        return $pdf->inline('Control Acceso.pdf');
    }

    public function destroy(ItemAccessUser $item)
    {
        ItemAccessUserDetail::where('item_access_user_id', $item->id)->delete();
        $item->delete();
        return response()->json(['message' => 'Ítem eliminado con éxito']);
    }
}
