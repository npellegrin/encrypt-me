<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a block transposition with a given key.
 */
class Cesar implements iAlgorithm {
	private $key;
	
	/**
	 * Constructor.
	 */
	function __construct($key) {
		// Store key
		$this->key = $key;
	}
	
	/**
	 * Destructor.
	 */
	function __destruct() {
	}
	
	/**
	 * Encrypt the text with the stored key, and returns the encrypted text.
	 */
	public function encrypt($text) {
		// Clean input
		$text = Cleaner::prepareAlphabetWithSpace ( $text );
		$text = Cleaner::removeEOL ( $text );
		
		// Init
		$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$textSize = strlen ( $text );
		
		// Build shift index (must be between 0 and 25)
		$shift = (26 + ($this->key % 26)) % 26;
		
		// Encrypt
		$encryptedText = "";
		for($i = 0; $i < $textSize; $i ++) {
			if ($text {$i} == " ") {
				$encryptedText .= " ";
			} else {
				$encryptedText .= $alphabet {(strpos ( $alphabet, $text {$i} ) + $shift) % 26};
			}
		}
		
		// End
		return $encryptedText;
	}
	
	/**
	 * Decrypt the text with the stored key, and returns the decrypted text.
	 */
	public function decrypt($text) {
		// Clean input
		$text = Cleaner::prepareAlphabetWithSpace ( $text );
		$text = Cleaner::removeEOL ( $text );
		
		// Init
		$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$textSize = strlen ( $text );
		
		// Build the shift index to revert code (must be between 0 and 25)
		$shift = (26 - ($this->key % 26)) % 26;
		
		// Encrypt
		$decryptedText = "";
		for($i = 0; $i < $textSize; $i ++) {
			if ($text {$i} == " ") {
				$decryptedText .= " ";
			} else {
				$decryptedText .= $alphabet {(strpos ( $alphabet, $text {$i} ) + $shift) % 26};
			}
		}
		
		// End
		return $decryptedText;
	}
}

?>