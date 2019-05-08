<?php
	require_once 'project.php';
	function return_one($sql)
	{
		$conn=connect();
		$result=$conn->query($sql);
		if ($result && mysqli_num_rows($result)>0)
		{
			return mysqli_fetch_assoc($result);
		}
		else 
		{
			return false;
		}
	}
	function return_all($sql)
	{
		$conn=connect();
		$result=$conn->query($sql);
		if ($result && mysqli_num_rows($result)>0){
			while ($row=mysqli_fetch_assoc($result)){
				$rows[]=$row;
			}
			return $rows;
		}
		else
		{
			return false;
		}
	}

?>