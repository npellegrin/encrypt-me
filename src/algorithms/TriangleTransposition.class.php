<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a block transposition with a given key.
 */
class TriangleTransposition implements iAlgorithm {
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
		
		// Init
		$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		
		// Compute the line count to get the triangle height
		$n = 0;
		$lineCount = 1;
		while ( $n < $textSize ) {
			$n += $lineCount;
			$lineCount ++;
		}
		$lineCount --;
		
		// Size of the base
		$baseSize = 2 * $lineCount - 1;
		
		// Repeat the key to fill the base
		$i = 0;
		$baseKey = $this->key;
		while ( strlen ( $baseKey ) < $baseSize ) {
			$baseKey .= $baseKey {$i % $keySize};
			$i ++;
		}
		
		// Put the text in the triangle
		$n = 0;
		$limit = 0;
		$encryptedArray = Array ();
		for($j = 0; $j < $lineCount; $j ++) {
			for($i = - $limit; $i <= $limit; $i += 2) {
				if ($n < $textSize) {
					@$encryptedArray [$i] .= $text {$n};
				} else {
					@$encryptedArray [$i] .= $alphabet {rand ( 0, 25 )};
				}
				
				$n ++;
			}
			$limit ++;
		}
		
		// Renumber the array from 0 to baseKeySize
		ksort ( $encryptedArray );
		$new = Array ();
		foreach ( $encryptedArray as $value ) {
			array_push ( $new, $value );
		}
		$encryptedArray = $new;
		
		// Get permutation
		$permutation = AlgorithmUtils::getPermutation ( $baseKey );
		$permutation = array_flip ( $permutation );
		
		// Transpose the columns of the triangle
		$encryptedText = "";
		for($i = 0; $i < $baseSize; $i ++) {
			$encryptedText .= $encryptedArray [$permutation [$i]];
		}
		
		// Group by 5
		for($i = 5; $i < strlen ( $encryptedText ); $i += 6) {
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
		
		// Compute the line count to get the triangle height
		$n = 0;
		$lineCount = 1;
		while ( $n < $textSize ) {
			$n += $lineCount;
			$lineCount ++;
		}
		$lineCount --;
		
		// Size of the base
		$baseSize = 2 * $lineCount - 1;
		
		// Fill the base with the key
		$i = 0;
		$baseKey = $this->key;
		while ( strlen ( $baseKey ) < $baseSize ) {
			$baseKey .= $baseKey {$i % $keySize};
			$i ++;
		}
		
		// Get permutation
		$permutation = AlgorithmUtils::getPermutation ( $baseKey );
		$permutation = array_flip ( $permutation );
		
		// Center of the triangle
		$center = intval ( $baseSize / 2 );
		
		// Put the text in the triangle
		$position = 0;
		$decryptedArray = Array ();
		for($i = 0; $i < $baseSize; $i ++) {
			// Get current line
			if ($permutation [$i] > $center) {
				$lineSize = intval ( ($baseSize - 1 - $permutation [$i]) / 2 ) + 1;
			} else {
				$lineSize = intval ( $permutation [$i] / 2 ) + 1;
			}
			
			// Encrypt the current line
			$decryptedArray [$permutation [$i]] = substr ( $text, $position, $lineSize );
			$position += $lineSize;
			
			// Update the line size
			if ($i < intval ( $baseSize / 2 )) {
				$lineSize ++;
			} else {
				$lineSize --;
			}
		}
		
		// Merge text
		$n = 0;
		$limit = 0;
		$decryptedText = "";
		for($j = 0; $j < $lineCount; $j ++) {
			for($i = $center - $limit; $i <= $center + $limit; $i += 2) {
				if (strlen ( $decryptedArray [$i] ) > 0) {
					$decryptedText .= $decryptedArray [$i] {0};
					$decryptedArray [$i] = substr ( $decryptedArray [$i], 1 );
				}
			}
			$limit ++;
		}
		
		// End
		return $decryptedText;
	}
}

?>