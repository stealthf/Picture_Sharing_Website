<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<script type="text/javascript">
  		function validate(){
			if(document.myForm.newusername.value==""){
			alert("Please enter new username!");
			return false;
		}else if (document.myForm.newpassword.value==""){
			alert("Please enter new password!");			
			return false;
		}else{
			
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
				var url="createuser.php?user="+document.myForm.newusername.value+"&password="+document.myForm.newpassword.value;
				xmlHttp.onreadystatechange=function(){
					if(xmlHttp.readyState==4){					
					flag = xmlHttp.responseText;	
						if(flag=="no"){
						alert("Username exists!");
						
						}else{
						alert("Create successfully!");
						
						}					
					}
				}
				xmlHttp.open("GET",url,true);
				xmlHttp.send(null);	
				
			return false;				
		}					
		}
		
		function jump(){
			window.location.href="login.php";
		}

	</script>
</head>
<body>
    <form action="" method="get" name="myForm" onsubmit="return validate(this)">
	<label>New Username:</label><input type="text" name="newusername"/> <br/>
	<label>New password:</label><input type="text" name="newpassword"/> <br/>
	<input type="submit" value="Create"/> 
	<button type="button" onclick="jump()">Back</button>
	</form>
</body>
</html>