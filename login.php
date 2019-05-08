<?php
	session_start();
	$_SESSION["admin"]="0";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<style>
	body{
		background-image:url('back.JPG');
		background-attachment:fixed;
		background-size:1920px 1080px;
	}
	div{
		text-align:center;
		margin-top:100px;
	}
	</style>
	<script type="text/javascript">
		function validate(){
			if(document.myForm.username.value==""){
			alert("Please enter username!");
			return false;	
			}else if (document.myForm.password.value==""){
			alert("Please enter password!");			
			return false;
			}
						
			var xmlHttp;				
			try{xmlHttp= new XMLHttpRequest();
			}catch(e){
				try{
				xmlHttp= new ActiveXObject("Msxml2.XMLHTTP");
				}catch(e){
					try{
					xmlHttp= new ActiveXObject("Microsoft.XMLHTTP");
					}catch(e){
					alert("Error!");return false;
					}
				}
			}
						
				var flag;
				var url="judge.php?user="+document.myForm.username.value+"&password="+document.myForm.password.value;
				xmlHttp.onreadystatechange=function(){
					if(xmlHttp.readyState==4){					
						flag = xmlHttp.responseText;	
						if(flag=="nouser"){
						alert("User doesn't exist!");						
							return false;
						}else if(flag=="incorrectpassword"){
						alert("Incorrect password!");	
							return false;
						}else if(flag=="1")	
							{window.location.href="setsession.php";}
							else 
							{window.location.href="setusersession.php?username="+document.myForm.username.value;}					
					}
				}
				xmlHttp.open("GET",url,true);
				xmlHttp.send(null);		
				return false;
		}
		
		//go to create a account
		function jump(){
			window.location.href="register.php";
		}
	</script>
</head>
<body>
<div>
	<h1>Welcome!!</h1>
    <form action="setusersession.php" method="get" name="myForm" onsubmit="return validate(this)">
	<label> Username: </label><input type="text" name="username" /> <br />
	<label> password: </label><input type="password" name="password" /> <br />
	<input type="submit" value="submit" /> 
	<button type="button" onclick="jump()">Register</button>
	</form>
</div>
</body>
</html>