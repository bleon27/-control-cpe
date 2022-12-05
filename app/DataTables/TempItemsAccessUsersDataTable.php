<?php

namespace App\DataTables;

use App\Models\TempItemAccessUser;
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
use Yajra\DataTables\Html\Editor\Fields\Select;

class TempItemsAccessUsersDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('actions', function ($itemTemp) {
                //$urlShow = URL::route('item.show', $item->id);
                $urlDestroy = URL::route('tempItems.destroy', $itemTemp->id);
                $str = '<div class="btn-group">';
                $str .= "<a class='btn btn-danger btn-sm delete-item' href='$urlDestroy' title='Eliminar'><i class='fa-solid fa-xmark'></i></a>";
                $str .= '</div>';
                return $str;
            })
            ->setRowId('id')
            ->setRowClass(function ($itemTemp) {
                if($itemTemp->id == 8){
                    return 'assigned';
                }
                if($itemTemp->id == 9){
                    return 'by_assigning';
                }
                return '';
            })
            ->rawColumns(['actions']);
    }

    public function query(TempItemAccessUser $model): QueryBuilder
    {
        $item = new Item;
        $tableItemp = $item->getTable();
        $tableTemp = $model->getTable();
        return $model->join($tableItemp, "$tableItemp.id", "$tableTemp.item_id")
                ->where('access_user_id', $this->accessUser)
                ->select(["$tableTemp.id", 'name', 'brand', 'model', 'serie', 'cne_code', 'processor', 'ram', 'disk', 'state'])
        ->newQuery();
    }

    public function html(): HtmlBuilder
    {
        $functions = new Functions();
        return $this->builder()
            ->setTableId('TempItems-table')
            ->ajax(route('itemsAccessUser.create', $this->accessUser))
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
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                    //->width(60)
                ->title('Acciones'),
        ];
    }

    protected function filename(): string
    {
        return 'TempItems_' . date('YmdHis');
    }
}
