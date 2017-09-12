<?php
    $get = $_GET;
    
    function status($msg) {
        print("echo :: ".$msg."\n");
    }
    function run($cmd) {
        print($cmd." > /dev/null 2>&1\n");
    }
    function runO($cmd) {
        print($cmd."\n");
    }
if(!isset($get["s"])) {
    runO("clear");
    print("echo \"/-----------------\\\\\"\n");
    print("echo \"|-Made by Rindula-|\"\n");
    print("echo \"\\\\-----------------/\"\n");
    print("echo \"\"\n");
}
$pakete = "apache2 php5 php5-common php5-mysql libapache2-mod-php5 php5-cli php5-cgi php-pear samba mysql-client mysql-server mysql-common unclutter xdotool";

    if (!isset($_GET) || empty($_GET))
    {
        runO("echo \"Folgende Optionen sind verfügbar:\"");
        runO("PS3=\"\"");
        runO("options=(\"install\" \"reinstall\" \"apacheSetup\" \"sambaSetup\" \"update\")");
        runO("select auswahl in \"\${options[@]}\"");
        runO("do");
        runO("echo \"Ihre Auswahl war : \$auswahl\"");
        runO("done");
    }
    if(isset($get["reinstall"])) {
        runO("curl -sSL 213.202.252.221/scripts/download.php?backup\&s | bash");
        status("Deinstalliere Pakete");
        run("sudo apt-get purge -y $pakete");  
        status("Säubere verbliebene Daten");
        run("sudo apt-get autoremove -y");
        run("sudo apt-get autoclean -y");
        status("Starte Neuinstallation");
        runO("curl -sSL 213.202.252.221/scripts/download.php?install\&s | bash");
    }
    if(isset($get["backup"])) {
        status("Backup - Noch nicht verf�gbar!");
    }
    if(isset($get["install"])) {
        runO("curl -sSL 213.202.252.221/scripts/download.php?update\&s | bash");
        status("Installiere Aliasse");
        runO("echo \"alias install='sudo apt-get install'\" > ~/.bash_aliases");
        runO("echo \"alias reboot='sudo reboot'\" >> ~/.bash_aliases");
        status("Installiere Pakete");
        runO("sudo apt-get install -qq -y $pakete");
        status("Hole Backup");
        runO("wget -c 213.202.252.221/scripts/download/backup.tar -q --show-progress");
        status("Entpacke Backup");
        run("tar -xf backup.tar");
        status("Leere benötigte Verzeichnisse");
        run("sudo rm -r /var/www/html/");
        status("Verteile Backup");
        run("sudo mv BACKUP/html /var/www/");
        run("sudo mv BACKUP/mpd /var/www/");
        run("sudo mv BACKUP/TS3Bot /var/www/");
        run("sudo mysql -u root -pSiSal2002 < BACKUP/localhost.sql");
        status("Aufräumen");
        run("sudo rm backup.tar");
        run("sudo rm -r BACKUP/");
        runO("curl -sSL 213.202.252.221/scripts/download.php?apacheSetup\&s | bash");
        runO("curl -sSL 213.202.252.221/scripts/download.php?sambaSetup\&s | bash");
        runO("curl -sSL 213.202.252.221/scripts/download.php?update\&s | bash");
        status();
        status("Installation abgeschlossen");
        status("Starte neu");
        run("sudo reboot");
    }
    if(isset($get["apacheSetup"])) {
        status("Installiere Apache, wenn nicht vorhanden");
        run("sudo apt-get install apache2 php5 php5-common php5-mysql libapache2-mod-php5 php5-cli php5-cgi php-pear");
        status("Lösche alte Konfiguration");
        runO("sudo rm /etc/apache2/apache2.conf");
        status("Installiere neue Konfiguration");
        runO("wget 213.202.252.221/scripts/download/apache2.html -q --show-progress");
        runO("sudo mv apache2.html /etc/apache2/apache2.conf");
        status("Schalte Apache 2 Rewrite Engine an");
        runO("sudo a2enmod rewrite");
        status("Restarte Webserver");
        runO("sudo service apache2 restart");
        status("Apache Fertig");
    }
    if(isset($get["update"])) {
        status("Aktualisiere Paketlisten");
        run("sudo apt-get update -y");
        status("Aktualisiere System");
        run("sudo apt-get upgrade -y");
        status("Säubere veraltete Pakete");
        run("sudo apt-get autoremove -y");
        run("sudo apt-get autoclean -y");
    }
    if(isset($get["sambaSetup"])) {
        status("Installiere Samba, wenn nicht vorhanden");
        run("sudo apt-get install samba");
        status("Lösche alte Konfiguration");
        run("sudo rm /etc/samba/smb.conf");
        status("Installiere neue Konfiguration");
        runO("wget 213.202.252.221/scripts/download/smb.html -q --show-progress");
        run("sudo mv smb.html /etc/samba/smb.conf");
        status("Restarte Samba");
        run("sudo service smbd restart");
        status("Füge Nutzer hinzu");
        runO("echo \"default\" > tmp.dat");
        runO("echo \"default\" >> tmp.dat");
        run("sudo smbpasswd -x rindula");
        run("sudo adduser --no-create-home --disabled-login --shell /bin/false rindula");
        run("sudo smbpasswd -a rindula < tmp.dat");
        run("sudo rm tmp.dat");
        status("Restarte Samba");
        run("sudo service smbd restart");
        status("Samba Fertig");
    }
?>