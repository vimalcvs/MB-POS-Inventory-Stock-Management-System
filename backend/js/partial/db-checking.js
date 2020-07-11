$('#installationForm').submit(function() {
    var base_url = $("#banseURL").val();
    var database_hostname = $("#database_hostname").val();
    var database_name = $("#database_name").val();
    var database_username = $("#database_username").val();
    var database_password = $("#database_password").val();
    $.ajax({
        url: base_url +"/check-db-connection/"+database_hostname+"/"+database_name+"/"+database_username+"/"+database_password,
        type: 'GET',
        context: this,
        success: function(info) {
            if (info == 'fail')
            {
                $(".db-con-error").html('<div class="alert alert-danger db-error"><i class="fa fa-warning mr-2"></i> Database Connection Faild !</div>');
                $(".db-error").fadeTo(2000, 500).slideUp(1000, function(){
                    $(".alert-dismissible").alert('close');
                });
            } else {
                this.submit();
            }
        }
    });

    // we cancel the normal submission of the form
    return false;
});


function checkEnvironment(val) {
    var element=document.getElementById('environment_text_input');
    if(val=='other') {
        element.style.display='block';
    } else {
        element.style.display='none';
    }
}
function showDatabaseSettings() {
    document.getElementById('tab2').checked = true;
}
function showApplicationSettings() {
    document.getElementById('tab3').checked = true;
}
