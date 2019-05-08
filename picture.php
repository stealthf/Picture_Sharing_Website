<?php   
	include 'comments.php'; 
	include 'user.php';
	include 'likes.php';
	include 'img_block.php';
	$conn = mysqli_connect("localhost", "root", "","project_db");
    if ($conn->connect_error)  
    {
		echo "Unable to connect to database";
	   	exit;
    }
    $userId=$_SESSION['uid'];
    $userName=$_SESSION['username'];
	if(check_block($_GET['id'], $userId) == false)
	{
		echo "You have no access to this image";
	}
	if(check_block($_GET['id'], $userId) == true):
?>
<!DOCTYPE html>
<html>
<head>
<title>Picture</title>
<link href="picture.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="comment_insert.js"></script>
<script type="text/javascript" src="comment_delete.js"></script>
<script type="text/javascript" src="like_insert.js"></script>
<script type="text/javascript">
	function logout()
	{
		window.location = "logout.php";
	}
	function back()
	{
		window.location = "userview.php";
	}
</script>
</head>
<body>
<?php
	$_SESSION['image'] = $_GET['id'];
?>
	<input type="button" value="Logout" onclick="logout()">
	<input type="button" value="Back to main page" onclick="back()">
	<div class="wrapper">
		<div class="page-data">
		<img class="photo" src="<?php echo "img/".$_GET['id']; ?>.jpg" />
		</div>
		<div class="like_warpper">
			<div id="like_button" class="like_button" >
					<img src="like_button.jpeg" class="button_image">
			</div>
			<div class="like_list"> 
				<ul class="like_holder_ul">
					<?php $likes = Likes::getLike() ?>
					<?php include 'like_box.php'; ?>
				</ul>
			</div>
		</div>
		<div class="comment_wrapper">
			<h3 class="comment_title"> Comment </h3>
			<div class="comment_insert">
				<h3 class="user"><span>Says:</span> <?php echo $userName; ?></h3>
				<div class="comment_insert_container">
					<textarea id="comment_post_text" class="comment_insert_text"></textarea>
				</div>
				<div id="comment_post_button" class="comment_post_button" >
					Post
				</div>
			</div>
			<div class="comment_list">
				<ul class="comment_holder_ul">
					<?php $comments = Comments::getComment() ?>
					<?php include 'comment_box.php';?>
				</ul>
			</div>
		</div>
	</div>
	<input type="hidden" id="userId" value="<?php echo $userId; ?>" />
	<input type="hidden" id="userName" value="<?php echo $userName; ?>" />
</body>
</html>
<?php endif; ?>
