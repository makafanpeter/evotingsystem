
$(document).ready(function() {
    initFlashes();
    initErrorFields();
    function out() {
        var span = this.getElementsByTagName('span');
        $(span[0]).animate({
            opacity: 0.7
        });
        $(span[1]).animate({
            color: '#444'
        });
    }
    function over() {
        var span = this.getElementsByTagName('span');
        $(span[0]).animate({
            opacity: 0.3
        });
        $(span[1]).animate({
            color: 'white'
        });

    }
    $('a.positionButton').hover(
        function () {
            $(this).animate({
                backgroundColor: '#b2d2d2'
            })
        },
        function () {
            $(this).animate({
                backgroundColor: '#d3ede8'
            })
        }
        );

    $('div.positionBox').hover(over, out);
});

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



