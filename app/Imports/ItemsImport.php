<?php

namespace App\Imports;

use App\Models\Item;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $item = new Item;
            $item->name = $row['equipo'];
            $item->brand = $row['marca'];
            $item->model = $row['modelo'];
            $item->serie = $row['serie'];
            $item->cne_code = $row['cod_cne'];
            $item->processor = $row['procesador'];
            $item->ram = $row['ram'];
            $item->disk = $row['disco'];
            /*
            $item->descripcion = strlen($row['numero_de_documento']);
            $item->type = strlen($row['numero_de_documento']);
            $item->state = strlen($row['numero_de_documento']);
            */
            $item->save();
        }
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function uniqueBy()
    {
        return 'ci';
    }

/*
public function model(array $row)
{
return new Item([
//
]);
}
*/
}
