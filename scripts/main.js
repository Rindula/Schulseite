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
        $(".form-control, .modal-content").addClass("bg-dark");
        $(".form-control").addClass("text-light");
        $(".bg-light").removeClass("bg-light").addClass("bg-dark");
        $(".navbar-light").removeClass("navbar-light").addClass("navbar-dark");
    }
}
);
$('body').ready(function () {
    $('nav').ready(function () {
        var divHeight = $('nav').height();
        $('body').css('margin-top', divHeight + 'px');
        $('.topnav').css('margin-top', '-' + divHeight + 'px');
        navLoaded();
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

function navLoaded() {
    var $container = $('.bola');
    var renderer = new THREE.WebGLRenderer({antialias: true, alpha: true});
    var camera = new THREE.PerspectiveCamera(80,1,0.1,10000);
    var scene = new THREE.Scene();

    renderer.setClearColor( 0xffffff, 0 );

    scene.add(camera);
    renderer.setSize(30,30);
    $container.append(renderer.domElement);

    ///////////////////////////////////////////////

    // Camera
    camera.position.z = 200;

    // Material
    var pinkMat = new THREE.MeshPhongMaterial({
        color      :  new THREE.Color("#641aaf"),
        emissive   :  new THREE.Color("#000000"),
        specular   :  new THREE.Color("rgba(255,155,255,1)"),
        shininess  :  1000,
        shading    :  THREE.FlatShading,
        transparent: 1,
        opacity    : 1
    });

    var L1 = new THREE.PointLight( 0xffffff, 1);
    L1.position.z = 100;
    L1.position.y = 100;
    L1.position.x = 100;
    scene.add(L1);

    var L2 = new THREE.PointLight( 0xffffff, 0.8);
    L2.position.z = 200;
    L2.position.y = 400;
    L2.position.x = -100;
    scene.add(L2);

    // IcoSphere -> THREE.IcosahedronGeometry(80, 1) 1-4
    var Ico = new THREE.Mesh(new THREE.IcosahedronGeometry(75,1), pinkMat);
    Ico.rotation.z = 0.5;
    scene.add(Ico);

    function update(){
        Ico.rotation.x+=2/250;
        Ico.rotation.y+=2/250;
    }

    // Render
    function render() {
        requestAnimationFrame(render);			
        renderer.render(scene, camera);	
        update();
    }

    render();
}