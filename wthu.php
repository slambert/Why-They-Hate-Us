<?
//////////////////////////////////////////////////////////
// wthu.php
// Author: Steve Calderon (steve@damndirtyape.net)
//
// Simple helper proxy to get a bunch of photos from
// Flickr matching a particular tag. Includes some
// ghetto caching!
//////////////////////////////////////////////////////////



require_once("phpFlickr.php"); 				// http://www.sourceforge.net/projects/phpflickr/
require_once("file_put_contents.php");		// http://php.net/function.file_put_contents
require_once("file_get_contents.php");		// http://php.net/function.file_get_contents

// Insert your Flickr API here:
$f = new phpFlickr("YOUR FLICKR API GOES HERE");
$photos = null;

//Cheap-o caching so it's not fetching a list on every refresh.
$storedCache = unserialize(file_get_contents("./cache/flickrcache"));

if ($storedCache)
	{
	if ($storedCache[0] >= time()) // First item in the cache file is a time stamp
		{
		echo "<!-- Cached! -->\n\n";
		$photos = $storedCache[1];
		}
	}

if (is_null($photos)) // Didn't find a usable cache, so get a list of photos from Flickr
	{
	echo "<!-- No cache hit -->\n\n";
	$tagToSearch = isset($_REQUEST['tag']) ? $_GET['tag'] : "banana" ; // Tag is passed in via query string by requesting HTML.
	$photos = $f->photos_search(array("tags"=>$tagToSearch, "tag_mode"=>"all", "per_page"=>"500"));

	// Stick the results in the cache for five minutes
	$storedCache = array (time() + 300, $photos);
	file_put_contents ("./cache/flickrcache", serialize ($storedCache));
	}

// Pick a random photo from the array of photo objects returned by phpFlickr
srand((double)microtime()*1000000);
echo "<!-- Found this many: " . count($photos['photo'])."-->\n\n";
$randomPhoto = $photos['photo'][rand(0,count($photos['photo']))];

// Construct a link to Flickr's page for the photo.
$imgUrl = ("http://static.flickr.com/" . $randomPhoto['server'] . "/" . $randomPhoto['id'] . "_" . $randomPhoto['secret'] . ".jpg");

// Get Flickr's info for this photo for use on the credit line.
$imgInfo = $f->photos_getInfo($randomPhoto['id'], $randomPhoto['secret']);

// Return the display HTML for use by the page (probably in a div).
echo "<img src=" . $imgUrl . "><BR>";
echo "<a href='http://www.flickr.com/photos/" . $randomPhoto['owner'] . "/" . $randomPhoto['id'] . "'>" . $imgInfo['title'] . "</a> by <a href='http://www.flickr.com/people/" . $randomPhoto['owner'] ."/'>" . $imgInfo['owner']['username'] . "</a>";

?>
