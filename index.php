<?php
// REPLACE "WHATEVERTAGYOUWANT" on the line below with the Flickr tag of your choice.
	$tag = 'WHATEVERTAGYOUWANT';
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>


<head>

<!-- Rename "PAGE TITLE" to your page title -->
<title>PAGE TITLE</title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="robots" content="index,follow">
	<meta name="revisit-after" content="7 days">

<style type="text/css" media="screen">
@import url( style.css );
</style>

<!-- The code below links an rss feed for the specified flickr tag.-->
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="feed://api.flickr.com/services/feeds/photos_public.gne?tags=<?php print $tag ?>&format=rss_200">
</head>

<body onLoad="updateImage();">


<div id="container" onClick="updateImage();">

<!-- Rename "PAGE TITLE" to your page title -->
<h1>Page Title</h1>

<div id="big-img">


</div>

<div id="nav">
<ul>
<!-- These are the links that will appear in the navigation bar.  Add your own... -->
	<li><a href="#{link placeholder}">LINK 1</a></li>
	<li><a href="#{link placeholder}">LINK 2</a></li>
	<li><a href="#{link placeholder}">LINK 3</a></li>
	<li><a href="#{link placeholder}">LINK 4</a></li>
	<li><a href="#{link placeholder}">home</a></li>
</ul>
</div>

</div>

</body>



<script type = "text/javascript" language = "JavaScript">
var http = getHTTPObject(); // We create the HTTP Object
function updateImage()
{

	// Load the flag so it will wave mightily whilst a new image loads.
	loadingImage();

	// Replace the flag (but don't burn it) with a Flickr image
	newFlickrImage();
}


function loadingImage()
{
	// For a different 'loading' image than the waving US flag, replace the image tag below
	document.getElementById ("big-img").innerHTML = "<img src='flag.gif'><p>Loading...";
}

function newFlickrImage()
{
try {
	// The PHP proxy will get matching images and parse one out at random and
	// pass it back, all ready to drop in to the div.
	http.open("GET", "./wthu.php?tag=<?php print $tag ?>", true);
	http.onreadystatechange = handleHttpResponse;
	http.send("");
	}
catch (e){
	alert (e);
	}
}

function handleHttpResponse()
{
if (http.readyState == 4)
	{
	var sResponse = http.responseText;

	if (!(sResponse.indexOf("Photo not found") > 0))
		{
		document.getElementById("big-img").innerHTML = http.responseText;
		}
	else
		{
		// Hmm... No photos with that tag so uh... try again? Not sure what
		// I was thinking here, but I'm not gonna mess with it. This, theoretically,
		// should never happen anyway.
		newFlickrImage();
		}
	}
}

function getHTTPObject()
//Stolen code for getting a request object. Yeesh that's ugly.

{
var request;
  try
  	{
    request = new XMLHttpRequest();
  	}
  catch (trymicrosoft)
  	{
    try
    	{
      	request = new ActiveXObject("Msxml2.XMLHTTP");
    	}
    catch (othermicrosoft)
    	{
      	try
      		{
        	request = new ActiveXObject("Microsoft.XMLHTTP");
      		}
      	catch (failed)
      		{
        	request = false;
      		}
    	}
  	}

  if (!request)
  	{
    alert("Error initializing XMLHttpRequest!");
    }
  else
  	{
  	return request;
  	}
}
</script>


</html>