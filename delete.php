<?php
		$in=$_GET["id"];
		$type=$_GET["type"];
		$conn = mysqli_connect("localhost", "root", "","project_db");
   		if ($conn->connect_error)  {
			alert("Unable to connect to database");
		   	exit;
		}   
			if($type=="user"){
				$query = "DELETE from user where uid='$in'";    
				$result = $conn->query($query);
				if($result==true)
				echo"success";
				else echo"fail";}
			else if($type=="img"){
				$query = "DELETE from img where iid='$in'";    
				$result = $conn->query($query);
				if($result==true)
				echo"success";
				else echo"fail";
				
			}else if($type=="comment"){
				$query = "DELETE from comment where cid='$in'";    
				$result = $conn->query($query);
				if($result==true)
				echo"success";
				else echo"fail";
				
			}else echo "fail";
?>