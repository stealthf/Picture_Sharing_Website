<?php 
	if(isset($_GET["task"]) && $_GET["task"] == "like_insert")
	{
		$conn = mysqli_connect("localhost", "root", "","project_db");
	    if ($conn->connect_error)  
	    {
			echo "Unable to connect to database";
		   	exit;
	    }
	    $userId = $_GET["userId1"];
	    $std = new stdClass();
	    $std->user = null;
	    $std->like = null;
	    $std->error = false;

		include 'likes.php';
		include 'user.php';
		if(class_exists('Likes') && class_exists('User'))
		{
			$userInfo = User::getUser($userId);
			if($userInfo == null)
			{
				$std->error = true;
			}
			$likeInfo = Likes::insert($userId);
			if($likeInfo == null)
			{
				$std->error = true;
			}
			$std->user = $userInfo;
			$std->like = $likeInfo;
		}
		echo json_encode($std);
	}
	else
	{
		header('location: picture.php');
	}
?>