<?php

	require_once 'project.php';
	require_once 'project_select.php';
	

	$op=$_GET["op"];

	if($op=="1")
	{
		$user=$_GET["uid"];
		$friend=$_GET["fuid"];
		$category=$_GET["group"];

		$array=array('category'=>$category);
		$table="relation";
		$where="user='".$user."' and friend='".$friend."'";
		if(update($array,$table,$where))
		{
			$sql="select username from user where uid='".$friend."'";
			$row=return_one($sql);
			$msg="You have successfully add ".$row["username"]." to group ".$category." .";
			echo $msg;
		}
	}
	if($op=="2")
	{
		$user=$_GET["uid"];
		$category=$_GET["newgroup"];

		$array=array('user'=>$user,'friend'=>$user,'category'=>$category);
		$table="relation";
		if(insert($array,$table))
		{
			$msg="You have successfully add a new group: ".$category.".";
			echo $msg;
		}
	}
	if($op=="3")
	{
		$user=$_GET["uid"];
		$friend=$_GET["fuid"];
		if(!return_one("select * from relation where user='".$user."' and friend='".$friend."'"))
		{
			if(relation($user,$friend,'_undefined','0')&relation($friend,$user,'_undefined','0'))
			{
				$sql="select username from user where uid='".$friend."'";
				$row=return_one($sql);
				$msg="You have successfully added ".$row["username"]." to your friend list.";
				echo $msg;
			}
			else
			{
				echo "Failed to add friend.";
			}
		}
		else
			echo "The selected user is in your friend list." ;
		
	}

	if($op=="4")
	{
		$user=$_GET["uid"];
		$friend=$_GET["fuid"];
		if(return_one("select * from relation where user='".$user."' and friend='".$friend."'"))
		{
			$where1="user='".$user."' and friend='".$friend."'";
			$where2="user='".$friend."' and friend='".$user."'";
			$table="relation";
			if(delete($table,$where1)&delete($table,$where2))
			{
				$sql="select username from user where uid='".$friend."'";
				$row=return_one($sql);
				$msg="You are no longer friends with ".$row["username"].".";
				echo $msg;
			}
			else
			{
				echo "Failed to remove friend.";
			}
		}
		else
			echo "The selected user is not your friend." ;
	}
	if($op=="5")
	{
		$user=$_GET["uid"];
		$friend=$_GET["fuid"];
		if(return_one("select * from relation where user='".$user."' and friend='".$friend."'"))
		{
			$where="user='".$user."' and friend='".$friend."'";
			$table="relation";
			$array=array('clearance'=>1);
			if(update($array,$table,$where))
			{
				$sql="select username from user where uid='".$friend."'";
				$row=return_one($sql);
				$msg="You have blocked ".$row["username"].".";
				echo $msg;
			}
			else
			{
				echo "Failed to block user.";
			}
		}
		else
			echo "The selected user is not your friend." ;
	}
	
?>