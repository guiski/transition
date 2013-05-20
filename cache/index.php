<?php
require('Cache.class.php');

try {
	$cache = new cCache(1);
	
	if( !$cache->isCache('index') ) {
		$cache->write( 'index', 'conteudo do index: hora: ' . date("H:i:s") );
	}

	echo $cache->read('index');
	
} catch (Exception $e) {
	echo $e->getMessage();
}
