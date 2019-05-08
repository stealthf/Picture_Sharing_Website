<?php
require_once 'project.php';
require_once 'project_select.php';
for($i=0;$i<5;$i++)
{
	$uid[$i]=register("user".$i,"pwd".$i);
	$iid[$i]=upload("img".$i,"imgname".$i,$uid[$i]);
	comment($uid[$i],$iid[$i],"i am ".$i);
	like($uid[$i],$iid[$i]);
}
	for ($j=1;$j<5;$j++)
	{
		relation($uid[0],$uid[$j],"g".$j,0);
	}


	

?>