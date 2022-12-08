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

        #tabla_listado {
            font-size: 13pt;
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

        .style-text {
            font-size: 14pt;
            line-height: 35px;
            text-align: justify;
            padding-top: 20px
        }

        .border {
            border: solid 1px #333333;
            border-radius: 5px;
        }

        p,
        h3 {
            margin-left: 20px;
            margin-right: 20px;
        }

        .text-center {
            text-align: center
        }

        #firmas {
            width: 100%;
            border-collapse: collapse;
        }

        #firmas tr th {
            border: solid 1px #333333;
        }

        #firmas tr td {
            border: solid 1px #333333;
        }
        #tabla_listado tr th, #tabla_listado tr td{
            border: solid 1px rgba(51, 51, 51, 0.1);
        }
    </style>
</head>

<body>
    <p class="style-text">
        En las instalaciones de la Delegación Provincial Electoral de Santo Domingo de los Tsáchilas, al {{ $fechaTexto }}, se procede a la suscripción de la presente <b>ACTA ENTREGA-RECEPCION</b>&nbsp;de bienes de Bodega Informática provisional CPE, donde actúa<b> {{ $accessUser->names . ' ' . $accessUser->surnames }}&nbsp;y&nbsp;{{ $user->names . ' ' . $user->surnames }}</b>&nbsp;&nbsp;&nbsp;como <b>{{ $user->position }} - {{ $user->unit }}</b>, de acuerdo a la siguiente acta:
    </p>
    <table id="tabla_listado">
        <thead>
            <tr>
                <th class="text-center">CANT</th>
                <th class="text-center">DETALLE</th>
                <th class="text-center">MARCA</th>
                <th class="text-center">COD CNE</th>
                <th class="text-center">ESTADO</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($itemAccessUser->itemAccessUserDetails as $itemAccessUserDetail)
                <tr>
                    <td>{{ $itemAccessUserDetail->amount }}</td>
                    <td>{{ $itemAccessUserDetail->name }}, {{ $itemAccessUserDetail->processor }},
                        {{ $itemAccessUserDetail->ram }}, {{ $itemAccessUserDetail->disk }}</td>
                    <td>{{ $itemAccessUserDetail->brand }}</td>
                    <td>{{ $itemAccessUserDetail->cne_code }}</td>
                    <td>{{ $itemAccessUserDetail->state }}</td>
                </tr>
            @endforeach
            @for ($i=count($itemAccessUser->itemAccessUserDetails);$i<6;$i++)
                <tr>
                    <td><div style="height: 36px;"></div></td>
                    <td><div style="height: 36px;"></div></td>
                    <td><div style="height: 36px;"></div></td>
                    <td><div style="height: 36px;"></div></td>
                    <td><div style="height: 36px;"></div></td>
                </tr>
            @endfor
        </tbody>
    </table>
    <h3 style="margin-top: 40px">***OBSERVACIONES</h3>
    <div class="border">
        <p style="height: 100px;">

            {{ is_null($itemAccessUser->reason)?'': $itemAccessUser->reason}}
        </p>
    </div>
    <p style="font-size: 14pt;text-align: justify">Para constancia de lo actuado en fe de conformidad y aceptación, suscriben la presenta
        acta en dos ejemplares de igual tenor y efecto las personas que han intervenido en esta diligencia
    </p>
    <table id="firmas" style="width:100%">
        <thead>
            <tr>
                <th>ENTREGA</th>
                <th>RECIBE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div style="height: 100px"></div>
                </td>
                <td>
                    <div style="height: 100px"></div>
                </td>
            </tr>
            <tr>
                <td class="text-center" width="50%">
                    <div class="text-center" style="text-transform: uppercase">
                        {{ $user->names . ' ' . $user->surnames }}<br>
                        <b>{{ $user->position }}<br>
                            {{ $user->unit }}<br>
                            C.I.: {{ $user->ci }}
                        </b>
                    </div>
                </td>
                <td class="text-center" width="50%">
                    <div class="text-center">
                        {{ $accessUser->names . ' ' . $accessUser->surnames }}<br>
                        <b>{{ $accessUser->position }}<br>
                            {{ $accessUser->unitAbbreviate }}<br>
                            C.I.: {{ $accessUser->ci }}
                        </b>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
