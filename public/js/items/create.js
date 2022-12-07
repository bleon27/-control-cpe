$(function () {
    $('#createItem').submit(function (event) {
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
                json.message
                messageAccessControl('success', json.message);
                fromThis.trigger("reset");
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
                messageAccessControl('error', 'Error', textErrores, null, 5000);
            },
            complete: function (xhr, status) {
                $.unblockUI()
            }
        });
    });

    $('#formImpor').submit(function (event) {
        var fromThis = $(this);
        event.preventDefault();
        event.stopPropagation();

        var formData = new FormData(document.getElementById("formImpor"));
        formData.append("dato", "valor");

        $.ajax({
            url: fromThis.attr('action'),
            data: formData,
            type: 'POST',
            dataType: 'html',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                insertBlockUI()
            },
            success: function (json) {
                messageAccessControl('success', 'Ítems registrados con éxito');
                fromThis.trigger("reset");
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
                messageAccessControl('error', 'Error', textErrores, null, 5000);
            },
            complete: function (xhr, status) {
                $.unblockUI()
            }
        });
    });
})
