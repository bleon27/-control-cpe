<?php

namespace App\DataTables;

use App\Models\AccessControl;
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

class AccessControlDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn(
                'entry_date',
                function (AccessControl $accessControl) {
                    return $accessControl->entry_date;
                }
            )
            ->filterColumn('full_names', function ($query, $keyword) {
                $sql = "CONCAT(access_users.names,' ',access_users.surnames)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('document_number', function ($query, $keyword) {
                $sql = "access_users.document_number  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('ci', function ($query, $keyword) {
                $sql = "access_users.ci  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('unit', function ($query, $keyword) {
                $sql = "access_users.unit  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('position', function ($query, $keyword) {
                $sql = "access_users.position  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('user_code', function ($query, $keyword) {
                $sql = "access_users.id  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->editColumn(
                'departure_date',
                function (AccessControl $accessControl) {
                    return $accessControl->departure_date;
                }
            )
            ->setRowId(
                'id'
            );
    }

    public function query(AccessControl $model): QueryBuilder
    {
        return $model->join('access_users', 'access_controls.access_user_id', 'access_users.id')
            ->select(['access_controls.id', 'access_users.id as user_code', DB::raw("CONCAT(names,' ',surnames) as full_names"), 'document_number', 'ci', 'unit', 'position', 'entry_date', 'departure_date'])
            ->newQuery();
    }

    public function html(): HtmlBuilder
    {
        $functions = new Functions();
        $urlPdf = URL::route('access.control.pdf');
        return $this->builder()
            ->setTableId('access-users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->responsive(true)
            ->language($functions->languajeDatatable())
            //->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons(
                [
                    //Button::make('pdf')->action(''),
                    Button::make('pdf')->className('report-pdf')->action('')->titleAttr('Exportar reporte'),
                    Button::make('reload')
                ]
            );
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->orderable(true),
            Column::make('user_code')->title('Codigo usuario'),
            Column::make('full_names')->title('Nombres'),
            Column::make('document_number')->title('Documentó'),
            Column::make('ci')->title('Cédula'),
            Column::make('unit')->title('Unidad'),
            Column::make('position')->title('Cargo'),
            Column::make('entry_date')->title('Fecha Ingreso'),
            Column::make('departure_date')->title('Fecha Salida')

        ];
    }

    protected function filename(): string
    {
        return 'AccessUsers_' . date('YmdHis');
    }
}
