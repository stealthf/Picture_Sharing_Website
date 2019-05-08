<?php
$conn = mysqli_connect("localhost", "root", "","project_db");
    if ($conn->connect_error)  
    {
		echo "Unable to connect to database";
	   	exit;
    }
    Class User
    {
    	public static function getUser($userId)
    	{
    		global $conn;
    		$query = "select uid, username from user where uid = '$userId'";
    		$result = $conn->query($query);
    		if($result)
    		{
    			if(mysqli_num_rows($result) == 1)
    			{
    				return mysqli_fetch_object($result);
    			}
    		}
    		return null;
    	}
    }
?>