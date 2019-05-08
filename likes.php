<?php
	date_default_timezone_set("Asia/Hong_Kong");
	$conn = mysqli_connect("localhost", "root", "","project_db");
    if ($conn->connect_error)  
    {
		echo "Unable to connect to database";
	   	exit;
    }
	if (!session_id()) session_start();
    class Likes
    {
    	public static function getLike()
    	{
    		global $conn;
			$output = array();
			$query = "SELECT * FROM user_likes WHERE iid ='{$_SESSION['image']}' GROUP BY likes_id";
			$result = $conn->query($query);
			if($result)
			{
				if(mysqli_num_rows($result) > 0)
				{
					while ($row = mysqli_fetch_object($result))
					{
						$output[] = $row;
					}
				}
			}
			return $output;
    	}
    	public static function insert($userId)
		{
			global $conn;
			$query1 = "SELECT * FROM user_likes WHERE userId = '$userId' AND iid ='{$_SESSION['image']}'";
			$result1 = $conn->query($query1);
			if($result1)
			{
				if(mysqli_num_rows($result1) == 0)
				{
					$date = date('Y-m-d H:i:s');
					$query = "INSERT INTO user_likes VALUES( '', '$userId', '{$_SESSION['image']}', '$date')";
					$result = $conn->query($query);
					if($result)
					{
						$insert_id = mysqli_insert_id($conn);
						$std = new stdClass();
						$std->likes_id=$insert_id;
						$std->userId=$userId;
						$std->iid=$_SESSION['image'];
						$std->time=$date;
						return $std;
					}
				}
			}
		}
    }
?>