<?php
$list=array(
'a'=>array('a1', 'a2'),
'b'=>array('b1', 'b2')
);
foreach($list as $i=>$j)
{
	foreach($j as $k)
	{
		print_r($k);
	}
}

?>