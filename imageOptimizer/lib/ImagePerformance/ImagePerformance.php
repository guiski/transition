<?php
/*
	Avaliable extensions:
		- JPEG
		- PNG
		- GIF
*/
Class ImagePerformance {

	/*
		@var
		Absolute path until the start folder
		(without start folder name)*
	*/
	protected static $absoutePath;
	
	/*
		@var 
		Start folder name
	*/
	protected static $startDirectory;
	
	/*
		@var
		Output fullpath
	*/
	protected static $outputPath;





	public function __construct() {

		self::$absoutePath = getcwd().'\\';

	}




	public function start( $dir, $output = 'okay' ) {

		if( is_dir($dir) ) {

			$output = ($output == 'okay') ? 
						$dir. '\\' . $output : // put inside of 'dir'
						$output; // put in specific folder

			self::$startDirectory = $dir;
			self::$outputPath = self::$absoutePath . $output;
			self::dirList($dir);

			return 'Sucess!';

		} else {

			return "Directory not found";

		}

	}



	/*
		'Start' method, traverses the entire directories,
		finding all directories & files
	
		@param $dir = directory path
		@param $absolutePath = boolean for work a full path

		@return
	*/
	private function dirList( $dir, $absoutePath = true ) {
		// Need to put a absolute path
		if( $absoutePath ) {
			$dir = self::$absoutePath.$dir.'\\';
		}

		$files = glob($dir . "*");
		
		foreach($files as $file) {
			// not include a output directory
			if(is_dir($file) && $file != self::$outputPath) {
				// Make the same dirs for put a optimezed images
				self::makeDir($file);
				// Recursive
				self::fileList($file.'\\');
				self::dirList($file.'\\', false);
			}
		}
	}





	/*
		Just 'list' a directory files
		and pass the (each) 'image' fullpath for
		processing image

		@param $dir = directory path

		@return 
	*/
	private function fileList( $dir ) {
		$files = glob($dir . "*");

		foreach($files as $file) {
			if( is_file($file) ) {
				// process de file
				self::optimizeImage($file);
			}
		}
	}




	/*
		@param $dir = path that need create
	*/
	private function makeDir( $dir ) {
		// Change the original path to outputPath
		$new = str_replace(self::$absoutePath. self::$startDirectory, '', $dir);
		$dir = self::$outputPath . $new;
		
		if( !file_exists($dir) && !mkdir($dir, 0, true) ) {
			die('Failed to create folders ...');
		}
	}




	/*
		Optimize a image, and put in output directory

		@param $dir = image fullpath
	*/
	private function optimizeImage( $dir ) {
		$filename = $dir; // Original file
		$extension = pathinfo($filename, PATHINFO_EXTENSION);
		
		// Change the original path to outputPath
		$new = str_replace(self::$absoutePath. self::$startDirectory, '', $dir);
		$output = self::$outputPath . $new; // output path and filename
		

		// For diferents formats
		if( $extension == 'jpeg' || $extension == 'jpg' ) {
			// JPEG format
			self::optimizeJPEG( $filename, $output );
		}
		elseif( $extension == 'png' ) {
			// PNG format
			self::optimizePNG( $filename, $output );
		}
		elseif( $extension == 'gif' ) {
			// GIF format
			self::optimizeGIF( $filename, $output );
		}
	}




	private function optimizeJPEG( $input, $output ) {
		$img = imagecreatefromjpeg($input);
		@header("Content-Type: image/jpeg");
		imagejpeg($img , $output  , 70);
	}




	private function optimizePNG( $input, $output ) {
		$img = imagecreatefrompng($input);
		@header("Content-Type: image/png");
		imagepng($img , $output  , 70);
	}




	private function optimizeGIF( $input, $output ) {
		$img = imagecreatefromgif($input);
		@header("Content-Type: image/gif");
		imagegif($img , $output  , 70);
	}




	/*
		-------------------------------------------------------------------------
		...HTML, list a directories and put in html
		just for view
	*/
	public function dirListHTML($dir,$level = 0){
		$directory = $dir;
		$files = glob($directory . "*");
		
		foreach($files as $file) {
			if(is_dir($file)) {
				for ($i=0; $i < $level; $i++) { echo '-'; }
				echo '<b>'.$file.'</b><br>';
				// Recursive
				self::fileListHTML($file.'/',$level);
				self::dirListHTML($file.'/',$level+1);
			}
		}
	}

	public function fileListHTML($dir,$level = 0){
		$directory = $dir;
		$files = glob($directory . "*");

		foreach($files as $file) {
			if(is_file($file)) {
				for ($i=0; $i < $level; $i++) {	echo '-'; }
				
				echo $file.'<br>';
			}
		}
	}
}