<?php

/**
 * This class contains som string utilities to clean input.
 * */
class Cleaner {
	
	/**
	 * This function converts [a-z] to uppercase and removes all other characters (keeps \n and \r).
	 */
	public static function prepareAlphabet($text) {
		$filter = "ABCDEFGHIJKLMNOPQRSTUVWXYZ\n\r";
		$text = strtoupper ( $text );
		$length = strlen ( $text );
		$cleaned = "";
		$i = 0;
		while ( $i < $length ) {
			if (strpos ( $filter, $text {$i} ) !== FALSE) {
				$cleaned .= $text {$i};
			}
			$i ++;
		}
		return $cleaned;
	}

	/**
	 * This function removes the end of lines in the input (\n and \r).
	 */
	public static function removeEOL($text) {
		$cleaned = str_replace ( "\n", "", $text );
		$cleaned = str_replace ( "\r", "", $cleaned );
		return $cleaned;
	}
}

?>