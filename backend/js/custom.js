$(document).ready(function(){
    $('#monthpicker').datepicker({
        autoclose: true,
        startView: 1,
        minViewMode: "months"
    });
});

$(".show-payment-details").click(function(){
    var payment_id = $(this).data('payment-id');
    $('#paymentDetails'+payment_id).removeClass('d-none');
});

$(".drawer-close-btn").click(function(){
    $('.payment-details-drawer').addClass('d-none');
});


$(".show-payment-details-for-customer").click(function(){
    $('#hiddenInpurValue').empty();
    $("#amount").prop('max',$(this).data('due-amount'));
    $("#amount").prop('value',$(this).data('due-amount'));
    $("#sell_id").prop('value',$(this).data('sell-id'));
    $('#paymentDrawer').removeClass('d-none');
});

$(".drawer-close-btn-for-customer").click(function(){
    $('#paymentDrawer').addClass('d-none');
});

function previewFile(input) {
    var preview = input.previousElementSibling;
    var file = input.files[0];
    var reader = new FileReader();


    if(input.files[0].size > 2000000){
        alert("Maximum file size is 2MB!");

    } else {

        reader.onloadend = function() {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);

        } else {
            preview.src = "";
        }
    }
}


$(".download-bar-code").on("click", function () {
    var id = $(this).data("id");
    var base_url = $("#baseURL").val();
    $('#productBarCode').attr('action', base_url +'/product-barcode/'+id);
    $("#barCodeQty").modal("show");
})



$(".show-expense-details").click(function(){
    var expense_id = $(this).data('expense-id');
    $('#expenseDetails'+expense_id).removeClass('d-none');
});

$(".drawer-close-btn-for-expense").click(function(){
    $('.expense-details-dwawer').addClass('d-none');
});


