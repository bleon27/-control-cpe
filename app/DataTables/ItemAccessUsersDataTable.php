<?php

namespace App\DataTables;

use App\Models\ItemAccessUser;
use App\Models\AccessUser;
use App\Models\Item;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Functions\Functions;
use URL;
use DB;

class ItemAccessUsersDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('actions', function ($itemAccessUser) {
                $urlExporAsigned = URL::route('itemsAccessUser.exportAssignment', $itemAccessUser->id);
                $urlRegistrarReceived = URL::route('itemsAccessUser.update', $itemAccessUser->id);
                $urlExporReceived = URL::route('itemsAccessUser.exportReceived', $itemAccessUser->id);
                $urlDestroy = URL::route('itemsAccessUser.destroy', $itemAccessUser->id);
                $str = '<div class="btn-group">';
                //$str .= "<a class='btn btn-warning btn-sm' href='$urlShow' title='Ver'><i class='fa-solid fa-eye'></i></a>";<i class="fa-solid fa-boxes-packing"></i>
                $str .= "<a class='btn btn-danger btn-sm ficha-asignacion' href='$urlExporAsigned' title='Ficha de asignacion'><i class='bi bi-file-earmark-pdf'></i></a>";
                if(is_null($itemAccessUser->returned_at)){
                    $str .= "<a class='btn btn-danger btn-sm registrar-recepcion' href='$urlRegistrarReceived' title='Registrar recepción'><i class='fa-solid fa-left-long'></i></a>";
                }else{
                    $str .= "<a class='btn btn-danger btn-sm ficha-recepcion' href='$urlExporReceived' title='Ficha de recepción'><i class='bi bi-file-earmark-pdf'></i></a>";
                }

                $str .= "<a class='btn btn-danger btn-sm delete-item' href='$urlDestroy' title='Eliminar'><i class='fa-solid fa-xmark'></i></a>";
                $str .= '</div>';
                return $str;
            })
            ->rawColumns(['actions'])
            ->setRowId('id');
    }

    public function query(ItemAccessUser $model): QueryBuilder
    {
        $accessUser = new AccessUser;
        $item = new Item;
        $tableAccessUser = $accessUser->getTable();
        $tableItem = $item->getTable();
        $tableItemAccessUser = $model->getTable();
        return $model->join("$tableAccessUser", "$tableItemAccessUser.access_user_id", "$tableAccessUser.id")
        //->join("$tableItem", "$tableItemAccessUser.item_id", "$tableItem.id")
        ->select(["$tableItemAccessUser.id", 'status', 'reason',
        DB::raw("CONCAT(names,' ',surnames) as full_names"),
        //DB::raw("$tableItem.name as item"),
        'assigned_at', 'returned_at'])
        ->newQuery();
    }

    public function html(): HtmlBuilder
    {
        $functions = new Functions();
        return $this->builder()
                    ->setTableId('itemusers-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->responsive(true)
                    //->dom('Bfrtip')
                    ->language($functions->languajeDatatable())
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('full_names')->title('Usuario'),
            //Column::make('item')->title('Equipo'),
            Column::make('status')->title('Estado'),
            Column::make('reason')->title('Razon'),
            Column::make('assigned_at')->title('Fecha Asignacion'),
            Column::make('returned_at')->title('Fecha Devolucion'),
            Column::computed('actions')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('text-center')->title('Acciones'),
        ];
    }

    protected function filename(): string
    {
        return 'ItemUsers_' . date('YmdHis');
    }
}
