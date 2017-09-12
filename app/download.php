<?
$fileN = basename($_GET['file']);
$file = './download/'.$fileN;

if(!$file){ // file does not exist
    die('file not found');
} else {
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=\"$fileN\"");
    header("Content-Type: application/vnd.android.package-archive");
    header("Content-Transfer-Encoding: binary");
    header('Content-Length: ' . filesize($file));

    // read the file from disk
    readfile($file);
}
?>