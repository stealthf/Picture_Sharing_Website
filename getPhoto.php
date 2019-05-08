<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
div.img
{
/*	display:inline;*/
	margin:10px;
	border:1px solid #bebebe;
	float:left;
	text-align:center;
}
img
{
/*	display:inline;*/
	margin:5px;
	border:1px solid #bebebe;
}


div.absolute{
	 position: absolute;
    left: 150px;
}

<div class="img">
  <img src="" width="400" height="400">
  
</div>

<div class="img">
  <img src="" width="400" height="400">
  
</div>
</style>

<script type="text/javascript">

</script>
</head>
<body>




<?php
    

    $uploader = $_GET['username'];
    

	$conn = mysqli_connect("localhost", "root", "","project_db");
    if ($conn->connect_error)  
    {
		echo "Unable to connect to database";
	   	exit;
    }

	$query = "select iid from img,user where img.uploader = user.uid and user.username = \"$uploader\"";

	$result = $result = $conn->query($query);

	$query2 = "select clearance from relation where user in (select uid from user where username = \"$uploader\") and friend = \"".$_SESSION['uid']."\"";
	$result2 = $conn->query($query2);
    
    if(!$result) die("");
    else {
       while($row = mysqli_fetch_array($result2)) {
       	if($row['clearance'] == 1) {
            echo "<br><h1 style = 'text-align:center;color:red'>You have no access to those photos</h1>";
       	} else {
       		    echo "<h2 style='text-align:center'>Photos shared by ".$uploader."</h2><div class = 'absolute'>";
       			if(!$result) die("");
		else {

		while($row = mysqli_fetch_array($result)){
			echo "<div class=\"img\"><a href = 'picture.php?id=".$row['iid']."'><img src = \"img/".$row['iid'].".jpg\" height = '200' width = '200'></a></div></form>";
			

		}
		echo "</div>";
	}

       	}
      }
   
  }


?>
</body>
</html>