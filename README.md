# WhyTheyHate The Source Code

### // ABOUT //

WhyTheyHate The Source Code is a set of files that will pull a random image from flickr identified by a flickr tag of your choosing and load it into a web page. Originally developed by Steve Calderon with Steve Lambert for the website [WhyTheyHate.Us][1]. 

   [1]: http://whytheyhate.us

The code was written in 2006, and prepared for release while at Eyebeam's OpenLab in 2007 - [http://research.eyebeam.org][2]

   [2]: http://research.eyebeam.org

![][3]

   [3]: logo.gif

Steve Lambert - steve at visitsteve.com  
Steve Calderon - steve at damndirtyape.net

### // LICENSE //

The code we wrote (index.html, wthu.php, and style.css) is released into the public domain. [http://creativecommons.org/licenses/publicdomain/][4] The other files have their own licenses included in the code.

   [4]: http://creativecommons.org/licenses/publicdomain/

### // INSTALLATION //

  1. Go get a Flickr API key ([http://www.flickr.com/services/api/key.gne][5]). Make sure to fill out a full profile or it might not work.

   [5]: http://www.flickr.com/services/api/key.gne

    1. Copy the bundled folders and files to your server: 

      * auth.php
      * cache
      * file_get_contents.php
      * file_put_contents.php
      * flag.gif
      * getToken.php
      * index.php
      * PEAR
      * phpFlickr.php
      * style.css
      * wthu.php
      * xml.php
      * xml_saxy_parser.php

    2. Change the permissions for the subdirectory(folder) called "cache" and the file contained within it, called "flickrcache". Your web server needs to be able to read and write to both.
    3. Edit wthu.php and replace "YOUR FLICKR API KEY GOES HERE" with your Flickr API key.
    4. Edit index.php and replace "WHATEVERTAGYOUWANT" with the tag you want to use (we use "whytheyhateus"). 
    5. Put a bunch of public photos on Flickr with the tag you chose (if they're not there already)
    6. Customize the index.php file with the title of your page, add links to the navigation column, etc.
    7. Optional: Customize the CSS file. It's pretty boring if you don't.
    8. Tell people to add images to flickr with your specified tag.

### // IMPORTANT NOTES //

Because the query results are cached, when you change the flickr tag in the code, the images loading into the site will change after around 5 minutes. It's not broken.

Thanks to the writers of [http://www.sourceforge.net/projects/phpflickr/][6]. 

   [6]: http://www.sourceforge.net/projects/phpflickr/
