<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .container {
            overflow: hidden;
            background-color: #333;
            font-family: Arial;
        }

        .container a {
            float: left;
            font-size: 16px;
            color: #cc3300;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            transition: .2s all;
        }

        .dropdown {
            float: left;
            overflow: hidden;
        }

        .dropdown .dropbtn {
            float: none;
            font-size: 16px;
            color: #cc3300;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            transition: .2s all;
            background-color: inherit;
            border: none;
            outline: none;
        }

        .container a:hover:not(.disabled), .dropdown:hover .dropbtn:not(.disabled) {
            opacity: 0.7;
        }

        .container .hr {
            border: 1px solid black;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover:not(.disabled) {
            opacity: 0.7;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .right {
            float: right;
            text-align: right;
        }

        .disabled {
            opacity: 0.5;
            cursor: default;
            pointer-events: none;
        }
    </style>
</head>

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
            <a href="/app">App</a>
        </div>
    </div>
    <?php
    if ($loggedIn) {
        ?>
        <a href="/hausaufgaben/enter">Eintragen</a>
        <div class="dropdown right" style="margin-right: 75px;">
            <button class="dropbtn"><?= $_SESSION["name"] ?></button>
            <div class="dropdown-content">
                <a href="/settings">Einstellungen</a>
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
    <div>
        <form class="right" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="2LWMW9PABC4XS">
            <input type="image" src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="Jetzt einfach, schnell und sicher online bezahlen – mit PayPal.">
            <img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
        </form>
    </div>
</div>
