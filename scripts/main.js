$(document).ready(function () {
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
}
);
$('body').ready(function () {
    $('nav').ready(function () {
        var divHeight = $('nav').height();
        $('body').css('margin-top', divHeight + 'px');
        $('.topnav').css('margin-top', '-' + divHeight + 'px');
    });
});