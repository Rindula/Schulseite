<?php
    foreach ($_GET as $key => $value) {
        if(is_array($value)) {
            foreach ($value as $k => $v) {
                $str[] = urlencode($key."[]")."=".urlencode($v);
            }
        } else {
            $str[] = urlencode($key)."=".urlencode($value);
        }
    }
    $link = "generate.php?".join("&", $str);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entschuldigungformular</title>
    <script type="text/javascript">
        window.onload = function() {
            window.print();
        }
        window.onafterprint = function() {
            location.assign("/entschuldigungen");
        };
    </script>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        @media print {
            img {
                width: 100%;
                height: 100%;
                page-break-after: avoid;
                page-break-before: avoid;
                page-break-inside: avoid;
            }

        }
    </style>
</head>
<body>
    <img src="<?= $link ?>" alt="">
</body>
</html>