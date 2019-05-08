<?php
	$uid = $_GET['uid'];
	$style = $_GET['style'];
	$conn = mysqli_connect("localhost", "root", "","project_db");
	if ($conn->connect_error)  {
	echo "Unable to connect to database";
   	exit;
	}
   
	$list = array();

	$query = "select iid, date(upload_time) as time from img where uploader=\"".$uid."\" order by time desc";
	$result = $conn->query($query);
	$result->data_seek(0);
	if($style=='0')
	{
		$current = "";
		while ($row = $result->fetch_assoc())
		{
			if($row['time']!=$current)
			{
				$current = $row['time'];
				$list[$current] = array();
			}
			$list[$current][] = $row['iid'];
	   }
	   
	   foreach ($list as $t=>$l)
	   {
			$cnt = 0;
			echo "<div class=\"imgline\">";
			echo "<p>".$t."</p>";
			echo "<div class=\"imgrow\">";
		   foreach($l as $i)
		   {
				if($cnt>=5)
				{
					echo "</div>";
					echo "<div class=\"imgrow\">";
					$cnt = 0;
				}
				echo "<div class=\"img\">";
				echo "<img src=\"/img/".$i.".jpg\" width=\"100\" height=\"100\" onclick=\"imgclick('".$i."')\" style=\"cursor:pointer\"  />";
				echo "<div><a href=\"picture.php?id=".$i."\">view</a></div>";
				echo "</div>";
				$cnt++;
		   }
		   echo "</div>";
		   echo "</div>";
	   }
	}
	else
	{
	   
	}
	$result->free();
	$conn->close();
?>