<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a block transposition with a given key.
 */
class SimpleSubstitution implements iAlgorithm {
	private $key;
	
	/**
	 * Constructor.
	 */
	function __construct($key) {
		// Clean key
		$key = Cleaner::prepareAlphabet ( $key );
		$key = Cleaner::removeEOL ( $key );
		
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
		
		// Compute sizes once
		$keySize = strlen ( $this->key );
		$textSize = strlen ( $text );
		
		// Get permutation array
		$permutation = AlgorithmUtils::getPermutation ( $this->key );
		
		// Build substitution
		$substitution = "";
		$lineCount = intval ( 26 / $keySize ) + 1;
		for($j = 0; $j < $lineCount; $j ++) {
			for($i = 0; $i < $keySize; $i ++) {
				$pos = $j * $keySize + $permutation [$i];
				if ($pos < 26) {
					$substitution .= $alphabet {$pos};
				}
			}
		}
		
		// Cipher
		$encryptedText = "";
		for($i = 0; $i < $textSize; $i ++) {
			if ($text {$i} == " ") {
				$encryptedText .= " ";
			} else {
				$pos = strpos ( $alphabet, $text {$i} );
				$encryptedText .= $substitution {$pos};
			}
		}
		
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
		
		// Compute sizes once
		$keySize = strlen ( $this->key );
		$textSize = strlen ( $text );
		
		// Get permutation array
		$permutation = AlgorithmUtils::getPermutation ( $this->key );
		
		// Build substitution
		$substitution = "";
		$lineCount = intval ( 26 / $keySize ) + 1;
		for($j = 0; $j < $lineCount; $j ++) {
			for($i = 0; $i < $keySize; $i ++) {
				$pos = $j * $keySize + $permutation [$i];
				if ($pos < 26) {
					$substitution .= $alphabet {$pos};
				}
			}
		}
		
		// Decipher
		$decryptedText = "";
		for($i = 0; $i < $textSize; $i ++) {
			if ($text {$i} == " ") {
				$decryptedText .= " ";
			} else {
				$pos = strpos ( $substitution, $text {$i} );
				$decryptedText .= $alphabet {$pos};
			}
		}
		
		return $decryptedText;
	}
}

?>