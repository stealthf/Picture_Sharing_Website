<!DOCTYPE html>
<?php
	session_start();
	date_default_timezone_set('Asia/Hong_Kong');
	$username = $_SESSION['username'];
	$uid = $_SESSION['uid'];
	$_SESSION['uid'] = $uid;
	$_SESSION['username'] = $username;
	$_SESSION['loginflag'] = true;
?>
<html>
<title> <?php print($username) ?> </title>

<head>

<style type="text/css">
	div.main
	{
		border-style: solid;
		border-width: 2px;
		margin: 10px;
		float:left;
	}
	div.group
	{
		font-weight:bold;
		color: blue;
	}
	.group .fname
	{
		position: relative;
		left: 15px;
	}
	.fname
	{
		font-weight:normal;
		color: black;
	}
	body
	{
		padding: 20px;
	}
	#friend
	{
		background-color:#f1f1f1;
		padding: 10px;
		padding-right: 25px;
	}
	#viewer
	{
		padding: 5px;
	}
	#property
	{
		background-color:#b0e0e6;
		padding: 10px;
		padding-right: 25px;
	}
	div.img
	{
		display:inline;
		margin:10px;
		border:1px solid #bebebe;
		text-align:center;
		float:left;
	}
	img
	{
		display:inline;
		margin:5px;
		border:1px solid #bebebe;
	}

	div.imgrow
	{
		height:auto;
		width:auto;
		margin:10px;
		clear:both;
	}
	div.imgline
	{
		clear:both;
	}

</style>

<script type="text/javascript">
var flist={};
var blist={};

function getfriendlist(uid)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			flist = eval('('+xmlhttp.responseText+')');
		}
	}
	xmlhttp.open("GET","friend_list.php?uid="+uid,true);
	xmlhttp.send();
}

function showfriend(list)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			flist = eval('('+xmlhttp.responseText+')');
			filllist(flist);
		}
	}
	xmlhttp.open("GET","friend_list.php?uid="+"<?php echo $uid;?>",true);
	xmlhttp.send();
}

function filllist(list)
{
	var html=document.getElementById("friend");
	html.innerHTML="Friend List";
	for(g in list)
	{
		buf="";
		for(id in list[g])
		{
			buf+="<div class=\"fname\"><a href='FriendList.php?friend="+list[g][id]+"'>"+list[g][id]+"</a></div>";
		}
		if(g!="_undefined")
		{
			html.innerHTML+="<div class=\"group\">"+g+buf+"</div>";
		}
		else
		{
			html.innerHTML+=buf;
		}
	}
	html.innerHTML+="<br /><button type=\"button\" onclick=\"managefriend(flist)\" >Manage</button>"
}

function showmanage(list)
{
	var html=document.getElementById("friend");
	html.innerHTML="Manage Friend <br />";
	for(g in list)
	{
		for(id in list[g])
		{
			var bplus = "<button class=\"fop\" type=\"button\" onclick=\"classifyfriend('"+id+"',flist)\">+</button>";
			var bdel = "<button class=\"fop\" type=\"button\" onclick=\"delfriend('"+id+"')\">-</button>";
			var bblk = "<button class=\"fop\" type=\"button\" onclick=\"blockfriend('"+id+"')\">X</button>";
			html.innerHTML+="<div class=\"fname\">"+list[g][id]+"  "+bplus+bdel+bblk+"</div>";
		}
		
	}
	html.innerHTML+="<br /><button type=\"button\" onclick=\"add()\">Add</button>";
	html.innerHTML+="<button type=\"button\" onclick=\"showfriend(flist)\">OK</button>";
}

