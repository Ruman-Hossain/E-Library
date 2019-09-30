<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'] || $_SESSION['alogin'])==0)
{   
    header('location:index.php');
}
else{ 
        $contentid = intval($_GET['contentid']);
        $stat = $dbh->prepare("select * from contents where id=:contentid");
        $stat->bindParam(':contentid', $contentid,PDO::PARAM_STR);
        $stat->execute();
        $data = $stat->fetch(PDO::FETCH_OBJ);

        $file = 'files/'.$data->file;

        if(file_exists($file)){
            header('Content-Description: '. $data['description']);
            header('Content-Type: '.$data['type']);
            header('Content-Disposition: '.$data['disposition'].'; filename="'.basename($file).'"');
            header('Expires: '.$data['expires']);
            header('Cache-Control: '.data['cache']);
            header('Pragma: '.$data['pragma']);
            header('Content-Length: '.filesize($file));
            readfile($file);
            exit;
        }

}

?>