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
            error: function (response)
            {
                // console.log("Error : " + response);
            }
        });
    });

    $(".updateSectionStatus").click(function (){
        var status = $(this).text();
        var section_id = $(this).attr("section_id");
        $("#ajaxStatus-" + section_id).html("Loading...");
        $.ajax({
            type: 'post',
            data: {
                status: status,
                section_id: section_id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/update-section-status',
            success: function (response)
            {
                // console.log(response);
                if(response['status'] == 0)
                {
                    $("#section-" + section_id).html("<a class=\"updateSectionStatus\" id=\"section-{{ " + section_id + " }}\" section_id=\"{{ " + section_id + " }}\" href=\"javascript:void(0)\"><button type=\"button\" class=\"btn btn-danger btn-sm\" style=\"pointer-events: none;\">Inactive</button></a>");
                    $("#ajaxStatus-" + section_id).html("");
                }
                else if(response['status'] == 1)
                {
                    $("#section-" + section_id).html("<a class=\"updateSectionStatus\" id=\"section-{{ " + section_id + " }}\" section_id=\"{{ " + section_id + " }}\" href=\"javascript:void(0)\"><button type=\"button\" class=\"btn btn-success btn-sm\" style=\"pointer-events: none;\">Active</button></a>");
                    $("#ajaxStatus-" + section_id).html("");
                }
            },
            error: function (response)
            {
                // console.log("Error : " + response);
            }
        });
    });

    $(".updateCategoryStatus").click(function (){
        var status = $(this).text();
        var category_id = $(this).attr("category_id");
        $("#ajaxStatus-" + category_id).html("Loading...");
        $.ajax({
            type: 'post',
            data: {
                status: status,
                category_id: category_id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/update-category-status',
            success: function (response)
            {
                // console.log(response);
                if(response['status'] == 0)
                {
                    $("#category-" + category_id).html("<a class=\"updateCategoryStatus\" id=\"category-{{ " + category_id + " }}\" category_id=\"{{ " + category_id + " }}\" href=\"javascript:void(0)\"><button type=\"button\" class=\"btn btn-danger btn-sm\" style=\"pointer-events: none;\">Inactive</button></a>");
                    $("#ajaxStatus" + category_id).html("");
                }
                else if(response['status'] == 1)
                {
                    $("#category-" + category_id).html("<a class=\"updateCategoryStatus\" id=\"category-{{ " + category_id + " }}\" category_id=\"{{ " + category_id + " }}\" href=\"javascript:void(0)\"><button type=\"button\" class=\"btn btn-success btn-sm\" style=\"pointer-events: none;\">Active</button></a>");
                    $("#ajaxStatus" + category_id).html("");
                }
            },
            error: function (response)
            {
                // console.log("Error : " + response);
            }
        });
    });

    $("#parent_id").attr('disabled','disabled');

    $("#section_id").change(function () {
        var section_id = $(this).val();
        $.ajax({
            type: 'post',
            data: {
                section_id: section_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/append-categories-level',
            success: function (response)
            {
                // console.log(response);
                $("#parent_id").removeAttr('disabled');
                $("#append_categories_level").html(response);
            },
            error: function (response)
            {
                // console.log("Error : " + response);
            }
        });
    });

    // On Page Load check for Section ID and Old
    var section_id = $("#section_id").val();
    if(section_id != '' && section_id != 0)
    {
        $.ajax({
            type: 'post',
            data: {
                section_id: section_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/append-categories-level',
            success: function (response)
            {
                // console.log(response);
                $("#append_categories_level").html(response);
                if(section_id == 0)
                {
                    $("#parent_id").attr('disabled','disabled');
                }
                else
                {
                    $("#append_categories_level option[value=" + parent_id + "]").attr('selected','selected');
                }
            },
            error: function (response)
            {
                // console.log("Error : " + response);
            }
        });
    }
    else if(section_id == 0 || section_id == null)
    {
        $("#parent_id").attr('disabled','disabled');
    }

});

$(document).load(function () {
    // code here
});
