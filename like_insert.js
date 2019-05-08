$( document ).ready( function(){
	//this will fire once the page has been fully loaded
	$( "#like_button" ).click( function(){
		like_button_click();
	});
});

function like_button_click()
{
	var _userId = $( "#userId").val();
	var _userName = $( "#userName").val();
	var task="like_insert";
	if(_userId != null)
	{
		if(window.XMLHttpRequest)
	    {
	      xmlhttp=new XMLHttpRequest();
	    }
	    else
	    {
	      xmlhttp=new ActiveXObject("Microsoft.XMLHttp");
	    }
	    xmlhttp.onreadystatechange = function()
	    { 
	      if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
	      {
	      	console.log(" UserName: " + _userName + " UserId " + _userId);
	      	like_insert(jQuery.parseJSON(xmlhttp.responseText))
	        console.log(" Response Text: " + xmlhttp.responseText);
	      }
	    }
	    xmlhttp.open("GET", "like_insert.php?task=" +task+"&userId1="+_userId, true);
	    xmlhttp.send(null);
	}
}

function like_insert(data)
{
	var t ="";
	t += '<li class="like_holder_li" id="'+data.like.likes_id+'">';
	t += '<h3 class="username_field">' + data.user.username +'</h3>';
	t += "</li>";
	$( ".like_holder_ul" ).prepend( t );
}