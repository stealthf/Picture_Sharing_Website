$( document ).ready( function(){
	add_delete();
});

function add_delete()
{
	$( ".delete_button" ).each( function(){
		var btn = this;
		$( btn ).click( function(){
			comment_delete(btn.id);
		});
	});
}

function comment_delete(_comment_id)
{
	var task = "comment_delete";
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
	        $("#" + _comment_id).detach();
	        console.log(xmlhttp.responseText);
	      }
	    }
	    xmlhttp.open("GET", "comment_delete.php?task="+task+"&comment_id="+_comment_id, true);
	    xmlhttp.send(null);
}