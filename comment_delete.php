<?php
	if($_GET["task"] && $_GET['task'] == "comment_delete")
	{
		$conn = mysqli_connect("localhost", "root", "","project_db");
	    if ($conn->connect_error)  
	    {
			echo "Unable to connect to database";
		   	exit;
	    }
		include 'comments.php';
		if( class_exists('Comments' ) )
		{
			if(Comments::delete( $_GET["comment_id"] ))
			{
				echo "Yeah, delete successfully";
			}
		}
		else
			echo "delete failed";
	}
?>