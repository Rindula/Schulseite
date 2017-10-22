<ul class="nav nav-pills">
<li class="nav-item">
  <a class="nav-link" href="/">Startseite</a>
</li>
<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">Separated link</a>
  </div>
</li>
<li class="nav-item">
  <a class="nav-link" href="#">Link</a>
</li>
<li class="nav-item">
  <a class="nav-link disabled" href="#">Disabled</a>
</li>
    <?php
    if ($loggedIn) {
        ?>
        <li class="nav-item">
            <a class="nav-link" href="/hausaufgaben/enter">Eintragen</a>
        </li>
        <div class="dropdown right" style="margin-right: 75px;">
            <a class="dropbtn"><?= $_SESSION["name"] ?></a>
            <div class="dropdown-content">
                <a href="/settings?section=main">Einstellungen</a>
                <div class="hr"></div>
                <a href="/logout">Logout</a>
            </div>
        </div>
        <?php
    } else {
        ?>
        <li class="nav-item">
            <a class="nav-link" href="/login">Login</a>
        </li>
        <?php
    }
    ?>
    </ul>
    <div class="donation_button">
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