$(document).ready(function (){
    // Check Admin Password is Correct or Not
    $("#new_password").attr("disabled", "disabled");
    $("#new_password").val("");
    $("#confirm_password").attr("disabled", "disabled");
    $("#confirm_password").val("");
    $("#current_password").keyup(function (){
        var current_pwd = $("#current_password").val();
        // alert(current_pwd);
        $.ajax({
            type: 'post',
            data: {
                current_pwd: current_pwd,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/check-current-password',
            success: function (response)
            {
                // console.log(response);
                if(current_pwd == "")
                {
                    $("#currentPassword").html("<font color='orange'> Please enter your current password to update to new One. </font>");
                    $("#new_password").attr("disabled", "disabled");
                    $("#new_password").val("");
                    $("#confirm_password").attr("disabled", "disabled");
                    $("#confirm_password").val("");
                }
                else if(response == "False")
                {
                    $("#currentPassword").html("<font color='red'> Password is Incorrect. Please try again. </font>");
                    $("#new_password").attr("disabled", "disabled");
                    $("#new_password").val("");
                    $("#confirm_password").attr("disabled", "disabled");
                    $("#confirm_password").val("");
                }
                else if(response == "True")
                {
                    $("#currentPassword").html("<font color='green'> Password is Current. Please enter your new Password. </font>");
                    $("#new_password").removeAttr("disabled");
                    $("#confirm_password").removeAttr("disabled");
                }
            },
            error: function (response) {
                // console.log("Error : " + response);
            }
        });
    });
});
