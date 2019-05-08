<?php

	require_once 'project.php';
	require_once 'project_select.php';
	
	$user=$_GET["uid"];
	$sql1="select category from relation where relation.user='".$user."'";
	$array1=return_all($sql1);
	
	if($array1)
	{
		$array1=array_column($array1,'category');
	}
	else
	{
		$array1=array();
	}
	$array = null;
	foreach($array1 as $category)
	{
		$sql2="select friend from relation where user='".$user."' and category='".$category."' and friend!=user";
		$sql3="select username from relation,user where relation.user='".$user."' and category='".$category."' and user.uid=relation.friend and friend!=user";
		if (return_all($sql2))
		{
			$array2=array_column(return_all($sql2),'friend');
			$array3=array_column(return_all($sql3),'username');
			$array2=array_combine($array2,$array3);
		}
		else
		{
			$array2=array();
		}
	//	print_r($array2);
		$array[$category]=$array2;
		
	}
	if($array)
	{
		print_r(json_encode($array));
	}
	else
	{
		echo "{}";
	}
?>
