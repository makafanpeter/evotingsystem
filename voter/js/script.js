
$(document).ready(function() {
    initFlashes();
    initErrorFields();
    initDepartment();
    initFaculty();
});


function initRadioButton() {

//        $("#radio").buttonset();
}

function initFaculty() {
    $(".university").change(function()
    {
        var dataString = 'id=' + $(this).val();
        $.ajax
                ({
                    type: "POST",
                    url: "../helper/faculty.php",
                    data: dataString,
                    cache: false,
                    success: function(html)
                    {
                        $(".faculty").html(html);
                    }
                });

    });

}
function initDepartment() {
    $('.faculty').live("change", function() {
        var dataString = 'id=' + $(this).val();
        $.ajax
                ({
                    type: "POST",
                    url: "../helper/department.php",
                    data: dataString,
                    cache: false,
                    success: function(html)
                    {
                        $(".department").html(html);
                    }
                });

    });


}
function initFlashes() {
    var flashes = $("#flashes");
    if (!flashes.length) {
        return;
    }
    setTimeout(function() {
        flashes.slideUp("slow");
    }, 2000);
}

function initErrorFields() {
    $('.error-field').first().focus();
}


