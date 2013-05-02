<?php

function loaddata($animal){
	
		
	switch ($animal) {
    case 'dog':
        $ouput = '<a href="http://www.flickr.com/photos/kristenadams/3539887208/"><img src="http://www.gingerhost.com/ajax-demo/puppy.jpg" /></a><p>Dogs are known to be man\'s best friend.</p>';
        break;
    case 'cat':
        $ouput = '<a href="http://www.flickr.com/photos/poplinre/624175845/"><img src="http://www.gingerhost.com/ajax-demo/kitten.jpg" /></a><p>Cats are cuter than you. Fact.</p>';
        break;
    case 'robot':
        $ouput = '<a href="http://www.seomoz.org"><img src="http://www.gingerhost.com/ajax-demo/roger_mozbot.png" /></a><p>Seriously, ain\'t he just the cutest robot ever?</p>';
        break;
    default:
		//header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
       $ouput = "<p>Sorry, I've never heard of <strong>$animal</strong>.</p>";
	}

	return $ouput;
}
