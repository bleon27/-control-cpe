$(function () {
    $('#editAccessUser').submit(function (event) {
        event.preventDefault();
        event.stopPropagation();
        var fromThis = $(this);
        $.ajax({
            url: fromThis.attr('action'),
            data: fromThis.serialize(),
            type: 'POST',
            beforeSend: function () {
                insertBlockUI()
            },
            success: function (json) {
                messageAccessControl('success', 'Actualización con exitosa');
            },
            error: function (xhr, status) {
                var errors = $.parseJSON(xhr.responseText);
                var textErrores = "";
                var cont = 0;
                $.each(errors.errors, function (key, value) {
                    if (cont == 0) {
                        textErrores += value;
                        cont++
                    } else {
                        textErrores += "<br>" + value
                    }
                });
                messageAccessControl('error', textErrores, null, 5000);
            },
            complete: function (xhr, status) {
                //fromThis.trigger("reset");
                $.unblockUI()
            }
        });
    });
})
