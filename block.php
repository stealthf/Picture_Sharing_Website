<?php
require_once 'project.php';
require_once 'project_select.php';


$iid=$_GET['iid'];
$fuid=$_GET['fuid'];
$flag=$_GET['flag'];


if($flag==0)
{
	$where="iid='".$iid."' and uid='".$fuid."'";
	delete('view_img',$where);
}
if($flag==1)
{
	$array=array('iid'=>$iid,'uid'=>$fuid);
	insert($array,'view_img');
}
?>