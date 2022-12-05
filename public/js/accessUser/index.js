export function usarDatatable(crear, user, barcode) {
    $('.crear').click(function () {
        location.href = crear;
    });

    $('.report-pdf').click(function () {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', user, true);
        xhr.responseType = 'blob';
        insertBlockUI();
        xhr.onload = function (e) {
            if (this.status == 200) {
                var blob = new Blob([this.response], {
                    type: 'application/pdf'
                });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "Usuarios con acceso al CPE.pdf";
                link.click();
            } else {
                messageAccessControl('error', 'Error', 'Error de conexión', null, 5000);
            }
            $.unblockUI();
        };
        xhr.send();
    });

    $('.barcode-pdf').click(function () {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', barcode, true);
        xhr.responseType = 'blob';
        insertBlockUI();
        xhr.onload = function (e) {
            if (this.status == 200) {
                var blob = new Blob([this.response], {
                    type: 'application/pdf'
                });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "Codigo de barras.pdf";
                link.click();
            }
            $.unblockUI();
        };
        xhr.send();
    });
}
