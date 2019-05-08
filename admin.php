<!DOCTYPE html>
<html>
<head>
	<title>Manager Panel</title>
	<script type="text/javascript">
		function trydelete(te){
			var uid=te.value;
			var xmlHttp;				
			try{xmlHttp= new XMLHttpRequest();
			}catch(e){
				try{
				xmlHttp= new ActiveXObject("Msxml2.XMLHTTP");
				}catch(e){
					try{
					xmlHttp= new ActiveXObject("Microsoft.XMLHTTP");
					}catch(e){
					alert("Error!");return false;
					}
				}
			}
						
				var flag;				
				var url="delete.php?id="+uid;
				xmlHttp.onreadystatechange=function(){
					if(xmlHttp.readyState==4){					
						flag = xmlHttp.responseText;	
						if(flag=="success"){
						alert("Delete successfully!");
						window.location.href="admin.php";
						}else{
						alert("ERROR");
						}						
					}
				}
				xmlHttp.open("GET",url,true);
				xmlHttp.send(null);								       
		}	
		
	</script>
</head>
<body>
<?php	
	session_start();
	if($_SESSION["admin"]=="1"){
		echo "<a href='login.php'>Back</a>";
		$conn = mysqli_connect("localhost", "root", "","project_db");
   		if ($conn->connect_error)  {
			alert("Unable to connect to database");
		   	exit;
		} 
  		
    		$query = "select uid,username,reg_time from user";    
    		$result = $conn->query($query);
			$result->data_seek(0);
		echo "<h3>Account Management</h3>";
		echo "<table border='1'>";
		echo "<td>User_id</td>";
		echo "<td>Account</td>";
		echo "<td>Date</td>";
		while ($row = $result->fetch_assoc())  {
			echo "<tr>";
			echo "<td>".$row['uid']."<button onclick='trydelete(this)' value='".$row['uid']."&type=user'>Delete</button></td>";
			echo "<td>".$row["username"]."</td>";
			echo "<td>".$row["reg_time"]."</td>";
			echo "</tr>";
		}    	
   		$result->free();
		
		
			$query2 = "select iid,img_name,upload_time,uploader from img";    
    		$result2 = $conn->query($query2);
			$result2->data_seek(0);				
		echo "<table border='1'>";
		echo "<td>Image_id</td>";
		echo "<td>Image_name</td>";
		echo "<td>Date</td>";
		echo "<td>Uploader</td>";
		while ($row2 = $result2->fetch_assoc())  {
			echo "<tr>";
			echo "<td>".$row2['iid']."<button onclick='trydelete(this)' value='".$row2['iid']."&type=img'>Delete</button></td>";
			echo "<td>".$row2["img_name"]."</td>";
			echo "<td>".$row2["upload_time"]."</td>";
			echo "<td>".$row2["uploader"]."</td>";
			echo "</tr>";
		}    	
   		$result2->free();
		echo "<hr/>";
		echo "<h3>Image Management</h3>";

		
			$query3 = "select cid,content,uid,iid from comment";    
    		$result3 = $conn->query($query3);
			$result3->data_seek(0);				
		echo "<table border='1'>";
		echo "<td>Comment_id</td>";
		echo "<td>Content</td>";
		echo "<td>User id</td>";
		echo "<td>Image id</td>";
		while ($row3 = $result3->fetch_assoc())  {
			echo "<tr>";
			echo "<td>".$row3['iid']."<button onclick='trydelete(this)' value='".$row3['cid']."&type=comment'>Delete</button></td>";
			echo "<td>".$row3["content"]."</td>";
			echo "<td>".$row3["uid"]."</td>";
			echo "<td>".$row3["iid"]."</td>";
			echo "</tr>";
		}    	
   		$result3->free();
		echo "<hr/>";
		echo "<h3>Comment Management</h3>";		
					
   		$conn->close();
	}else{
		echo"<h1>Please login first!</h1>";
		echo "<a href='login.php'>Back</a>";
	}
?>
	</form>
</body>
</html>