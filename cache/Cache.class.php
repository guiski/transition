<?php

Class cCache {

	private $timeOut; /* in minutes */
	private $folder;
	private $extension;	

	public function __construct( $timeOut = 60, $folder = "cache", $extension = 'txt' ) {
		$this->timeOut = $timeOut;
		$this->folder = $this->setFolder( $folder );
		$this->extension = $extension;
	}

	private function setFolder( $folder ) {
		$system_temp = sys_get_temp_dir();
		if( file_exists($folder) && is_dir($folder) && is_writable($folder) ) {
			return $folder;
		}elseif( file_exists($system_temp) && is_dir($system_temp) && is_writable($system_temp) ) {
			return $system_temp;
		}else {
			trigger_error('Nao foi possivel acessar a pasta de cache', E_USER_ERROR);
		}

	}

	public function getPathFileName( $key ) {
		return str_replace('\\\\','\\',sprintf( "%s%s%s.%s", $this->folder, DIRECTORY_SEPARATOR, md5($key), $this->extension ));
	}

	public function isCache( $key ) {
		$filename = $this->getPathFileName( $key );
		if( !file_exists($filename) ) {
			return FALSE;
		}

		$filemtime = filemtime($filename);
		if( time() > ( $filemtime + (60 * $this->timeOut) ) ) {
			return FALSE;
		}

		return TRUE; /* cache exists */
	}

	public function write( $key, $value ) {
		$filename = $this->getPathFileName( $key );
		if( !file_put_contents($filename, $value) ) {
			trigger_error('Nao foi possivel criar o arquivo de cache', E_USER_ERROR);
		}
	}

	public function read( $key ) {
		$filename = $this->getPathFileName( $key );
		if( file_exists($filename) && is_readable($filename) ){
			if( !$result = file_get_contents($filename) ) {
				trigger_error('Nao foi possivel ler o arquivo de cache', E_USER_ERROR);
			}
		}
		return $result;
	}

}
