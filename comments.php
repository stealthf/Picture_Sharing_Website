<?php
	date_default_timezone_set("Asia/Hong_Kong");
	$conn = mysqli_connect("localhost", "root", "","project_db");
    if ($conn->connect_error)  
    {
		echo "Unable to connect to database";
	   	exit;
    }
    session_start();
	class Comments
	{
		public static function getComment()
		{
			global $conn;
			$output = array();
			$query = "SELECT * FROM comment WHERE iid ='{$_SESSION['image']}' GROUP BY cid";
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
		public static function insert($comment_txt, $userId)
		{
			global $conn;
			$date = date('Y-m-d H:i:s');
			$comment_txt = addslashes($comment_txt);
			$query = "INSERT INTO comment VALUES( '', '$comment_txt', '$userId', '{$_SESSION['image']}', '$date')";
			$result = $conn->query($query);
			if($result)
			{
				$insert_id = mysqli_insert_id($conn);
				$std = new stdClass();
				$std->cid=$insert_id;
				$std->content=$comment_txt;
				$std->uid=$userId;
				$std->iid=$_SESSION["image"];
				$std->time=$date;
				return $std;
			}
				return null;
		}
		public static function delete($commentId)
		{
			global $conn;
			$query = "DELETE FROM comment WHERE cid = $commentId";
			$result = $conn->query($query);
			if($result)
			{
				return true;
			}
			else
				return null;
		}
	}
?>