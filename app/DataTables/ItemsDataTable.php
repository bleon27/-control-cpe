<?php

namespace App\DataTables;

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

class ItemsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($item) {
                //$urlShow = URL::route('item.show', $item->id);
                $urlEdit = URL::route('item.edit', $item->id);
                $urlDestroy = URL::route('item.destroy', $item->id);
                $str = '<div class="btn-group">';
                //$str .= "<a class='btn btn-warning btn-sm' href='$urlShow' title='Ver'><i class='fa-solid fa-eye'></i></a>";
                $str .= "<button class='btn btn-success btn-sm btn-assign'";
                $str .= "data-bs-toggle='modal' data-bs-target='#exampleModal' data-bs-whatever='@getbootstrap'";
                $str .= "data-codigo='$item->id' data-nombre='$item->name' data-marca='$item->brand' data-modelo='$item->model' data-serie='$item->serie' data-codigocne='$item->cne_code' data-estado='$item->state'";
                $str .= "title='Asignar'><i class='fa-solid fa-user-plus'></i></button>";
                $str .= "<a class='btn btn-warning btn-sm' href='$urlEdit' title='Editar'><i class='fa-regular fa-pen-to-square'></i></a>";
                $str .= "<a class='btn btn-danger btn-sm delete-item' href='$urlDestroy' title='Eliminar'><i class='fa-solid fa-xmark'></i></a>";
                $str .= '</div>';
                return $str;
            })
            ->editColumn('created_at', function ($item) {
                return $item->created_at;
            })
            ->editColumn('updated_at', function ($item) {
                return $item->updated_at;
            })
            ->setRowId('id')
            ->setRowClass(function ($item) {
                if($item->id == 8){
                    return 'assigned';
                }
                if($item->id == 9){
                    return 'by_assigning';
                }
                return '';
            });
    }

    public function query(Item $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        $functions = new Functions();
        return $this->builder()
            ->setTableId('items-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->responsive(true)
                //->dom('Bfrtip')
            ->language($functions->languajeDatatable())
            ->orderBy(0, 'asc')
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
            Column::make('name')->title('Nombre'),
            Column::make('brand')->title('Marca'),
            Column::make('model')->title('Modelo'),
            Column::make('serie')->title('Serie'),
            Column::make('cne_code')->title('Cod. CNE'),
            Column::make('state')->title('Estado'),
            //Column::make('ram')->title('Ram'),
            //Column::make('disk')->title('Disco'),
            //Column::make('descripcion')->title('Descripción'),
            //Column::make('type')->title('Tipo'),
            Column::make('created_at')->title('Fecha Creacion'),
            Column::make('updated_at')->title('Fecha Actualizacion'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                    //->width(60)
                ->title('Acciones'),
        ];
    }

    protected function filename(): string
    {
        return 'Items_' . date('YmdHis');
    }
}
