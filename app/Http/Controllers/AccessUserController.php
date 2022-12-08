<?php

namespace App\Http\Controllers;

use App\Models\AccessUser;
use App\Http\Requests\StoreAccessUserRequest;
use App\Http\Requests\UpdateAccessUserRequest;
use App\DataTables\AccessUsersDataTable;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AccessUserImport;
use Illuminate\Http\Request;
//use PDF;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class AccessUserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:access-user-list|access-user-create|access-user-edit|access-user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:access-user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:access-user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:access-user-delete', ['only' => ['destroy']]);
    }

    public function index(AccessUsersDataTable $dataTable)
    {
        return $dataTable->render('admin.accessUsers.index');
    }

    public function import(Request $request)
    {
        if (request()->ajax()) {
            Excel::import(new AccessUserImport, $request->file('file')->store('files'));
            //return redirect('/')->with('success', 'All good!');
            return redirect()->back();
        }
    }

    public function create()
    {
        return view('admin.accessUsers.create');
    }

    public function store(StoreAccessUserRequest $request)
    {
        if (request()->ajax()) {
            $accessUser = AccessUser::create($request->validated());
            return response()->json(['message' => 'Usuario creado con éxito']);
        }
    }

    public function show(AccessUser $accessUser)
    {
        //
    }

    public function showAjax($ci)
    {
        $accessUser = AccessUser::where('ci', $ci)->first();
        if (is_null($accessUser)) {
            return response()->json(['errors' => ['message' => 'El usuario no existe']], 422);
        }
        return response()->json(['accessUser' => $accessUser]);
    }

    public function edit(AccessUser $accessUser)
    {
        return view('admin.accessUsers.edit', ['accessUser' => $accessUser]);
    }

    public function pdf()
    {
        $accessUsers = AccessUser::all();
        set_time_limit(0);
        ini_set("memory_limit", -1);
        ini_set('max_execution_time', 0);
        $footer = view::make('admin.accessUsers.pdf.footer', ['fecha' => Carbon::now()])->render();
        /*return PDF::loadView('admin.accessUsers.pdf', ['accessUsers' => $accessUsers])
        ->setPaper('a4', 'landscape')
        ->download('Acceso de usuarios.pdf');*/
        $pdf = SnappyPdf::loadView('admin.accessUsers.pdf.index', ['accessUsers' => $accessUsers])
            ->setPaper('a4')->setOrientation('landscape')
            ->setOption('margin-top', '10mm')
            ->setOption('margin-bottom', '15mm')
            ->setOption('footer-html', $footer);
        return $pdf->inline('Control de acceso de usuarios.pdf');
    }

    public function barcode()
    {
        $accessUsers = AccessUser::all();
        set_time_limit(0);
        ini_set("memory_limit", -1);
        ini_set('max_execution_time', 0);
        $footer = view::make('admin.accessUsers.pdf.footer', ['fecha' => Carbon::now()])->render();

        $pdf = SnappyPdf::loadView('admin.accessUsers.pdf.barcode', ['accessUsers' => $accessUsers])
            ->setPaper('a4')
            ->setOption('margin-top', '10mm')
            ->setOption('margin-bottom', '15mm')
            ->setOption('footer-html', $footer);
        return $pdf->inline('Control de acceso de usuarios.pdf');
    }

    public function update(UpdateAccessUserRequest $request, AccessUser $accessUser)
    {
        if (request()->ajax()) {
            $accessUser->update($request->validated());
            return response()->json(['message' => 'Actialización exitosa']);
        }
    }

    public function destroy(AccessUser $accessUser)
    {
        //
    }
}
