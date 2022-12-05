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
            ->addColumn('action', 'itemusers.action')
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
        ->join("$tableItem", "$tableItemAccessUser.item_id", "$tableItem.id")
        ->select(["$tableItemAccessUser.id", 'status', 'reason',
        DB::raw("CONCAT(names,' ',surnames) as full_names"),
        DB::raw("$tableItem.name as item"),
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
            Column::make('item')->title('Equipo'),
            Column::make('status')->title('Estado'),
            Column::make('reason')->title('Razon'),
            Column::make('assigned_at')->title('Fecha Asignacion'),
            Column::make('returned_at')->title('Fecha Devolucion'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'ItemUsers_' . date('YmdHis');
    }
}