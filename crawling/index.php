<?php

$base = 'http://localhost/ajax-demo';

include('data.php');

if ($fragment = $_GET['_escaped_fragment_']) {
	// OPTION 1: if Google is reqesting an '_escaped_fragment_=' page, then redirect to a clean URL
	header("Location: $base/$fragment", 1, 301);
	exit;
}

if ($_GET['url']){
	// If there's a URL parameter, then load the data.
	$data = loaddata($_GET['url']);
	if ($_GET['ajax'] == 1){
		// OPTION 2: If the user's browser is requesting just the data (as an AJAX request), that's all we'll return
		echo $data;
		exit;
	}
} else {
	$data = '<p>Select a link from above to get started :)</p>';
}
?>
<html> 
<head> 
	<title>An Crawlable 'Ajax' Demo</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script>		
		var hash = window.location.hash; // like #!/SOMETHING
		jQuery(function($){

			// Default hash is '#!/'
			if (hash && hash!='#!/') {
				contentload(hash);
			}

		  
			$('a').click(function(event) {
				// event.preventDefault();
				fragment = this.hash;
				if (hash!=fragment) {
					contentload(fragment);
				}
			});
		  
		});
		
	
		function contentload (fragment) {
			var reps = {
				'!': '',
				'#': '',
				'/': ''
			}
			
			// Limpa
			for (var val in reps) {
			  fragment = fragment.split(val).join(reps[val]);
			}

			$('#content').load('?url='+fragment+'&ajax=1');	
		} //contentLoad
	</script>
</head>

<body>

	<h1>Animal Pictures Make Great Demos</h1>
	<p id="navigation">
		<a href="./#!/dog">Dog</a> &middot;
		<a href="./#!/cat">Cat</a> &middot;
		<a href="./#!/robot">Robot</a>
	</p>
	
	<div id="content">
		<?php echo $data;?>
	</div>
	
</body>
</html>