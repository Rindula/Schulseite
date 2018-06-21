$(document).ready(function () {

    if (getCookie("darkmode") == "") {
        setCookie("darkmode", "false", 10000);
    }

    var acc = document.getElementsByClassName("imageAcc");
    var i;
    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function () {
            /* Toggle between adding and removing the "active" class,
             to highlight the button that controls the panel */
            this.classList.toggle("active");
            /* Toggle between hiding and showing the active panel */
            var panel = this.nextElementSibling;
            panel.classList.toggle("shown");
        };
    }

    if (getCookie("darkmode") == "true") {
        $(".table").addClass("table-dark");
        $(".list-group-item").addClass("list-group-item-dark");
        $("body").addClass("bg-dark");
        $("body").addClass("text-light");
        $(".form-control, .modal-content").not(".btn").addClass("bg-dark");
        $(".form-control").not(".btn").addClass("text-light");
        $(".bg-light").removeClass("bg-light").addClass("bg-dark");
        $(".navbar-light").removeClass("navbar-light").addClass("navbar-dark");
        $("choices").addClass("bg-dark");
    }
}
);
$('body').ready(function () {
    $('nav').ready(function () {
        var divHeight = $('nav').height();
        $('body').css('margin-top', divHeight + 'px');
        $('.topnav').css('margin-top', '-' + divHeight + 'px');
    });
});

function updateDesign(sel) {
    var v = sel.value;
    if (v == 1) {
        setCookie("darkmode", "true", 10000);
    } else if (v == 0) {
        setCookie("darkmode", "false", 10000);
    }
    location.reload();
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function removeNews(item) {
    setCookie(item.id, "false", 30);
    item.classList.remove("show");
}