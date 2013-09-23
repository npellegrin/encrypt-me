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
		return self::filter ( $filter, $text );
	}
	
	/**
	 * This function converts [a-z] to uppercase and removes all other characters (keeps \n and \r and space).
	 */
	public static function prepareAlphabetWithSpace($text) {
		$filter = " ABCDEFGHIJKLMNOPQRSTUVWXYZ\n\r";
		$text = strtoupper ( $text );
		return self::filter ( $filter, $text );
	}
	
	/**
	 * This function removes the end of lines in the input (\n and \r).
	 */
	public static function removeEOL($text) {
		$cleaned = str_replace ( "\n", "", $text );
		$cleaned = str_replace ( "\r", "", $cleaned );
		return $cleaned;
	}
	
	/**
	 * Filter a text, keeping only the character in filter.
	 */
	private static function filter($filter, $text) {
		$length = strlen ( $text );
		$filtered = "";
		$i = 0;
		while ( $i < $length ) {
			if (strpos ( $filter, $text {$i} ) !== FALSE) {
				$filtered .= $text {$i};
			}
			$i ++;
		}
		return $filtered;
	}
}

?>