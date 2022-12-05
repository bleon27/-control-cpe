<?php

namespace App\DataTables;

use App\Models\AccessUser;
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

class AccessUsersDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->filterColumn('full_name', function ($query, $keyword) {
                $sql = "CONCAT(access_users.names,' ',access_users.surnames)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->editColumn('created_at', function ($userAccess) {
                return $userAccess->created_at;
            })
            ->editColumn('updated_at', function ($userAccess) {
                return $userAccess->updated_at;
            })
            ->addColumn('action', function ($userAccess) {
                $url = URL::route('access.user.edit', $userAccess->id);
                $str = "<a class='btn btn-warning btn-sm' href='$url'>Editar</a>";
                return $str;
            })
            ->setRowId('id');
    }

    public function query(AccessUser $model): QueryBuilder
    {
        return $model->select([
            'id',
            DB::raw("CONCAT(access_users.names,' ',access_users.surnames) as full_name"),
            'document_number',
            'ci',
            'unit',
            'position',
            'created_at',
            'updated_at',
        ])->newQuery();
    }

    public function html(): HtmlBuilder
    {
        $functions = new Functions();
        return $this->builder()
            ->setTableId('access-users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->responsive(true)
            //->dom('Bfrtip')
            ->language($functions->languajeDatatable())
            ->orderBy(0, 'asc')
            ->selectStyleSingle()
            ->buttons(
                [
                    /*Button::make('add')->className('crear')->text('Crear')->action('')->titleAttr('Crear'),
                    Button::make('pdf')->className('report-pdf')->action('')->titleAttr('Exportar reporte'),
                    Button::make('pdf')->text('<i class="bi bi-upc-scan"></i>')->className('barcode-pdf')->action('')->titleAttr('Exportar codigos de barras'),
                    //Button::make('pdf'),
                    //Button::make('excel'),
                    Button::make('reload')->titleAttr('Refrescar')*/
                ]
            );
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('full_name')->title('Nombres'),
            Column::make('document_number')->title('Documentó'),
            Column::make('ci')->title('Cédula'),
            Column::make('unit')->title('Unidad'),
            Column::make('position')->title('Cargo'),
            Column::make('created_at')->title('Fecha Creación'),
            Column::make('updated_at')->title('Fecha Actualización'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
        ];
    }

    protected function filename(): string
    {
        return 'AccessUsers_' . date('YmdHis');
    }
}
