<?php
    if ($darkMode) {
        $dark = " bg-dark text-light";
    };
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="glitch"><span>rindula.de</span></div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="d-print-none navbar-nav mr-auto sticky-top <?= ($darkMode) ? "bg-dark" : "bg-light"?>">
<li class="nav-item">
  <a class="nav-link" id="startseite" href="/">Startseite</a>
</li>
<li class="nav-item">
  <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="navDropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Schule</a>
  <div class="dropdown-menu<?= $dark ?>" aria-labelledby="navDropdown">
    <a class="dropdown-item<?= $dark ?>" id="hausaufgaben" href="/hausaufgaben">Hausaufgaben / Klassenarbeiten</a>
    <?php if ($loggedIn) { ?>
    <a class="dropdown-item<?= $dark ?>" id="stundenplan" href="/stundenplan">Stundenplan</a>
    <?php } ?>
    <div class="dropdown-divider"></div>
    <?php if ($loggedIn) { ?>
    <a class="dropdown-item<?= $dark ?>" id="entschuldigungen" href="/entschuldigungen">Entschuldigung ausfüllen</a>
    <?php } ?>
    <a class="dropdown-item<?= $dark ?>" id="files" href="/files">Wichtige Materialien</a>
  </div>
</li>
<li class="nav-item">
  <a class="nav-link <?= ($loggedIn) ? "" : "disabled" ?>" id="enter" href="<?= ($loggedIn) ? "/hausaufgaben/enter" : "#" ?>">Eintragen</a>
</li>
    <?php
    if ($loggedIn) {
        ?>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="navDropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?= $_SESSION["name"] ?></a>
        <div class="dropdown-menu<?= $dark ?>" aria-labelledby="navDropdown">
            <a class="dropdown-item fa fa-cog<?= $dark ?>" id="settings" href="/settings?section=main"> Einstellungen</a>
            <div class="dropdown-divider"></div>
            <?php
                if ($gruppe == 1) {
            ?>
            <a class="dropdown-item fa fa-cog<?= $dark ?>" id="admin" href="/admin"> Administrator funktionen</a>
            <div class="dropdown-divider"></div>
            <?php
                }
            ?>
            <a class="dropdown-item<?= $dark ?>" href="/logout">Abmelden</a>
        </div>
        </li>
        <?php
    } else {
        ?>
        <li class="nav-item">
        <a class="nav-link" id="login" href="#" data-toggle="modal" data-target="#loginModal" role="button" aria-haspopup="true" aria-expanded="false">Login</a>
        </li>
        <?php
    }
    ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="help" href="#" role="button" aria-haspopup="true" aria-expanded="false">Hilfe?</a>
            <div class="dropdown-menu<?= $dark ?>" aria-labelledby="hrlp">
                <a class="dropdown-item fa fa-bug<?= $dark ?>" id="bugtracker" target="_blank" href="https://github.com/rindula-de/Schulseite/issues/new?template=bug_report.md"> Bug melden</a>
                <a class="dropdown-item fa fa-bug<?= $dark ?>" id="bugtracker" target="_blank" href="https://github.com/rindula-de/Schulseite/issues/new?template=feature_request.md"> Funktion vorschlagen</a>
                <a class="dropdown-item<?= $dark ?>" target="_blank" href="https://discord.gg/wHYgQxU">
                    <img class="img-fluid" src="https://i.imgur.com/8vxTxZU.png" alt="Join my Discord Server">
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item<?= $dark ?>" id="datenschutz" href="/kontakt/datenschutz.php">Datenschutzerklärung</a>
                <a class="dropdown-item<?= $dark ?>" id="impressum" href="/kontakt/impressum.php">Impressum</a>
            </div>
        </li>
    </ul>
    <div class="d-inline">
    <select onchange="updateDesign(this)" class="form-control form-control-sm<?= ($darkMode) ? " bg-dark text-light" : "" ; ?>" id="designBox">
                <option <?= ($_COOKIE["darkmode"] == "false") ? "selected" : "" ?> value="0">Helles Design</option>
                <option <?= ($_COOKIE["darkmode"] == "true") ? "selected" : "" ?> value="1">Dunkles Design</option>
            </select>
            </div>
    </div>
    </nav>
    <!-- Hier Donation Button einfügen :D -->
<div class="p-2" id="hinweis">
</div>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
    
            <form action="/login?login" method="post" class="p-4">
                <div class="modal-header">
                    <h5 class="modal-title">Anmelden</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" autocomplete="email" placeholder="example@example.com">
                    </div>
                    <div class="form-group">
                        <label for="password">Passwort</label>
                        <input type="password" autocomplete="current-password" name="passwort" class="form-control" id="password" placeholder="Passwort">
                    </div>
            <!--    <div class="form-check">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input">
                        Angemeldet bleiben
                        </label>
                    </div> -->
                    <hr>
                    <p>Noch keinen Account? <a href="/register/guest">Jetzt Registrieren</a></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Anmelden</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                </div>
            </form>
        </div>
    </div>
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
                if (document.getElementById("hinweis").innerHTML == "") {
                    document.getElementById("hinweis").style.display = "none";
                } else {
                    document.getElementById("hinweis").style.display = "block";
                }
            }
        }
        xhr.open('GET', '/news.php', true);
        xhr.send(null);
    };
    news();
</script>