<?php
session_start();

date_default_timezone_set('Asia/Hong_Kong'); 
//$_SESSION['uid'] = "a1";
$_SESSION['lasttime'] = date("Y/m/d H:i:s",time());

require_once 'notification.php';
notification($_SESSION['lasttime'],$_SESSION['uid']);

$_SESSION['lasttime'] = date("Y/m/d H:i:s",time());

//$_SESSION['username'] = "11";
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
		<script type="text/javascript">
		function LogOut() {
			window.location.href = "logout.php";
		}
	  	function showPicture(f) {
		var xmlHttp;
		xmlHttp = new XMLHttpRequest();

		xmlHttp.onreadystatechange = function() {
			if(xmlHttp.readyState == 4) {
				document.getElementById('photos').innerHTML = xmlHttp.responseText;
			}
		}

		url = "getPhoto.php?username=" + f.innerHTML;

		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
        
       
	    return false;
	}
</script>
		<script type="text/javascript">
	  	function showPicture2(f) {
		var xmlHttp;
		xmlHttp = new XMLHttpRequest();

		xmlHttp.onreadystatechange = function() {
			if(xmlHttp.readyState == 4) {
				document.getElementById('photos').innerHTML = xmlHttp.responseText;
			}
		}

		url = "getPhoto.php?username=" + f;

		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
		return false;
	}
</script>

</head>
<body onload = "showPicture2('<?php echo $_GET['friend']?>')">
<input type = "button" onclick = "location.href = 'userview.php'" value = "Back">
<input type = "button" onclick = "LogOut()" value = "Log Out">
<?php

$conn = mysqli_connect("localhost", "root", "","project_db");
    if ($conn->connect_error)  
    {
		echo "Unable to connect to database";
	   	exit;
    }

$name = $_SESSION['username'];



$query = "select username from user where uid in (select friend from relation where user in (select uid from user where username = \"".$name."\"))";
$result = $result = $conn->query($query);
if(!$result) die("");
else {
	echo "<h2>Friend List: </h2><div style = 'float:left'>";
	echo "<ul>";
	while($row = mysqli_fetch_array($result)){
		echo "<li onclick = showPicture(this)>".$row['username']."</li>";
	}
	
	echo "</ul></div>";
}

?>

<div id = "photos"></div>


</body>
</html>