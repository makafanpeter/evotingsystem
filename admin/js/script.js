$(document).ready(function() {
    initFlashes();
    initErrorFields();
    initDepartment();
    initFaculty();
    initSelectedRow();
    initDeleteDialog();
   // initDatepicker();
});

function initDatepicker() {
    $('.datepicker')
            .attr('readonly', 'readonly')
            .datepicker({
        dateFormat: 'yy-m-d'
    });
}
function initSelectedRow() {

    $('tr.tableRow').hover(
            function() {
                $(this).addClass('selectedRow');
            },
            function() {
                $(this).removeClass('selectedRow');
            }
    );

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

function initDeleteDialog() {
    var deleteDialog = $("#delete-dialog");
    var deleteLink = $("#delete-link");
    deleteDialog.dialog({
        autoOpen: false,
        modal: true,
        width: 476,
        buttons: {
            'OK': function() {
                $(this).dialog('close');
                location.href = deleteLink.attr('href');
            },
            'Cancel': function() {
                $(this).dialog('close');
            }
        }
    });
    deleteLink.click(function() {
        deleteDialog.dialog('open');
        return false;
    });
}

