<ul class="nav nav-tabs">
<li class="nav-item">
  <a class="nav-link" id="startseite" href="/">Startseite</a>
</li>
<li class="nav-item">
  <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="navDropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Schule</a>
  <div class="dropdown-menu" aria-labelledby="navDropdown">
    <a class="dropdown-item" id="hausaufgaben" href="/hausaufgaben">Hausaufgaben</a>
    <a class="dropdown-item" id="termine" href="/termine">Termine</a>
    <?php if ($loggedIn) { ?>
    <a class="dropdown-item" id="stundenplan" href="/stundenplan">Stundenplan</a>
    <?php } ?>
    <div class="dropdown-divider"></div>
    <?php if ($loggedIn) { ?>
    <a class="dropdown-item" id="wiederholungen" href="/wiederholungen">Wiederholungen</a>
    <?php } ?>
    <a class="dropdown-item" id="files" href="/files">Wichtige Materialien</a>
  </div>
</li>
<li class="nav-item">
  <a class="nav-link <?= ($loggedIn) ? "" : "disabled" ?>" id="enter" href="/hausaufgaben/enter">Eintragen</a>
</li>
    <?php
    if ($loggedIn) {
        ?>
        <li>
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="navDropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?= $_SESSION["name"] ?></a>
        <div class="dropdown-menu" aria-labelledby="navDropdown">
            <a class="dropdown-item fa fa-cog" id="settings" href="/settings?section=main"> Einstellungen</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/logout">Abmelden</a>
        </div>
        </li>
        <?php
    } else {
        ?>
        <li class="nav-item">
        <a class="nav-link dropdown-toggle" id="loginDropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Login</a>
        <form action="/login?login" method="post" class="dropdown-menu p-4" aria-labelledby="loginDropdown">
            <div class="form-group">
                <label for="username">Benutzername</label>
                <input type="text" name="name" class="form-control" id="username" placeholder="NachnameV(orname)">
            </div>
            <div class="form-group">
                <label for="password">Passwort</label>
                <input type="password" name="passwort" class="form-control" id="password" placeholder="Passwort">
            </div>
            <!-- <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input">
                Remember me
                </label>
            </div> -->
            <button type="submit" class="btn btn-primary">Anmelden</button>
            </form>
        </li>
        <?php
    }
    ?>
        <li class="nav-item">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="help" href="#" role="button" aria-haspopup="true" aria-expanded="false">Hilfe?</a>
            <div class="dropdown-menu" aria-labelledby="hrlp">
                <a class="dropdown-item fa fa-bug" id="bugtracker" href="/support"> Bugtracker</a>
            </div>
        </li>
    </ul>
    <div class="donation_button">
        <a href="https://discord.gg/wHYgQxU">
            <img src="/img/discord-banner-highres.gif" alt="Join my Discord Server">
        </a>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="2LWMW9PABC4XS">
            <input type="image" src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="Jetzt einfach, schnell und sicher online bezahlen – mit PayPal.">
            <img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
        </form>        
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
    function closeNews(id) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                document.getElementById("message_" + id).classList.remove("aktiv");
                alert(xhr.responseText);
            }
        }
        xhr.open('GET', '/news.php?close='+id, true);
        xhr.send(null);
    }
    news();
</script>