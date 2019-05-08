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

/*--------------INSERT/deleteϵ-------------------------------*/
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
//ɾ����Ŀ
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

//������Ŀ��id Ϊu��ser)/i(mage)/c(omment)/r(elation)�� ʱ�������λ ����λ�����
//ע�ᣬ����ԱȨ�ޣ�admin��Ĭ��Ϊ0
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
//����
function comment($uid,$iid,$content){

	$array=array(
	'content'=>$content,
	'uid'=>$uid,
	'time'=>date("Y/m/d H:i:s"),
	'iid'=>$iid  );
	if(insert($array,'comment'))
		return true;	
}

//���ޣ�������������
function like($uid,$iid){

	$array=array(
	'userId'=>$uid,
	'time'=>date("Y/m/d H:i:s"),
	'iid'=>$iid,);
	if(insert($array,'user_likes'))
		return true;	
}
//���ѣ�������ɣ�clearance��Ĭ��Ϊ0
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

/*--------------UPDATEϵ-------------------------------*/
//�޸���Ŀ
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
//�޸����룬��Ҫuid�������룬����֤
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
/*--------------SELECTϵ-------------------------------*/
//��֤��---------------
//ע��ʱ���username���Ѱ�����register������
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

//����û��������룬�����򷵻�uid
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