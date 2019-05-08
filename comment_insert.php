<?php 

	if($_GET["task"] && $_GET['task'] == "comment_insert")
	{
		$conn = mysqli_connect("localhost", "root", "","project_db");
	    if ($conn->connect_error)  
	    {
			echo "Unable to connect to database";
		   	exit;
	    }
		$userId = $_GET["userId"];
		$comment = $_GET["comment"]; 
		function nl2br2($comment) 
		{
		  $comment = str_replace(array("\\r\\n", "\\n\\r", "\\r", "\\n"), "<br>", $comment);
		  return $comment;
		}
		$std = new stdClass();
		$std->user = null;
		$std->comment = null;
		$std->error = false;

		include 'comments.php';
		include 'user.php';
		if(class_exists('Comments') && class_exists('User'))
		{
			$userInfo = User::getUser($userId);
			if($userInfo == null)
			{
				$std->error = true;
			}
			$commentInfo = Comments::insert($comment, $userId);
			if($commentInfo == null)
			{
				$std->error = true;
			}
			$std->user = $userInfo;
			$std->comment = $commentInfo;
		}
		echo json_encode($std);
	}
	else
	{
		header('location: picture.php');
	}
?>