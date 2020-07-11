// Toastr settings
$(document).ready(function () {
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "debug": true,
        "positionClass": "toast-bottom-right",
        "newestOnTop": false,
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "2000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    if ($("#toastrType").val() == '')
    {
        var type = 'success';
    } else {
        var type = $("#toastrType").val();
    }
    var toastrMessage = $("#toastrMessage").val();
    switch (type) {
        case 'info':
            toastr["info"](toastrMessage);
            break;

        case 'warning':
            toastr["warning"](toastrMessage);
            break;

        case 'success':
            toastr["success"](toastrMessage);
            break;

        case 'error':
            toastr["error"](toastrMessage);
            break;
    }

});
