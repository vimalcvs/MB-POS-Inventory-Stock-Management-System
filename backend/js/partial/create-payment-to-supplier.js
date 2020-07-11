$(document).ready(function () {
    // Get Supplier Due Amount
    $("#supplier_id").on('change',function () {
        var supplier_id = $("#supplier_id").val();
        var banseURL = $("#banseURL").val();
        $("#supplierTotalDue").empty();
        $.get(banseURL + "/vue/api/get-supplier-due/"+supplier_id,function (data) {
            $("#supplierTotalDue").append(data.message);
            $("#amount").prop('max',data.due_amount);
        });
    });
})
