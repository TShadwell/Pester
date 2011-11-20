$(document).ready(function(){
						   
 $(window).resize(function(){

  $('.main').css({
   position:'absolute',
   left: ($(window).width() 
     - $('.main').outerWidth())/2,
   top: ($(window).height() 
     - $('.main').outerHeight())/2
  });
		
 });
 
 // To initially run the function:
 $(window).resize();

});
function Ignite(id)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
  	{// For the cool people
  		xmlhttp=new XMLHttpRequest();
  	}
	else
  	{// Your browser is bad out of ten
	 // AKA Standards!? What standards?
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	xmlhttp.onreadystatechange=function()
  	{
  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
    			document.getElementById(id).innerHTML=xmlhttp.responseText;
			$('#' + id).toggle('fast');
    		}
  	}
	xmlhttp.open("GET","flame.php?a=r&d="+id,true);
	xmlhttp.send();
}
function MoreFlames(id)
{
	text = document.getElementById(id+"t").value;
	var xmlhttp;
	if (window.XMLHttpRequest)
  	{// For the cool people
  		xmlhttp=new XMLHttpRequest();
  	}
	else
  	{// Your browser is bad out of ten
	 // AKA Standards!? What standards?
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	xmlhttp.onreadystatechange=function()
  	{
  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
			$('#' + id + 'd').toggle('fast');
    		}
  	}
	xmlhttp.open("GET","flame.php?a=a&d="+id+ "&t=" + text,true);
	xmlhttp.send();
}
