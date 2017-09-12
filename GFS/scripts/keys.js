/* 
 * Alle Rechte dieser Website liegen bei Sven Nolting.
 * Medien können unter Umständen von anderen Seiten sein.
 * Die Nutzung dieser Website und ihrer Scripte sind !NACH ANFRAGE! erlaubt oder halt nicht.
 */


//Enter: 13
//Hoch: 38
//Runter: 40
//Rechts: 39
//Links: 37

var pageCount = 5;

$(document).keyup(function (e) {
    if (e.which === 39) {
        page = Math.max(1, Math.min(page + 1, pageCount + 1));
    }
    if (e.which === 37) {
        page = Math.max(1, Math.min(page - 1, pageCount + 1));
    }

    callPage(page);
});