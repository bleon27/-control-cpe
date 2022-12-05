export function usarDatatable(accessControl) {
    $('.report-pdf').click(function () {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', accessControl, true);
        xhr.responseType = 'blob';
        insertBlockUI();
        xhr.onload = function (e) {
            if (this.status == 200) {
                var blob = new Blob([this.response], {
                    type: 'application/pdf'
                });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "Usuarios con acceso.pdf";
                link.click();
            }
            $.unblockUI();
        };
        xhr.send();
    })
}