function managefriend(list)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			flist = eval('('+xmlhttp.responseText+')');
			showmanage(flist);
		}
	}
	xmlhttp.open("GET","friend_list.php?uid="+"<?php echo $uid?>",true);
	xmlhttp.send();
}
function classifyfriend(fuid, list)
{
	var html=document.getElementById("friend");
	html.innerHTML="Move "+fuid+" to <br />";
	for(g in list)
	{
		if(g!="_undefined")
		{
			html.innerHTML+="<a style=\"cursor:pointer\" onclick=\"addtogroup("+"'<?php echo $uid?>'"+",'"+fuid+"','"+g+"')\">"+g+"</a><br />";
		}
	}
	html.innerHTML+="<a style=\"cursor:pointer\" onclick=\"addtogroup("+"'<?php echo $uid?>'"+",'"+fuid+"','_undefined')\">NO Group</a><br />";
	html.innerHTML+="<br /><button type=\"button\" onclick=\"newgroup()\">New</button>";
	html.innerHTML+="<button type=\"button\" onclick=\"showfriend(flist)\">OK</button>";
}
function addtogroup(uid, fuid, group)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			alert(xmlhttp.responseText);
			showfriend(flist);
		}
	}
	xmlhttp.open("GET","friend_operation.php?op=1&uid="+"<?php echo $uid ?>"+"&fuid="+fuid+"&group="+group,true);
	xmlhttp.send();
}
function newgroup()
{
	var html=document.getElementById("friend");
	html.innerHTML="New Group: <br />";
	html.innerHTML+="<input type=\"text\" id=\"newg\">";
	html.innerHTML+="<button type=\"button\" onclick=\"addgroup()\">Add</button>";
	html.innerHTML+="<br /><button type=\"button\" onclick=\"managefriend(flist)\">Back</button>";
}
function addgroup()
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			alert(xmlhttp.responseText);
			showfriend(flist);
		}
	}
	xmlhttp.open("GET","friend_operation.php?op=2&uid="+"<?php echo $uid ?>"+"&newgroup="+document.getElementById("newg").value,true);
	xmlhttp.send();
}
function delfriend(fuid)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			alert(xmlhttp.responseText);
			showfriend(flist);
		}
	}
	xmlhttp.open("GET","friend_operation.php?op=4&uid="+"<?php echo $uid ?>"+"&fuid="+fuid,true);
	xmlhttp.send();
}
function blockfriend(fuid)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			alert(xmlhttp.responseText);
			showfriend(flist);
		}
	}
	xmlhttp.open("GET","friend_operation.php?op=5&uid="+"<?php echo $uid ?>"+"&fuid="+fuid,true);
	xmlhttp.send();
}
function add()
{
	var html=document.getElementById("friend");
	html.innerHTML="Add New Friend <br />";
	html.innerHTML+="<input type=\"text\" id=\"newf\">";
	html.innerHTML+="<button type=\"button\" onclick=\"addfriend()\">Add</button>";
	html.innerHTML+="<br /><button type=\"button\" onclick=\"managefriend(flist)\">Back</button>";
}
function addfriend()
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			alert(xmlhttp.responseText);
			showfriend(flist);
		}
	}
	xmlhttp.open("GET","friend_operation.php?op=3&uid="+"<?php echo $uid ?>"+"&fuid="+document.getElementById("newf").value,true);
	xmlhttp.send();
}

function showphotolist(style)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("imageviewer").innerHTML += xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","photo.php?uid="+"<?php echo $uid ?>"+"&style="+style,true);
	xmlhttp.send();
}

function manageproperty(iid)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			flist = eval('('+xmlhttp.responseText+')');
			filllist(flist);
			getblocklist(iid);
		}
	}
	xmlhttp.open("GET","friend_list.php?uid="+"<?php echo $uid;?>",true);
	xmlhttp.send();
}

function getblocklist(iid)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			blist = eval('('+xmlhttp.responseText+')');
			showproperty(flist, iid);
		}
	}
	xmlhttp.open("GET","blocklist.php?uid="+"<?php echo $uid;?>"+"&iid="+iid,true);
	xmlhttp.send();
}

function showproperty(list, iid)
{
	var html=document.getElementById("property");
	html.innerHTML="Block List";
	for(g in list)
	{
		buf="";
		for(id in list[g])
		{
			if(blist[g][id])
			{
				var event="onclick=\"setblock('"+id+"', '"+iid+"', 0)\"";
				buf+="<div class=\"fname\"><input type='checkbox' "+event+" checked=true/>"+list[g][id]+"</div>";
			}
			else
			{
				var event="onclick=\"setblock('"+id+"', '"+iid+"', 1)\"";
				buf+="<div class=\"fname\"><input type='checkbox' "+event+" />"+list[g][id]+"</div>";
			}
		}
		if(g!="_undefined")
		{
			html.innerHTML+="<div class=\"group\">"+g+buf+"</div>";
		}
		else
		{
			html.innerHTML+=buf;
		}
	}
}

function setblock(fuid, iid, flag)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			manageproperty(iid);
			//alert(xmlhttp.responseText);
		}
	}
	xmlhttp.open("GET","block.php?uid="+"<?php echo $uid;?>"+"&iid="+iid+'&fuid='+fuid+'&flag='+flag,true);
	xmlhttp.send();
}

function imgclick(iid)
{
	manageproperty(iid);
}

function load()
{
	<?php 
		if(isset($_SESSION['lastime']))
		{
			if((strtotime(date("y-m-d h:i:s"))-strtotime($_SESSION['lastime']))<60*60*24)
			{
				$_SESSION['lastime'] = date("y-m-d h:i:s");
			}
			else
			{
				$_SESSION['loginflag'] = false;
			}
		}
		echo (strtotime(date("y-m-d h:i:s"))-strtotime($_SESSION['lastime']));
	?>
	
	if(<?php if($_SESSION['loginflag']){echo 'true';}else{echo 'false';}; ?>)
	{
		showfriend(flist);
		showphotolist(0);
		showproperty(flist);
	}
	else
	{
		document.getElementById("body").innerHTML = "Please re-login";
	}
}
</script>

</head>
<body onload="load()" id="body">
	<div name="friend" id="friend" class="main"></div>
	<div name="viewer" id="viewer" class="main">
	Photos  
	<form action="rcv.php?uid=<?php echo $uid ?>" enctype="multipart/form-data" method="post" name="uploader">
		<input type="file" name="file" accept="image/jpeg" />
		<input type="submit" value="Submit">
	</form>
	
	<div id="imageviewer"></div>
	
	<br />
	</div>
	<div name="property" id="property" class="main">Block List<br /></div>
	
	<?php 
	echo 'Your UID: '.$uid.'<br /><br />';
	echo date("y-m-d h:i:s");
	?>
</body>
</html>