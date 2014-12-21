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
	 * This function keeps [0-9], space and \n or \r.
	 */
	public static function prepareNumberWithSpace($number) {
		$filter = " 0123456789\r\n";
		return self::filter ( $filter, $number );
	}

	/**
	 * This function keeps [0-9].
	 */
	public static function prepareNumber($number) {
		$filter = "0123456789";
		$filtered = self::filter ( $filter, strval($number) );
		return intval($filtered);
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
	 * This function removes the space and tabs of the input.
	 */
	public static function removeSpaces($text) {
		$cleaned = str_replace ( " ", "", $text );
		$cleaned = str_replace ( "\t", "", $cleaned );
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