<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a block transposition with a given key.
 */
class Polybe implements iAlgorithm {
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
		$textSize = strlen ( $text );
		$alphabet = "ABCDEFGHJKLMNOPQRSTUVWXYZ"; // Without I
		                                         
		// Replace I
		$text = str_replace ( "I", "J", $text );
		
		// Cipher
		$encryptedText = "";
		for($i = 0; $i < $textSize; $i ++) {
			if ($text {$i} == " ") {
				$encryptedText .= " ";
			} else {
				$pos = strpos ( $alphabet, $text {$i} );
				$line = intval ( $pos / 5 ) + 1;
				$column = $pos % 5 + 1;
				$encryptedText .= $line . $column;
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
		$text = Cleaner::prepareNumberWithSpace ( $text );
		$text = Cleaner::removeEOL ( $text );
		
		// Init
		$textSize = strlen ( $text );
		$alphabet = "ABCDEFGHJKLMNOPQRSTUVWXYZ"; // Without I
		                                         
		// Decipher
		$decryptedText = "";
		$i = 0;
		while ( $i < $textSize ) {
			if ($text {$i} == " ") {
				$decryptedText .= " ";
				$i ++;
			} else {
				$line = $text {$i};
				$column = $text {$i + 1};
				$decryptedText .= $alphabet {5 * ($line - 1) + $column - 1};
				$i += 2;
			}
		}
		
		// End
		return $decryptedText;
	}
}

?>