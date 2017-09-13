<div class="container">
    <a href="/">Startseite</a>
    <div class="dropdown">
        <button class="dropbtn">Schule</button>
        <div class="dropdown-content">
            <a href="/hausaufgaben">Hausaufgaben</a>
            <a href="/stundenplan">Stundenplan</a>
            <a href="/termine">Termine</a>
            <?php if ($loggedIn) { ?>
                <a href="/wiederholungen">Wiederholungen</a>
            <?php } ?>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn">Download</button>
        <div class="dropdown-content">
            <a href="/downloads">Downloads</a>
            <!-- <a href="/app">App</a> -->
        </div>
    </div>
    <?php
    if ($loggedIn) {
        ?>
        <a href="/hausaufgaben/enter">Eintragen</a>
        <div class="dropdown right" style="margin-right: 75px;">
            <button class="dropbtn"><?= $_SESSION["name"] ?></button>
            <div class="dropdown-content">
                <a href="/settings?section=main">Einstellungen</a>
                <div class="hr"></div>
                <a href="/logout">Logout</a>
            </div>
        </div>
        <?php
    } else {
        ?>
        <a class="right" href="/login">Login</a>
        <?php
    }
    ?>
    <div class="donation_button">
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="2LWMW9PABC4XS">
            <input type="image" src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="Jetzt einfach, schnell und sicher online bezahlen – mit PayPal.">
            <img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
        </form>
    </div>
</div>
<div class id="hinweis">
</div>
<script>
    function news() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                document.getElementById("hinweis").innerHTML = xhr.responseText;
                setTimeout(function() {
                    news();
                }, 30000);
            }
        }
        xhr.open('GET', '/news.php', true);
        xhr.send(null);
    }
    news();
</script>