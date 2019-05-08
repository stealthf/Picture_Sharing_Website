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

/*--------------INSERT/delete系-------------------------------*/
//insert $array to a table, require connection object(returned from connect())
function insert($array,$table){
    $keys=join(',',array_keys($array));
    $values="'".join("','", array_values($array))."'";
    $sql="insert into {$table}({$keys}) VALUES ({$values})";
	//echo $sql.'<br />';
	$conn=connect();
    $res=$conn->query($sql);
    if($res){
		mysqli_close($conn);
        return true;
    }else{
		mysqli_close($conn);
        return false;
    }
}
//删除条目
function delete($table,$where=null){
    $where=$where==null?'':' WHERE '.$where;
    $sql="DELETE FROM {$table}{$where}";
	$conn=connect();
    $res=$conn->query($sql);
    if ($res){
        return true;
    }else {
        return false;
    }
}

//创建条目，id 为u（ser)/i(mage)/c(omment)/r(elation)加 时间戳后三位 加四位随机数
//注册，管理员权限（admin）默认为0
function register($username,$password){

	if(!verify_login($username,$password)){
		$uid ="u".substr(time(),-3,3).mt_rand(1000, 9999);
		$array=array(
		'uid'=>$uid,
		'username'=>$username,
		'password'=>md5($password),
		'reg_time'=>date("Y/m/d H:i:s"));
		if(insert($array,'user'))
			return $uid;
	}
	else{
		return false;
	}
}

function upload($img_name,$uploader){
	
	$iid ="i".substr(time(),-3,3).mt_rand(1000, 9999);
	$array=array(
	'iid'=>$iid,
	'img_name'=>$img_name,
	'upload_time'=>date("Y/m/d H:i:s"),
	'uploader'=>$uploader  );
	if(insert($array,'img'))
		return $iid;	
}
//评论
function comment($uid,$iid,$content){

	$array=array(
	'content'=>$content,
	'uid'=>$uid,
	'time'=>date("Y/m/d H:i:s"),
	'iid'=>$iid  );
	if(insert($array,'comment'))
		return true;	
}

//点赞，视作特殊评论
function like($uid,$iid){

	$array=array(
	'userId'=>$uid,
	'time'=>date("Y/m/d H:i:s"),
	'iid'=>$iid,);
	if(insert($array,'user_likes'))
		return true;	
}
//朋友，访问许可（clearance）默认为0
function relation($user,$friend,$category,$clearance){

	$array=array(
	'user'=>$user,
	'friend'=>$friend,
	'category'=>$category,
	'time'=>date("Y/m/d H:i:s"),
	'clearance'=>$clearance
	);
//	print_r($array);
	if(insert($array,'relation'))
		return true;	
}

/*--------------UPDATE系-------------------------------*/
//修改条目
function update($array,$table,$where=null){
    $sets='';
	foreach ($array as $key=>$val){
        $sets.=$key."='".$val."',";
    }
    $sets=rtrim($sets,','); 
    $where=$where==null?'':' WHERE '.$where;
    $sql="UPDATE {$table} SET {$sets} {$where}";
//	echo $sql."<br>";
	$conn=connect();
    $res=$conn->query($sql);
    if ($res){
		mysqli_close($conn);
        return true;
    }else {
		mysqli_close($conn);
        return false;
    }
}
//修改密码，需要uid和新密码，无验证
function change_password($username,$new_password){
	$new_password=md5($new_password);
	$array=array('password'=>$new_password);

	if($conn){echo "c<br>";}
	$table='user';
	$where="username='".$username."'";
	if(update($array,$table,$where))
	{
		echo $new_password;
	}
}
//
/*--------------SELECT系-------------------------------*/
//验证型---------------
//注册时检查username（已包含在register（））
function check_username($username){

	$sql="SELECT uid FROM user WHERE ";
	$sql.="username='".$username;


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


?>