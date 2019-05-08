<html>
<head>
<meta http-equiv="refresh" content="2;url=userview.php">
</head>
<body>

<?php

require_once 'project.php';

if($_FILES['file']['error']==0)
{
	$iid = upload($_FILES['file']['name'], $_GET['uid']);
	move_uploaded_file($_FILES['file']['tmp_name'], 'img/'.$iid.'.jpg');
	print 'Upload successful! File size: '.$_FILES['file']['size']." bytes";
}
else
{
	print 'Upload fail';
}
?>
<br />
<a href="userview.php">back</a>
</body>
</html>