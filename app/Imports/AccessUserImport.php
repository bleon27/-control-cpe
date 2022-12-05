<?php

namespace App\Imports;

use App\Models\AccessUser;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Response;

class AccessUserImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (!is_null($row['cedula']) && is_numeric($row['cedula'])) {
                $accessUser = AccessUser::where('ci', $row['cedula']);
                if (!$accessUser->exists()) {
                    $accessUser = new AccessUser;
                    $accessUser->names = $row['nombres'];
                    $accessUser->surnames = $row['apellidos'];
                    $accessUser->ci = strlen($row['cedula']) == 10 ? $row['cedula'] : "0" . $row['cedula'];
                    if (isset($row['numero_de_documento'])) {
                        $accessUser->document_number = strlen($row['numero_de_documento']) == 9 ? $row['numero_de_documento'] : "0" . $row['numero_de_documento'];
                    }
                    $accessUser->unit = $row['unidad'];
                    $accessUser->position = $row['cargo'];
                    $accessUser->save();
                    /*$accessUser = AccessUser::create(
                    [
                    'full_names' => $row['nombres_y_apellidos'],
                    //'names' => $row['nombres'],
                    //'surnames' => $row['apellidos'],
                    'ci' => strlen($row['cedula']) == 10 ? $row['cedula'] : "0" . $row['cedula'],
                    'document_number' => strlen($row['numero_de_documento']) == 9 ? $row['numero_de_documento'] : "0" . $row['numero_de_documento'],
                    'unit' => $row['unidad'],
                    'position' => $row['cargo'],
                    ]
                    );*/
                }
            }
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
public function rules(): array
{
return [
'1' => Rule::in(['patrick@maatwebsite.nl']),
// Above is alias for as it always validates in batches
'*.1' => Rule::in(['patrick@maatwebsite.nl']),
// Can also use callback validation rules
'0' => function ($attribute, $value, $onFailure) {
if ($value !== 'Patrick Brouwers') {
$onFailure('Name is not Patrick Brouwers');
}
}
];
}
*/
}
