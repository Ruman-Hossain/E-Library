<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'] || $_SESSION['alogin'])==0)
{   
	header('location:../adminlogin.php');
}
else{ 
	$contentid=intval($_GET['contentid']);
	//echo $contentid;
	$sql="SELECT  *FROM contents WHERE id=:contentid";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':contentid',$contentid, PDO::PARAM_STR);
	$query -> execute();
	//print_r($results);
	if($query->rowCount() > 0)
	{
			$results=$query->fetch(PDO::FETCH_ASSOC);
			//print_r($results);
			$file=$results['file'];
			$content=$results['contentName'];
			//echo $file;
			$filename=$results['file'];
			$supported_image = array('gif','jpg','jpeg','png');
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			if (in_array($ext, $supported_image)){
				/*if($ext=='jpg'){
					header('Content-type: image/jpg');
				}
				else if($ext=='jpeg'){
					header('Content-type: image/jpeg');
				}
				else if($ext=='png'){
					header('Content-type: image/png');
				}
				else{
					echo "Nothing Found";
				}*/
				//echo "<br>File is an Image<br>";
				//echo "<img src='$file' width='100%' height='100%' alt=".$content.">";
				echo "<script type='text/javascript'> document.location ='$file'; </script>";
				//exit();
			}
			else{
				header('Content-type: application/pdf');
				header('Content-Disposition:inline;filename=$filename');
				header('Content-Transfer-Encoding:binary');
				header('Accept-Ranges:bytes');
				@readfile($file);
			}
		
	}
}

?>