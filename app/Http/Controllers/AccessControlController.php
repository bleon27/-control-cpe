<?php

namespace App\Http\Controllers;

use App\Models\AccessControl;
use App\Models\AccessUser;
use App\Http\Requests\StoreAccessControlRequest;
use App\Http\Requests\UpdateAccessControlRequest;
use Carbon\Carbon;
use App\DataTables\AccessControlDataTable;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\View;

class AccessControlController extends Controller
{

    public function index(AccessControlDataTable $dataTable)
    {
        return $dataTable->render('admin.accessControl.index');
    }

    public function accessControl()
    {
        return view('accessControl');
    }

    public function create()
    {
        //
    }

    public function store(StoreAccessControlRequest $request)
    {
        if (request()->ajax()) {
            $data = $request->validated();
            $accessUser = AccessUser::where('ci', $data['identificacion'])->orWhere('document_number', $data['identificacion'])->first();
            $accessControl = AccessControl::where('access_user_id', $accessUser->id)->orderByDesc('id')->first();
            $ctrlCreate = true;
            if (!is_null($accessControl)) {
                if (is_null($accessControl->departure_date)) {
                    $fechaActual = Carbon::now();
                    $diffInMinutes = $fechaActual->diffInMinutes($accessControl->entry_date);
                    if ($diffInMinutes > 4) {
                        AccessControl::find($accessControl->id)->update(['departure_date' => Carbon::now()]);
                        return response()->json(['message' => 'Salida registrada', 'accessUser' => $accessUser]);
                    } else {
                        return response(['messaje' => "En " . (5 - $diffInMinutes) . " minutos puede registrar su salida"], 422);
                    }
                    $ctrlCreate = false;
                } else {
                    $ctrlCreate = true;
                }
            }
            if ($ctrlCreate) {
                $accessControl = AccessControl::create([
                    'access_user_id' => $accessUser->id,
                    'entry_date' => Carbon::now()
                ]);
            }
            return response()->json(['message' => 'Acceso consedido', 'accessUser' => $accessUser]);
        }
    }

    public function show(AccessControl $accessControl)
    {
        //
    }

    public function edit(AccessControl $accessControl)
    {
        //
    }

    public function pdf()
    {
        $accessControls = AccessControl::join('access_users', 'access_controls.access_user_id', 'access_users.id')
            ->select(['access_users.id as codigo_acceso', 'access_controls.id as codigo_control', 'names', 'surnames', 'document_number', 'ci', 'unit', 'position', 'entry_date', 'departure_date'])->get();

        set_time_limit(0);
        ini_set("memory_limit", -1);
        ini_set('max_execution_time', 0);

        $footer = view::make('admin.accessControl.pdf.footer', ['fecha' => Carbon::now()])->render();
        /*return PDF::loadView('admin.accessUsers.pdf', ['accessUsers' => $accessUsers])
        ->setPaper('a4', 'landscape')
        ->download('Acceso de usuarios.pdf');*/
        $pdf = SnappyPdf::loadView('admin.accessControl.pdf.index', ['accessControls' => $accessControls])
            ->setPaper('a4')->setOrientation('landscape')
            ->setOption('margin-top', '10mm')
            ->setOption('margin-bottom', '15mm')
            ->setOption('footer-html', $footer);
        return $pdf->inline('Control Acceso.pdf');
    }

    public function update(UpdateAccessControlRequest $request, AccessControl $accessControl)
    {
        //
    }

    public function destroy(AccessControl $accessControl)
    {
        //
    }
}
