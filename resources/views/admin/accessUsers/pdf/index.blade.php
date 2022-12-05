<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Control de acceso de usuarios</title>
    <style>
        @font-face {
            font-family: "Roboto-Medium";
            src: url("{{ asset('fonts/Roboto/Roboto-Medium.ttf') }}");
        }

        @font-face {
            font-family: "Roboto-Regular";
            src: url("{{ asset('fonts/Roboto/Roboto-Regular.ttf') }}");
        }

        @font-face {
            font-family: "Roboto-Thin";
            src: url("{{ asset('fonts/Roboto/Roboto-Thin.ttf') }}");
        }

        #encabezado {
            margin-bottom: 20px;
        }

        /*
        #encabezado table {
            border-collapse: collapse;
            border: 1px solid #DDDDDD;
            width: 100%;
        }

        #encabezado table td {
            border: 1px solid #DDDDDD;
        }
        */
        #encabezado .title {
            width: 100%;
            text-align: center;
        }

        #tabla_listado {
            font-size: 10.5pt;
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #DDDDDD;
            color: #333333;
        }

        #tabla_listado thead {
            background: #F9F9F9;
        }

        #tabla_listado thead tr th {
            font-family: "Roboto-Regular";
            font-weight: 700;
            text-align: start;
        }

        #tabla_listado tbody tr {
            border: 1px solid #DDDDDD;
        }

        #tabla_listado tr th,
        #tabla_listado tr td {
            padding-bottom: 5px;
            padding-top: 5px;
        }

        #tabla_listado tbody tr td {
            font-family: "Roboto-Thin";
            font-weight: 900;
        }

        #tabla_listado tbody tr:nth-child(odd) {
            background: #fff;
        }

        #tabla_listado tbody tr:nth-child(even) {
            background: #F9F9F9;
        }
    </style>
</head>

<body>
    <header id="encabezado">
        <table>
            <tbody>
                <tr>
                    <td><img src="{{ asset('img/cne.png') }}" style="height: 70px;" alt=""></td>
                    <td class="title"><b>DELEGACIÓN PROVINCIAL ELECTORAL SANTO DOMINGO DE LOS TSÁCHILAS</b>
                    </td>
                    <td>
                        <div style="width: 100px"></div>
                    </td>
                </tr>
                <tr>
                    <td class="title" colspan="3">LISTADO DE PERSONAL CON ACCESO AL CPE</td>
                </tr>
            </tbody>
        </table>
    </header>
    <table id="tabla_listado">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombres</th>
                <th>Nro. Documentó</th>
                <th>Nro. Cédula</th>
                <th>Unidad</th>
                <th>Cargo</th>
                <th>Fecha Creación</th>
                <th>Fecha Actualización</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accessUsers as $accessUser)
                <tr>
                    <td>{{ $accessUser->id }}</td>
                    <td>{{ $accessUser->names }} {{ $accessUser->surnames }}</td>
                    <td>{{ $accessUser->document_number }}</td>
                    <td>{{ $accessUser->ci }}</td>
                    <td>{{ $accessUser->unit }}</td>
                    <td>{{ $accessUser->position }}</td>
                    <td>{{ $accessUser->created_at }}</td>
                    <td>{{ $accessUser->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
