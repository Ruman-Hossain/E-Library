<?php
require_once('config.php');
$sql="SELECT *FROM admin WHERE id=1";
$stmt=$dbh->prepare($sql);
$stmt->execute();
$obj=$stmt->fetchObject();
//print_r($obj);
$admin=$obj->UserName;
//echo "<h1>Session User : ".$admin."</h1>";
?>  