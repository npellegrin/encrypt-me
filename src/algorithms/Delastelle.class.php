<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a Delastelle substitution with a given key.
 */
class Delastelle implements iAlgorithm {
	private $key;
	private $group;
	
	/**
	 * Constructor.
	 */
	function __construct($key, $group) {
		// Key must be array
		if (! is_array ( $key )) {
			throw InvalidArgumentException ( "Key must be an array" );
		}
		
		// Store keys
		$this->key = $key;
		$this->group = $group;
	}
	
	/**
	 * Destructor
	 */
	function __destruct() {
	}
	
	/**
	 * Encrypt the text with the stored keys, and returns the encrypted text.
	 */
	public function encrypt($text) {
		// Clean input
		$text = Cleaner::prepareAlphabet ( $text );
		$text = Cleaner::removeEOL ( $text );
		
		// Add letters to fit with $group
		$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		while ( strlen ( $text ) % $this->group ) {
			$text .= $alphabet {rand ( 0, 25 )};
		}
		
		// Get cipher from grid
		$line = "";
		$column = "";
		for($i = 0; $i < strlen ( $text ); $i ++) {
			$found = AlgorithmUtils::array_search_rec ( $text {$i}, $this->key );
			if ($found !== false) {
				$line .= $found [0];
				$column .= $found [1];
			}
		}
		
		// Group elements
		$list = "";
		for($i = 0; $i < strlen ( $text ); $i += $this->group) {
			$list .= substr ( $line, $i, $this->group );
			$list .= substr ( $column, $i, $this->group );
		}
		
		// Encrypt from grid
		$encryptedText = "";
		$double = 2 * strlen ( $text );
		for($i = 0; $i < $double; $i += 2) {
			$encryptedText .= $this->key [$list {$i}] [$list {$i + 1}];
		}
		
		// End
		return $encryptedText;
	}
	
	/**
	 * Decrypt the text with the stored keys, and returns the decrypted text.
	 */
	public function decrypt($text) {
		$text = Cleaner::removeEOL ( $text );
		$text = Cleaner::removeSpaces ( $text );
		
		// Add letters to fit with $group
		$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		while ( strlen ( $text ) % $this->group ) {
			$text .= $alphabet {rand ( 0, 25 )};
		}
		
		// Get cipher from grid
		$list = "";
		for($i = 0; $i < strlen ( $text ); $i ++) {
			$found = AlgorithmUtils::array_search_rec ( $text {$i}, $this->key );
			if ($found !== false) {
				$list .= $found [0] . $found [1];
			}
		}
		
		// Ungroup elements
		$line = '';
		$column = '';
		$double = 2 * strlen ( $text );
		for($i = 0; $i < $double; $i += 2 * $this->group) {
			$line .= substr ( $list, $i, $this->group );
			$column .= substr ( $list, $i + $this->group, $this->group );
		}
		
		// Decrypt from grid
		$decryptedText = "";
		for($i = 0; $i < strlen ( $text ); $i ++) {
			$decryptedText .= $this->key [$line {$i}] [$column {$i}];
		}
		
		// End
		return $decryptedText;
	}
}

?>
