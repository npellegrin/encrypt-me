<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a block transposition with a given key.
 */
class Morse implements iAlgorithm {
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
		$text = Cleaner::prepareAlphabet ( $text );
		$text = Cleaner::removeEOL ( $text );
		
		// Init
		$textSize = strlen ( $text );
		$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$substitution = Array (
				'·−',
				'−···',
				'−·−·',
				'−··',
				'·',
				'··−·',
				'−−·',
				'····',
				'··',
				'·−−−',
				'−·−',
				'·−··',
				'−−',
				'−·',
				'−−−',
				'·−−·',
				'−−·−',
				'·−·',
				'···',
				'−',
				'··−',
				'···−',
				'·−−',
				'−··−',
				'−·−−',
				'−−··' 
		);
		
		// Cipher
		$encryptedText = "";
		for($i = 0; $i < $textSize; $i ++) {
			$encryptedText .= $substitution {strpos ( $alphabet, $text {$i} )} . " ";
		}
		$encryptedText = substr ( $encryptedText, 0, strlen ( $encryptedText ) - 1 );
		
		// End
		return $encryptedText;
	}
	
	/**
	 * Decrypt the text with the stored key, and returns the decrypted text.
	 */
	public function decrypt($text) {
		// Convert input
		$text = str_replace ( "-", "−", $text );
		$text = str_replace ( ".", "·", $text );
		
		// Init
		$textSize = strlen ( $text );
		$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$substitution = Array (
				'·−',
				'−···',
				'−·−·',
				'−··',
				'·',
				'··−·',
				'−−·',
				'····',
				'··',
				'·−−−',
				'−·−',
				'·−··',
				'−−',
				'−·',
				'−−−',
				'·−−·',
				'−−·−',
				'·−·',
				'···',
				'−',
				'··−',
				'···−',
				'·−−',
				'−··−',
				'−·−−',
				'−−··' 
		);
		
		// Decipher
		$encryptedArray = explode ( ' ', $text );
		$decryptedText = "";
		foreach ( $encryptedArray as $value ) {
			if ($value != "") {
				$pos = array_search ( $value, $substitution );
				$decryptedText .= $alphabet {$pos};
			}
		}
		
		// End
		return $decryptedText;
	}
}

?>