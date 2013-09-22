<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a block transposition with a given key.
 */
class SawtoothTransposition implements iAlgorithm {
	private $lineCount;
	
	/**
	 * Constructor.
	 */
	function __construct($lineCount) {
		// Store key
		$this->lineCount = $lineCount;
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
		
		// Compute size
		$textSize = strlen ( $text );
		
		// Encrypt
		$i = 0;
		$encryptedArray = Array ();
		while ( $i < $textSize ) {
			$j = 0;
			while ( $j < $this->lineCount ) {
				@$encryptedArray [$j] .= $text {$i + $j};
				$j ++;
			}
			$i += $this->lineCount;
		}
		
		// Merge array
		$encryptedText = implode ( "\n", $encryptedArray );
		
		// End
		return $encryptedText;
	}
	
	/**
	 * Decrypt the text with the stored key, and returns the decrypted text.
	 */
	public function decrypt($text) {
		// Clean input
		$text = Cleaner::prepareAlphabet ( $text );
		
		// Explode
		$decryptedArray = explode ( "\n", $text );
		
		// Compute sizes
		$arraySize = sizeof ( $decryptedArray );
		$textSize = strlen ( $decryptedArray [0] );
		
		// Decrypt
		$decryptedText = "";
		for($j = 0; $j < $textSize; $j ++) {
			for($i = 0; $i < $arraySize; $i ++) {
				if ($j < strlen ( $decryptedArray [$i] )) {
					$decryptedText .= $decryptedArray [$i] {$j};
				}
			}
		}
		
		// End
		return $decryptedText;
	}
}

?>