<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a block transposition with a given key.
 */
class Atbash implements iAlgorithm {
	/**
	 * Constructor.
	 */
	function __construct() {
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
		
		// Invert letters
		$encryptedText = "";
		for($i = 0; $i < $textSize; $i ++) {
			if ($text {$i} == " ") {
				$encryptedText .= " ";
			} else {
				$encryptedText .= $alphabet {(25 - strpos ( $alphabet, $text {$i} )) % 26};
			}
		}
		
		// End
		return $encryptedText;
	}
	
	/**
	 * Decrypt the text with the stored key, and returns the decrypted text.
	 */
	public function decrypt($text) {
		// Symetrical cipher
		return $this->encrypt ( $text );
	}
}

?>