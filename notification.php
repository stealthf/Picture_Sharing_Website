<?php	
	require_once 'project_select.php'; 
	function notification($last_time,$uid)
	{

//	$last_time=date("Y/m/d H:i:s",$last_time);


//	$last_time="2016/11/24 12:53:31";
//	$uid="u4114047";
	
	$sql_c="SELECT * FROM comment where time>'".$last_time."' and iid IN( select iid from img WHERE uid='".$uid."')order by time desc";
	$sql_i="SELECT * FROM img where upload_time>'".$last_time."' and uploader IN( select friend from relation WHERE user='".$uid."')order by upload_time desc";
	$sql_l="SELECT * FROM user_likes where time>'".$last_time."' and iid IN( select iid from img WHERE uid='".$uid."')order by time desc";
	$sql_r="SELECT * FROM relation where time>'".$last_time."' and uid='".$uid."' order by time desc";
	$array_c=return_one($sql_c);
	$array_i=return_one($sql_i);
	$array_l=return_one($sql_l);
	$array_r=return_one($sql_r);

	switch(max($array_c['time'],$array_i['upload_time'],$array_l['time'],$array_r['time']))
	{	case $array_i['upload_time']:
			$sql="select username from user where uid='".$array_i['uploader']."'";
			echo "Your friend ".return_one($sql)['username']." has uploaded a new picture.";
			break;
		case $array_r['time']:
			$sql="select username from user where uid='".$array_r['friend']."'";
			echo "User ".return_one($sql)['username']." has added you to his/her friend list.";
			break;
		case $array_c['time']:
			echo "Some one has commented one of your picture.";
			break;
		case $array_l['time']:
			echo "Some one has liked one of your picture.";
			break;

		default:
			echo "No new message.";
	}
	}
?>