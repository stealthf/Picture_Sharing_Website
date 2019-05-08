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

//创建条目，id 为u（ser)/i(mage)/c(omment)/r(elation)加 时间戳后三位 加四位随机数
//注册，管理员权限（admin）默认为0
function register($username,$password){
	$conn=connect();
	if(!verify_login($username,$password)){
		$uid ="u".substr(time(),-3,3).mt_rand(1000, 9999);
		$array=array('uid'=>$uid,'username'=>$username,'password'=>md5($password),'reg_time'=>date("Y/m/d"));
		if(insert($array,'user',$conn))
			return $uid;
	}
	else{
		return false;
	}
}

/*--------------INSERT系-------------------------------*/
//insert $array to a table, require connection object(returned from connect())
function insert($array,$table,$conn){
    $keys=join(',',array_keys($array));
    $values="'".join("','", array_values($array))."'";
    $sql="insert into {$table}({$keys}) VALUES ({$values})";
    $res=$conn->query($sql);
    if($res){
		mysqli_close($conn);
        return true;
    }else{
		mysqli_close($conn);
        return false;
    }
}		

//检查用户名和密码，符合则返回uid
function verify_login($username,$password){
	$password=md5($password);
	$sql="SELECT uid FROM user WHERE ";
	$sql.="username='".$username."' AND ";
	$sql.="password='".$password."'";

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
									
	$user=$_GET["user"];
	$password=$_GET["password"];
	if(register($user,$password)){
		echo "yes";
	}else{
		echo "no";
	}
?>