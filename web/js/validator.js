$(document).ready(function () {
    var validate = function (e) {
        var submit = $(this).hasClass("fos_user_registration_register");
        console.log(submit);
        e.preventDefault();
        $.post('/validate', {email: $("input[type=email]").val()},
            function (json) {
                if (json.result == 'fail'){
                    $(".alert-email").html(json.message).show();
                } else {
                    $(".alert-email").hide();
                    if(submit){
                        $("input[type=submit]").attr("disabled", "disabled");
                        $(".fos_user_registration_register").unbind();
                        $(".fos_user_registration_register").submit();
                    }
                }
            }, 'json');
    }
    $("input[type=email]").keyup(validate);
    $(".fos_user_registration_register").submit(validate);
});