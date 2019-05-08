<?php	
//Connect to database "project_db",return connection object
function connect(){
    $conn=@mysqli_connect('localhost','root','','project_db') or die ('Fail to connect database');
	if ($conn->connect_error)  {
	echo "Unable to connect to database";
   	exit;
	}
	return $conn;
}
	
//检查用户名和密码，符合则返回uid;不符合返回false；管理员返回1
function verify_login($username,$password){
	$password = md5($password);
	$sql="SELECT uid,admin FROM user WHERE ";
	$sql.="username='".$username."' AND ";
	$sql.="password='".$password."'";

	$conn=connect();
	$res=$conn->query($sql);
	if($res){
		$row = $res->fetch_array(MYSQLI_ASSOC);
		mysqli_close($conn);
		if($row['admin']==1)
		{return 1;}
		else
        {return $row['uid'];}
    }else {
		mysqli_close($conn);
        return false;
    }
}

//检查用户名，符合则返回uid
function verify_username($username,$password){
	$password = md5($password);
	$sql="SELECT uid FROM user WHERE ";
	$sql.="username='".$username."'";
	
	$conn=connect();
	$res=$conn->query($sql);
	if($res){
		$row = $res->fetch_array(MYSQLI_ASSOC);
		mysqli_close($conn);
        return $row['uid'];
    }else {
		mysqli_close($conn);
        return false;
    }
}
									
	$user = $_GET["user"];
	$password=$_GET["password"];
	if(verify_username($user,$password)){
		if(verify_login($user,$password)){
			if(verify_login($user,$password)==1)
			{echo "1";}
			else
			{echo "yes";}
			
		}else{
			echo "incorrectpassword";
		}	
	}else{
		echo "nouser";
	}
?>