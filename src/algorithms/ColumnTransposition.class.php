<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a block transposition with a given key.
 */
class ColumnTransposition implements iAlgorithm {
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
		
		// Count the lines of the array
		if ($textSize % $keySize) {
			$lineCount = intval ( $textSize / $keySize ) + 1;
		} else {
			$lineCount = $textSize / $keySize;
		}
		
		// Transpose
		$encryptedArray = Array ();
		for($i = 0; $i < $lineCount; $i ++) {
			for($j = 0; $j < $keySize; $j ++) {
				$indice = $i * $keySize + $j;
				if ($indice < $textSize) {
					@$encryptedArray [$permutation [$j]] .= $text {$indice};
				}
			}
		}
		
		// Merge array
		ksort ( $encryptedArray );
		$encryptedText = implode ( $encryptedArray );
		
		// Group by 5
		for($i = 5; $i < strlen($encryptedText); $i += 6) {
			$encryptedText = substr_replace ( $encryptedText, " ", $i, 0 );
		}
		
		// End
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
		
		// Get permutation array
		$permutation_orig = AlgorithmUtils::getPermutation ( $this->key );
		
		// Flip permutation to decrypt
		$permutation = array_flip ( $permutation_orig );
		
		// Count the number of lines in the array
		if ($textSize % $keySize) {
			$lineCount = intval ( $textSize / $keySize ) + 1;
		} else {
			$lineCount = $textSize / $keySize;
		}
		
		// Add spaces for empty elements
		ksort ( $permutation_orig );
		$lastIndex = $textSize - ($lineCount * $keySize);
		if ($lastIndex != '0') {
			$lost = array_slice ( $permutation_orig, $lastIndex );
		} else {
			$lost = Array ();
		}
		
		// Transpose
		$decryptedArray = Array ();
		$pos = 0;
		for($i = 0; $i < $keySize; $i ++) {
			if (in_array ( $i, $lost )) {
				$line = $lineCount - 1;
			} else {
				$line = $lineCount;
			}
			$decryptedArray [$permutation [$i]] = substr ( $text, $pos, $line );
			$pos += $line;
		}
		
		// Merge array
		ksort ( $decryptedArray );
		$decryptedText = "";
		for($line = 0; $line < $lineCount; $line ++) {
			foreach ( $decryptedArray as $value ) {
				if ($line < strlen ( $value )) {
					$decryptedText .= $value {$line};
				}
			}
		}
		
		// Cut extra characters
		$decryptedText = substr ( $decryptedText, 0, $textSize );
		
		return $decryptedText;
	}
}

?>