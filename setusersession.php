<?php
session_start();
date_default_timezone_set('Asia/Hong_Kong');
$name=$_GET["username"];
$_SESSION["username"]=$name;
$lasttime=date("Y/m/d H:i:s",time());
$_SESSION["lastime"]=date("y-m-d h:i:s");
$_SESSION['loginflag'] = true;

    $conn = mysqli_connect("localhost", "root", "","project_db");
   		if ($conn->connect_error)  {
			alert("Unable to connect to database");
		   	exit;
		}  		
    		$query = "select uid from user where username='$name'";
    		$result = $conn->query($query);
			$result->data_seek(0);
			while ($row = $result->fetch_assoc())  {
			$_SESSION["uid"] = $row["uid"];
		}    	
   		$result->free();
header('location:userview.php');
?>