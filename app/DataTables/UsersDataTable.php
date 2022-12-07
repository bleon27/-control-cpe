<?php

namespace App\DataTables;

use App\Models\User;
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

class UsersDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->filterColumn('full_name', function ($query, $keyword) {
                $sql = "CONCAT(users.names,' ',users.surnames)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
                //->addColumn('action', 'users.action')
            ->editColumn('created_at', function ($user) {
                return $user->created_at;
            })
            ->editColumn('updated_at', function ($user) {
                return $user->updated_at;
            })
            ->addColumn(
                'action',
                function ($user) {
                    $url = URL::route('user.edit', $user->id);
                    $str = "<a class='btn btn-warning btn-sm' href='$url'>Editar</a>";
                    return $str;
                }
            )
            ->setRowId('id');
    }

    public function query(User $model): QueryBuilder
    {

        return $model->select([
            'id',
            DB::raw("CONCAT(users.names,' ',users.surnames) as full_name"),
            'ci',
            'unit',
            'position',
            'email',
            'created_at',
            'updated_at',
        ])->newQuery();
    }

    public function html(): HtmlBuilder
    {
        $functions = new Functions();
        $urlCrear = URL::route('user.create');

        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
                /*->parameters([
                'responsive' => [
                'details' => true
                ],
                ])*/
            ->responsive(true)
            ->language($functions->languajeDatatable())
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('add')->text('Crear')->action('
                location.href = "' . $urlCrear . '"
                        '),
                //Button::make('excel'),
                //Button::make('csv'),
                //Button::make('pdf'),
                //Button::make('print'),
                //Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('full_name')->title('Nombres'),
            Column::make('ci')->title('Cédula'),
            Column::make('unit')->title('Unidad'),
            Column::make('position')->title('Cargo'),
            Column::make('email')->title('Correo'),
            Column::make('created_at')->title('Fehca creacion'),
            Column::make('updated_at')->title('Fecha actualizacion'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
            //->width(60),
            //->addClass('text-center'),

        ];
    }

    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
