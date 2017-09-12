/* 
 * Alle Rechte dieser Website liegen bei Sven Nolting.
 * Medien können unter Umständen von anderen Seiten sein.
 * Die Nutzung dieser Website und ihrer Scripte sind !NACH ANFRAGE! erlaubt oder halt nicht.
 */


// Vollbild (von Selfhtml)
function enterFullscreen(element) {
  if(element.requestFullscreen) {
    element.requestFullscreen();
  } else if(element.mozRequestFullScreen) {
    element.mozRequestFullScreen();
  } else if(element.msRequestFullscreen) {
    element.msRequestFullscreen();
  } else if(element.webkitRequestFullscreen) {
    element.webkitRequestFullscreen();
  }
}

enterFullscreen(document.documentElement);