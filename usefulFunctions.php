<?php

function getPrefixGerated( $value ) {
	$text = (md5($value));
	
	while( strlen($text) > 2 ) {
		for( $i=0; $i<strlen($text); $i+=2 ) {
			$tmp .= $text[$i];
		}
		$text = $tmp;
		unset($tmp);
	}
	$text[0] = (is_numeric($text[0])) ? chr($text[0]+97) : $text[0];
	$text[1] = (is_numeric($text[1])) ? chr($text[1]+97) : $text[1];
	$text = strtolower($text);
	
	return $text;
}
echo getPrefixGerated('Agencia Planos');
