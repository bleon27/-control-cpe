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
        body{
            font-family: "Roboto-Regular";
        }
        #encabezado {
            margin-bottom: 20px;
        }

        #encabezado .title {
            width: 100%;
            text-align: center;
        }

        .margin {
            padding-left: 30px;
            padding-bottom: 30px;
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
                    <td class="title" colspan="3">CÓDIGOS DE BARRAS DEL PERSONAL CON ACCESO AL CPE</td>
                </tr>
            </tbody>
        </table>
    </header>
    @foreach ($accessUsers as $accessUser)
        <img class="margin" src="data:image/png;base64,{!! DNS1D::getBarcodePNG($accessUser->ci, 'C128', 2, 33, [1, 1, 1], true) !!}" alt="barcode" />
    @endforeach
</body>

</html>
