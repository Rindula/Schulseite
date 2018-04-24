<!DOCTYPE html>
<html lang="de">

<?php
//$exitLink = "/hausaufgaben/show";
$needVerify = false;

// Verifikation des Clients
include "../_hidden/verify.php";

// Navigationsleiste
$page = "datenschutz";
include "../navbar.php";

// Global Header
$title="Datenschutzerklärung";
include "../header.php";

// Benötigte Variablen
include "../_hidden/vars.php";

// CSS Controller
include "../css/controller.php";


?>

<body class="container">
    <div>
    <h1>Datenschutzerklärung</h1>
    <h2>Erfassung allgemeiner Informationen</h2>
    <p>Wenn Sie auf unsere Webseite zugreifen, werden automatisch Informationen allgemeiner Natur erfasst. Diese Informationen
        (Server-Logfiles) beinhalten etwa die Art des Webbrowsers, das verwendete Betriebssystem, den Domainnamen Ihres Internet
        Service Providers und Ähnliches. Hierbei handelt es sich ausschließlich um Informationen, welche keine Rückschlüsse
        auf Ihre Person zulassen. Diese Informationen sind technisch notwendig, um von Ihnen angeforderte Inhalte von Webseiten
        korrekt auszuliefern und fallen bei Nutzung des Internets zwingend an. Anonyme Informationen dieser Art werden von
        uns statistisch ausgewertet, um unseren Internetauftritt und die dahinterstehende Technik zu optimieren.</p>
    <h2>Cookies</h2>
    <p>Wie viele andere Webseiten verwenden wir auch so genannte „Cookies“. Cookies sind kleine Textdateien, die von einem Webseitenserver
        auf Ihre Festplatte übertragen werden. Hierdurch erhalten wir automatisch bestimmte Daten wie z. B. IP-Adresse, verwendeter
        Browser, Betriebssystem über Ihren Computer und Ihre Verbindung zum Internet.</p>
    <p>Cookies können nicht verwendet werden, um Programme zu starten oder Viren auf einen Computer zu übertragen. Anhand der
        in Cookies enthaltenen Informationen können wir Ihnen die Navigation erleichtern und die korrekte Anzeige unserer
        Webseiten ermöglichen.</p>
    <p>In keinem Fall werden die von uns erfassten Daten an Dritte weitergegeben oder ohne Ihre Einwilligung eine Verknüpfung
        mit personenbezogenen Daten hergestellt.</p>
    <p>Natürlich können Sie unsere Website grundsätzlich auch ohne Cookies betrachten. Internet-Browser sind regelmäßig so eingestellt,
        dass sie Cookies akzeptieren. Sie können die Verwendung von Cookies jederzeit über die Einstellungen Ihres Browsers
        deaktivieren. Bitte verwenden Sie die Hilfefunktionen Ihres Internetbrowsers, um zu erfahren, wie Sie diese Einstellungen
        ändern können. Bitte beachten Sie, dass einzelne Funktionen unserer Website möglicherweise nicht funktionieren, wenn
        Sie die Verwendung von Cookies deaktiviert haben.</p>
    <h2>Registrierung auf unserer Webseite</h2>
    <p>Bei der Registrierung für die Nutzung unserer personalisierten Leistungen werden einige personenbezogene Daten erhoben,
        wie Name, Anschrift, Kontakt- und Kommunikationsdaten wie Telefonnummer und E-Mail-Adresse. Sind Sie bei uns registriert,
        können Sie auf Inhalte und Leistungen zugreifen, die wir nur registrierten Nutzern anbieten. Angemeldete Nutzer haben
        zudem die Möglichkeit, bei Bedarf die bei Registrierung angegebenen Daten jederzeit zu ändern oder zu löschen. Selbstverständlich
        erteilen wir Ihnen darüber hinaus jederzeit Auskunft über die von uns über Sie gespeicherten personenbezogenen Daten.
        Gerne berichtigen bzw. löschen wir diese auch auf Ihren Wunsch, soweit keine gesetzlichen Aufbewahrungspflichten
        entgegenstehen. Zur Kontaktaufnahme in diesem Zusammenhang nutzen Sie bitte die im Impressum angegebenen Kontaktdaten.</p>
    <h2>SSL-Verschlüsselung</h2>
    <p>Um die Sicherheit Ihrer Daten bei der Übertragung zu schützen, verwenden wir dem aktuellen Stand der Technik entsprechende
        Verschlüsselungsverfahren (z. B. SSL) über HTTPS.</p>
    <h2>Newsletter</h2>
    <p>Bei der Anmeldung zum Bezug unseres Newsletters werden die von Ihnen angegebenen Daten ausschließlich für diesen Zweck
        verwendet. Abonnenten können auch über Umstände per E-Mail informiert werden, die für den Dienst oder die Registrierung
        relevant sind (Beispielsweise Änderungen des Newsletterangebots oder technische Gegebenheiten).</p>
    <p>Für eine wirksame Registrierung benötigen wir eine valide E-Mail-Adresse. Um zu überprüfen, dass eine Anmeldung tatsächlich
        durch den Inhaber einer E-Mail-Adresse erfolgt, setzen wir das „Double-opt-in“-Verfahren ein. Hierzu protokollieren
        wir die Bestellung des Newsletters, den Versand einer Bestätigungsmail und den Eingang der hiermit angeforderten
        Antwort. Weitere Daten werden nicht erhoben. Die Daten werden ausschließlich für den Newsletterversand verwendet
        und nicht an Dritte weitergegeben.</p>
    <p>Die Einwilligung zur Speicherung Ihrer persönlichen Daten und ihrer Nutzung für den Newsletterversand können Sie jederzeit
        widerrufen. In jedem Newsletter findet sich dazu ein entsprechender Link. Außerdem können Sie sich jederzeit auch
        direkt auf dieser Webseite abmelden oder uns Ihren entsprechenden Wunsch über die im Impressum angegebene Kontaktmöglichkeit mitteilen.</p>
    <h2>Verwendung von Scriptbibliotheken (Google Webfonts)</h2>
    <p>Um unsere Inhalte browserübergreifend korrekt und grafisch ansprechend darzustellen, verwenden wir auf dieser Website
        Scriptbibliotheken und Schriftbibliotheken wie z. B. Google Webfonts (
        <a href="http://www.google.com/webfonts/">https://www.google.com/webfonts/</a>). Google Webfonts werden zur Vermeidung mehrfachen Ladens in den Cache Ihres
        Browsers übertragen. Falls der Browser die Google Webfonts nicht unterstützt oder den Zugriff unterbindet, werden
        Inhalte in einer Standardschrift angezeigt.</p>
    <p>Der Aufruf von Scriptbibliotheken oder Schriftbibliotheken löst automatisch eine Verbindung zum Betreiber der Bibliothek
        aus. Dabei ist es theoretisch möglich – aktuell allerdings auch unklar ob und ggf. zu welchen Zwecken – dass Betreiber
        entsprechender Bibliotheken Daten erheben.</p>
    <p>Die Datenschutzrichtlinie des Bibliothekbetreibers Google finden Sie hier:
        <a href="https://www.google.com/policies/privacy/">https://www.google.com/policies/privacy/</a>
    </p>
    <h2>Eingebettete YouTube-Videos</h2>

    <p>Auf einigen unserer Webseiten betten wir Youtube-Videos ein. Betreiber der entsprechenden Plugins ist die YouTube, LLC,
        901 Cherry Ave., San Bruno, CA 94066, USA. Wenn Sie eine Seite mit dem YouTube-Plugin besuchen, wird eine Verbindung
        zu Servern von Youtube hergestellt. Dabei wird Youtube mitgeteilt, welche Seiten Sie besuchen. Wenn Sie in Ihrem
        Youtube-Account eingeloggt sind, kann Youtube Ihr Surfverhalten Ihnen persönlich zuzuordnen. Dies verhindern Sie,
        indem Sie sich vorher aus Ihrem Youtube-Account ausloggen.</p>
    <p>Wird ein Youtube-Video gestartet, setzt der Anbieter Cookies ein, die Hinweise über das Nutzerverhalten sammeln.</p>
    <p>Wer das Speichern von Cookies für das Google-Ad-Programm deaktiviert hat, wird auch beim Anschauen von Youtube-Videos
        mit keinen solchen Cookies rechnen müssen. Youtube legt aber auch in anderen Cookies nicht-personenbezogene Nutzungsinformationen
        ab. Möchten Sie dies verhindern, so müssen Sie das Speichern von Cookies im Browser blockieren.</p>
    <p>Weitere Informationen zum Datenschutz bei „Youtube“ finden Sie in der Datenschutzerklärung des Anbieters unter:
        <a href="https://www.google.de/intl/de/policies/privacy/">https://www.google.de/intl/de/policies/privacy/ </a>
    </p>
    <h2>Social Plugins</h2>
    <p>Auf unseren Webseiten werden Social Plugins der unten aufgeführten Anbieter eingesetzt. Die Plugins können Sie daran
        erkennen, dass sie mit dem entsprechenden Logo gekennzeichnet sind.</p>
    <p>Über diese Plugins werden unter Umständen Informationen, zu denen auch personenbezogene Daten gehören können, an den
        Dienstebetreiber gesendet und ggf. von diesem genutzt. Wir verhindern die unbewusste und ungewollte Erfassung und
        Übertragung von Daten an den Diensteanbieter durch eine 2-Klick-Lösung. Um ein gewünschtes Social Plugin zu aktivieren,
        muss dieses erst durch Klick auf den entsprechenden Schalter aktiviert werden. Erst durch diese Aktivierung des Plugins
        wird auch die Erfassung von Informationen und deren Übertragung an den Diensteanbieter ausgelöst. Wir erfassen selbst
        keine personenbezogenen Daten mittels der Social Plugins oder über deren Nutzung.</p>
    <p>Wir haben keinen Einfluss darauf, welche Daten ein aktiviertes Plugin erfasst und wie diese durch den Anbieter verwendet
        werden. Derzeit muss davon ausgegangen werden, dass eine direkte Verbindung zu den Diensten des Anbieters ausgebaut
        wird sowie mindestens die IP-Adresse und gerätebezogene Informationen erfasst und genutzt werden. Ebenfalls besteht
        die Möglichkeit, dass die Diensteanbieter versuchen, Cookies auf dem verwendeten Rechner zu speichern. Welche konkreten
        Daten hierbei erfasst und wie diese genutzt werden, entnehmen Sie bitte den Datenschutzhinweisen des jeweiligen Diensteanbieters.
        Hinweis: Falls Sie zeitgleich bei Facebook angemeldet sind, kann Facebook Sie als Besucher einer bestimmten Seite
        identifizieren.</p>
    <p>Wir haben auf unserer Website die Social-Media-Buttons folgender Unternehmen eingebunden:</p>
    <p>Whatsapp</p>
    <h2>
        <strong>Ihre Rechte auf Auskunft, Berichtigung, Sperre, Löschung und Widerspruch</strong>
    </h2>
    <p>Sie haben das Recht, jederzeit Auskunft über Ihre bei uns gespeicherten personenbezogenen Daten zu erhalten. Ebenso haben
        Sie das Recht auf Berichtigung, Sperrung oder, abgesehen von der vorgeschriebenen Datenspeicherung zur Geschäftsabwicklung,
        Löschung Ihrer personenbezogenen Daten. Bitte wenden Sie sich dazu an unseren Datenschutzbeauftragten. Die Kontaktdaten
        finden Sie im Impressum.</p>
    <p>Damit eine Sperre von Daten jederzeit berücksichtigt werden kann, müssen diese Daten zu Kontrollzwecken in einer Sperrdatei
        vorgehalten werden. Sie können auch die Löschung der Daten verlangen, soweit keine gesetzliche Archivierungsverpflichtung
        besteht. Soweit eine solche Verpflichtung besteht, sperren wir Ihre Daten auf Wunsch.</p>
    <p>Sie können Änderungen oder den Widerruf einer Einwilligung durch entsprechende Mitteilung an uns mit Wirkung für die
        Zukunft vornehmen.</p>
    <h2>
        <strong>Änderung unserer Datenschutzbestimmungen</strong>
    </h2>
    <p>Wir behalten uns vor, diese Datenschutzerklärung gelegentlich anzupassen, damit sie stets den aktuellen rechtlichen Anforderungen
        entspricht oder um Änderungen unserer Leistungen in der Datenschutzerklärung umzusetzen, z. B. bei der Einführung
        neuer Services. Für Ihren erneuten Besuch gilt dann die neue Datenschutzerklärung.</p>
    </div>
    <?php include "../_hidden/bottomScripts.php" ?>

</body>

</html>