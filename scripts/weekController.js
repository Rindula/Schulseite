function onLoad() {
    var gerade = document.getElementsByClassName("gerade")[0];
    var ungerade = document.getElementsByClassName("ungerade")[0];

    function getWeekNumber(d) {
        // Copy date so don't modify original
        d = new Date(+d);
        d.setHours(0,0,0,0);
        // Set to nearest Thursday: current date + 4 - current day number
        // Make Sunday's day number 7
        d.setDate(d.getDate() + 4 - (d.getDay()||7));
        // Get first day of year
        var yearStart = new Date(d.getFullYear(),0,1);
        // Calculate full weeks to nearest Thursday
        var weekNo = Math.ceil(( ( (d - yearStart) / 86400000) + 1)/7);
        // Return array of year and week number
        return [d.getFullYear(), weekNo];
    }

    var result = getWeekNumber(new Date(new Date().getTime() + 24 * 60 * 60 * 1000));

    var weekRequestor = new XMLHttpRequest();
    weekRequestor.onreadystatechange = function() {
        if (weekRequestor.readyState == XMLHttpRequest.DONE) {
            if (result[1] % 2 == weekRequestor.responseText) {
                gerade.innerHTML = "";
            } else {
                ungerade.innerHTML = "";
            }
        }
    }
    weekRequestor.open('GET', '/scripts/weekcheck.php', true);
    weekRequestor.send(null);
}
window.onload = onLoad;