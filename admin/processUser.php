<?php
$needAdmin = true;
include "../_hidden/verify.php";
include "../_hidden/vars.php";
if (isset($_POST["user"])) {
    $g = $_POST["gruppe"];
    $u = $_POST["user"];

    list($user, $pass) = array(DB_USER, DB_PASSWORD);
    $dbh = new PDO('mysql:host=localhost;dbname=stats', $user, $pass);
    $dbh->query('SET NAMES utf8');

    $sth = $dbh->prepare("UPDATE users SET gruppe = :gruppe WHERE id = :userid");

    $sth->bindParam(":gruppe", $g);
    $sth->bindParam(":userid", $u);

    $sth->execute();
}

if (isset($_POST["resetPass"])) {
    $u = $_POST["resetPass"];
    list($user, $pass) = array(DB_USER, DB_PASSWORD);
    $dbh = new PDO('mysql:host=localhost;dbname=stats', $user, $pass);
    $dbh->query('SET NAMES utf8');

    $sth = $dbh->prepare("UPDATE users SET passwort = :pass WHERE id = :userid");

    $tmpPass = generate_password(10);

    $sth->bindParam(":pass", password_hash("$tmpPass", PASSWORD_DEFAULT));
    $sth->bindParam(":userid", $u);

    $sth->execute();

    $empfaenger = $_POST["email"];
    $betreff = '=?UTF-8?B?'.base64_encode('Passwort zurückgesetzt | rindula.de').'?=';
    $nachricht = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
    <head>
    <!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <meta content="width=device-width" name="viewport"/>
    <!--[if !mso]><!-->
    <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
    <!--<![endif]-->
    <title></title>
    <!--[if !mso]><!-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css"/>
    <!--<![endif]-->
    <style type="text/css">
            body {
                margin: 0;
                padding: 0;
            }
    
            table,
            td,
            tr {
                vertical-align: top;
                border-collapse: collapse;
            }
    
            * {
                line-height: inherit;
            }
    
            a[x-apple-data-detectors=true] {
                color: inherit !important;
                text-decoration: none !important;
            }
    
            .ie-browser table {
                table-layout: fixed;
            }
    
            [owa] .img-container div,
            [owa] .img-container button {
                display: block !important;
            }
    
            [owa] .fullwidth button {
                width: 100% !important;
            }
    
            [owa] .block-grid .col {
                display: table-cell;
                float: none !important;
                vertical-align: top;
            }
    
            .ie-browser .block-grid,
            .ie-browser .num12,
            [owa] .num12,
            [owa] .block-grid {
                width: 500px !important;
            }
    
            .ie-browser .mixed-two-up .num4,
            [owa] .mixed-two-up .num4 {
                width: 164px !important;
            }
    
            .ie-browser .mixed-two-up .num8,
            [owa] .mixed-two-up .num8 {
                width: 328px !important;
            }
    
            .ie-browser .block-grid.two-up .col,
            [owa] .block-grid.two-up .col {
                width: 246px !important;
            }
    
            .ie-browser .block-grid.three-up .col,
            [owa] .block-grid.three-up .col {
                width: 246px !important;
            }
    
            .ie-browser .block-grid.four-up .col [owa] .block-grid.four-up .col {
                width: 123px !important;
            }
    
            .ie-browser .block-grid.five-up .col [owa] .block-grid.five-up .col {
                width: 100px !important;
            }
    
            .ie-browser .block-grid.six-up .col,
            [owa] .block-grid.six-up .col {
                width: 83px !important;
            }
    
            .ie-browser .block-grid.seven-up .col,
            [owa] .block-grid.seven-up .col {
                width: 71px !important;
            }
    
            .ie-browser .block-grid.eight-up .col,
            [owa] .block-grid.eight-up .col {
                width: 62px !important;
            }
    
            .ie-browser .block-grid.nine-up .col,
            [owa] .block-grid.nine-up .col {
                width: 55px !important;
            }
    
            .ie-browser .block-grid.ten-up .col,
            [owa] .block-grid.ten-up .col {
                width: 60px !important;
            }
    
            .ie-browser .block-grid.eleven-up .col,
            [owa] .block-grid.eleven-up .col {
                width: 54px !important;
            }
    
            .ie-browser .block-grid.twelve-up .col,
            [owa] .block-grid.twelve-up .col {
                width: 50px !important;
            }
        </style>
    <style id="media-query" type="text/css">
            @media only screen and (min-width: 520px) {
                .block-grid {
                    width: 500px !important;
                }
    
                .block-grid .col {
                    vertical-align: top;
                }
    
                .block-grid .col.num12 {
                    width: 500px !important;
                }
    
                .block-grid.mixed-two-up .col.num3 {
                    width: 123px !important;
                }
    
                .block-grid.mixed-two-up .col.num4 {
                    width: 164px !important;
                }
    
                .block-grid.mixed-two-up .col.num8 {
                    width: 328px !important;
                }
    
                .block-grid.mixed-two-up .col.num9 {
                    width: 369px !important;
                }
    
                .block-grid.two-up .col {
                    width: 250px !important;
                }
    
                .block-grid.three-up .col {
                    width: 166px !important;
                }
    
                .block-grid.four-up .col {
                    width: 125px !important;
                }
    
                .block-grid.five-up .col {
                    width: 100px !important;
                }
    
                .block-grid.six-up .col {
                    width: 83px !important;
                }
    
                .block-grid.seven-up .col {
                    width: 71px !important;
                }
    
                .block-grid.eight-up .col {
                    width: 62px !important;
                }
    
                .block-grid.nine-up .col {
                    width: 55px !important;
                }
    
                .block-grid.ten-up .col {
                    width: 50px !important;
                }
    
                .block-grid.eleven-up .col {
                    width: 45px !important;
                }
    
                .block-grid.twelve-up .col {
                    width: 41px !important;
                }
            }
    
            @media (max-width: 520px) {
    
                .block-grid,
                .col {
                    min-width: 320px !important;
                    max-width: 100% !important;
                    display: block !important;
                }
    
                .block-grid {
                    width: 100% !important;
                }
    
                .col {
                    width: 100% !important;
                }
    
                .col>div {
                    margin: 0 auto;
                }
    
                img.fullwidth,
                img.fullwidthOnMobile {
                    max-width: 100% !important;
                }
    
                .no-stack .col {
                    min-width: 0 !important;
                    display: table-cell !important;
                }
    
                .no-stack.two-up .col {
                    width: 50% !important;
                }
    
                .no-stack .col.num4 {
                    width: 33% !important;
                }
    
                .no-stack .col.num8 {
                    width: 66% !important;
                }
    
                .no-stack .col.num4 {
                    width: 33% !important;
                }
    
                .no-stack .col.num3 {
                    width: 25% !important;
                }
    
                .no-stack .col.num6 {
                    width: 50% !important;
                }
    
                .no-stack .col.num9 {
                    width: 75% !important;
                }
    
                .mobile_hide {
                    min-height: 0px;
                    max-height: 0px;
                    max-width: 0px;
                    display: none;
                    overflow: hidden;
                    font-size: 0px;
                }
            }
        </style>
    </head>
    <body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #FFFFFF;">
    <style id="media-query-bodytag" type="text/css">
    @media (max-width: 520px) {
      .block-grid {
        min-width: 320px!important;
        max-width: 100%!important;
        width: 100%!important;
        display: block!important;
      }
      .col {
        min-width: 320px!important;
        max-width: 100%!important;
        width: 100%!important;
        display: block!important;
      }
      .col > div {
        margin: 0 auto;
      }
      img.fullwidth {
        max-width: 100%!important;
        height: auto!important;
      }
      img.fullwidthOnMobile {
        max-width: 100%!important;
        height: auto!important;
      }
      .no-stack .col {
        min-width: 0!important;
        display: table-cell!important;
      }
      .no-stack.two-up .col {
        width: 50%!important;
      }
      .no-stack.mixed-two-up .col.num4 {
        width: 33%!important;
      }
      .no-stack.mixed-two-up .col.num8 {
        width: 66%!important;
      }
      .no-stack.three-up .col.num4 {
        width: 33%!important
      }
      .no-stack.four-up .col.num3 {
        width: 25%!important
      }
    }
    </style>
    <!--[if IE]><div class="ie-browser"><![endif]-->
    <table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; width: 100%;" valign="top" width="100%">
    <tbody>
    <tr style="vertical-align: top;" valign="top">
    <td style="word-break: break-word; vertical-align: top; border-collapse: collapse;" valign="top">
    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#FFFFFF"><![endif]-->
    <div style="background-color:transparent;">
    <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 500px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:500px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
    <!--[if (mso)|(IE)]><td align="center" width="500" style="background-color:transparent;width:500px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
    <div class="col num12" style="min-width: 320px; max-width: 500px; display: table-cell; vertical-align: top;;">
    <div style="width:100% !important;">
    <!--[if (!mso)&(!IE)]><!-->
    <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
    <!--<![endif]-->
    <div align="center" class="img-container center autowidth">
    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="" align="center"><![endif]--><img align="center" alt="Image rindula.de" border="0" class="center autowidth" src="https://files.rindula.de/img/logo.gif" style="outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; clear: both; border: 0; height: auto; float: none; width: 100%; max-width: 130px; display: block;" title="Image" width="130"/>
    <!--[if mso]></td></tr></table><![endif]-->
    </div>
    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: \'Trebuchet MS\', Tahoma, sans-serif"><![endif]-->
    <div style="color:#555555;font-family:\'Montserrat\', \'Trebuchet MS\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'Lucida Sans\', Tahoma, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
    <div style="font-size: 12px; line-height: 14px; font-family: \'Montserrat\', \'Trebuchet MS\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'Lucida Sans\', Tahoma, sans-serif; color: #555555;">
    <p style="font-size: 14px; line-height: 45px; text-align: center; margin: 0;"><span style="font-size: 38px;">Passwort zurückgesetzt</span></p>
    </div>
    </div>
    <!--[if mso]></td></tr></table><![endif]-->
    <table border="0" cellpadding="0" cellspacing="0" class="divider" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
    <tbody>
    <tr style="vertical-align: top;" valign="top">
    <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;" valign="top">
    <table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 1px solid #BBBBBB;" valign="top" width="100%">
    <tbody>
    <tr style="vertical-align: top;" valign="top">
    <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;" valign="top"><span></span></td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Arial, sans-serif"><![endif]-->
    <div style="color:#555555;font-family:Arial, \'Helvetica Neue\', Helvetica, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
    <div style="font-size: 12px; line-height: 14px; color: #555555; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;">
    <p style="font-size: 14px; line-height: 16px; margin: 0;">Hallo '.$_POST["name"].'</p>
    <p style="font-size: 14px; line-height: 16px; margin: 0;"> </p>
    <p style="font-size: 14px; line-height: 16px; margin: 0;">Dein Passwort wurde von einem Administrator zurückgesetzt. Bitte ändere es sofort, nachdem du dich angemeldet hast!</p>
    <p style="font-size: 14px; line-height: 16px; margin: 0;"> </p>
    <p style="font-size: 14px; line-height: 16px; margin: 0;">Du kannst dich weiterhin mit deiner E-Mail Adresse anmelden, musst aber jetzt dieses Passwort nutzen:</p>
    <p style="font-size: 14px; line-height: 16px; margin: 0;"> </p>
    <p style="font-size: 14px; line-height: 16px; margin: 0;"><b>'.$tmpPass.'</b></p>
    <p style="font-size: 14px; line-height: 16px; margin: 0;"> </p>
    <p style="font-size: 14px; line-height: 16px; margin: 0;">Dies ist eine automatische Nachricht. Wenn irgendwelche Fragen bestehen, kannst du auf diese Mail antworten.</p>
    </div>
    </div>
    <!--[if mso]></td></tr></table><![endif]-->
    <!--[if (!mso)&(!IE)]><!-->
    </div>
    <!--<![endif]-->
    </div>
    </div>
    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
    <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
    </div>
    </div>
    </div>
    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
    </td>
    </tr>
    </tbody>
    </table>
    <!--[if (IE)]></div><![endif]-->
    </body>
    </html>';
    $header = array(
        'From' => 'service@rindula.de',
        'Reply-To' => 'service@rindula.de',
        'X-Mailer' => 'PHP/' . phpversion(),
        'Content-Type' => 'text/html; charset=utf-8'
    );

    mail($empfaenger, $betreff, $nachricht, $header);
}

header("Location: usercontroll.php");
