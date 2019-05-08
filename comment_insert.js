$( document ).ready( function(){
	//this will fire once the page has been fully loaded
	$( "#comment_post_button" ).click( function(){
		comment_post_button_click();
	});
});

function comment_post_button_click()
{
	var _comment = $( "#comment_post_text" ).val(); //comment that user entered
	var _userId = $( "#userId").val();
	var _userName = $( "#userName").val();
	var task = "comment_insert";
	if(_comment.length > 0 && _userId != null)
	{
		$( "#comment_post_text" ).val("");
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
	      	console.log( _comment + " UserName: " + _userName + " UserId " + _userId);
	      	comment_insert(jQuery.parseJSON(xmlhttp.responseText));
	        console.log("Response Text: " + xmlhttp.responseText);
	      }
	    }
	    xmlhttp.open("GET", "comment_insert.php?task="+task+"&userId="+_userId+"&comment="+_comment, true);
	    xmlhttp.send(null);
	    $( ".comment_insert_container").css( "border", "1px solid #E1E1E1" );
	}
	else
	{
		$( ".comment_insert_container").css( "border", "1px solid #FF0000" );
		console.log( "Please enter some comment");
	}
}

function comment_insert(data)
{
	var t = '';
	t += '<li class="comment_holder_li" id="'+data.comment.cid+'">';
	t += '<h3 class="username_field">'+data.user.username+'</h3>';
	t += '<div class="comment_text">"'+data.comment.content+'"</div>';
	t += '<div class="comment_time">'+data.comment.time+'</div>';
	t += '<div class="comment_button_holder">';
	t += '<ul>';
	t += '<li id="'+data.comment.cid+'" class="delete_button">X</li>';
	t += '</ul>';
	t += '</div>';
	t += '</li>';

	$( ".comment_holder_ul" ).prepend( t );
	add_delete();
}