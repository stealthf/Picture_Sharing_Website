<?php
	require_once 'project.php';
	require_once 'project_select.php';
	function block($iid,$blocked_uid)
	{
		$array=array('iid'=>$iid,'uid'=>$blocked_uid);
		insert($array,'view_img');
	}
	function unblock($iid,$blocked_uid)
	{
		$where="iid='".$iid."' and uid='".$blocked_uid."'";
		delete('view_img',$where);
	}
	function check_block($iid,$uid)
	{
		$message = true;
		$sql="select * from view_img where iid='".$iid."' and uid='".$uid."'";
		if(return_one($sql))
		{
			$message = false;
		}
		return $message;
	}
	/*
	block('i4112085','u4115428');
	check_block('i4112085','u4115428');
	unblock('i4112085','u4115428');
	check_block('i4112085','u4115428');
	*/
?>