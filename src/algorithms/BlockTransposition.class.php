<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a block transposition with a given key.
 */
class BlockTransposition implements iAlgorithm {
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
		$text = Cleaner::prepareAlphabet ( $text );
		$text = Cleaner::removeEOL ( $text );
		
		// Compute sizes once
		$keySize = strlen ( $this->key );
		$textSize = strlen ( $text );
		
		// Get permutation array
		$permutation = AlgorithmUtils::getPermutation ( $this->key );
		
		// Transpose
		$code = Array ();
		for($i = 0; $i < $textSize; $i ++) {
			$block = intval ( $i / $keySize ); // block number
			$index = $i % $keySize; // permutation index
			$code [$block] [$permutation [$index]] = $text {$i};
		}
		
		// Merge array
		for($i = 0; $i < sizeof ( $code ); $i ++) {
			// Sort keys
			ksort ( $code [$i] );
			// Implode
			$code [$i] = implode ( $code [$i] );
		}
		
		// Merge encrypted text, and group by 5
		$encryptedText = implode ( $code );
		for($i = 5; $i < strlen ( $encryptedText ); $i += 6) {
			$encryptedText = substr_replace ( $encryptedText, " ", $i, 0 );
		}
		
		return $encryptedText;
	}
	
	/**
	 * Decrypt the text with the stored key, and returns the decrypted text.
	 */
	public function decrypt($text) {
		// Clean input
		$text = Cleaner::prepareAlphabet ( $text );
		$text = Cleaner::removeEOL ( $text );
		
		// Compute sizes once
		$keySize = strlen ( $this->key );
		$textSize = strlen ( $text );
		$textSizeOrig = $textSize;
		
		// Get permutation array
		$permutation_orig = AlgorithmUtils::getPermutation ( $this->key );
		
		// Flip permutation to decrypt
		$permutation = array_flip ( $permutation_orig );
		
		// Add missing values if the last block is smaller than the permutation
		ksort ( $permutation_orig );
		if ($textSize % $keySize != 0) {
			// Compute the position of lost characters
			$lastBlock = intval ( $textSize / $keySize ) * $keySize;
			$lastIndex = $textSize - $lastBlock;
			// Get lost permutations
			$lost = array_slice ( $permutation_orig, $lastIndex );
			sort ( $lost );
			// Insert a space for each lost character
			foreach ( $lost as $value ) {
				$text = substr_replace ( $text, " ", $lastBlock + $value, 0 );
			}
			
			// Update text size
			$textSize = strlen ( $text );
		}
		
		// Decrypt
		$code = Array ();
		for($i = 0; $i < $textSize; $i ++) {
			$block = intval ( $i / $keySize ); // Block number
			$index = $i % $keySize; // Current index
			$code [$block] [$permutation [$index]] = $text {$i};
		}
		
		// Merge array
		for($i = 0; $i < sizeof ( $code ); $i ++) {
			ksort ( $code [$i] );
			$code [$i] = implode ( $code [$i] );
		}
		
		// Rebuild text, and cut extra characters
		$decryptedText = implode ( $code );
		$decryptedText = substr ( $decryptedText, 0, $textSizeOrig );
		
		return $decryptedText;
	}
}

?>