const messageAccessControl = (icon = 'info', title = '', text = '', url = null, timer = 1500) => {
    Swal.fire({
        position: 'center',
        icon: icon,
        title: title,
        html: text,
        showConfirmButton: false,
        timer: timer,
        willClose: () => {
            if (url != null) {
                location.href = url;
            }
        }
    });
}
const insertBlockUI = () => {
    $.blockUI({
        message: `<h1>Espere por favor</h1><div class="w-100 d-flex justify-content-center"><div class="spinner"></div></div>`,
        css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff',
        }
    });
};
window.messageAccessControl = messageAccessControl;
window.insertBlockUI = insertBlockUI;
