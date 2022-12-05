<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .paginacion {
            float: right;
            margin-top: 5mm;
        }
        .fecha{
            margin-top: 5mm;
            float: left;
        }
    </style>
</head>

<body onload="getPdfInfo()">
    <div class="fecha">Fecha: {{ $fecha }}</div>
    <div class="paginacion">
        <table>
            <tbody>
                <tr>
                    <td>Pagina</td>
                    <td>
                        <div id="pdfkit_page_current"></div>
                    </td>
                    <td>de</td>
                    <td>
                        <div id="pdfkit_page_count"></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        var pdfInfo = {};
        var x = document.location.search.substring(1).split('&');
        for (var i in x) {
            var z = x[i].split('=', 2);
            pdfInfo[z[0]] = unescape(z[1]);
        }

        function getPdfInfo() {
            var page = pdfInfo.page || 1;
            var pageCount = pdfInfo.topage || 1;
            document.getElementById('pdfkit_page_current').textContent = page;
            document.getElementById('pdfkit_page_count').textContent = pageCount;
        }
    </script>
</body>

</html>
