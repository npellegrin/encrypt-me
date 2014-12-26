<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a Vigenere substitution with a given key.
 */
class Vigenere implements iAlgorithm {
	private $key;
	
	/**
	 * Constructor.
	 */
	function __construct($key) {
		// Cleanup key
		$key = Cleaner::prepareAlphabet ( $key );
		$key = Cleaner::removeEOL ( $key );
		
		// Store key
		$this->key = $key;
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
		
		// Encrypt
		$encryptedText = '';
		$alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		for($i = 0; $i < strlen ( $text ); $i ++) {
			// Get positions from text and key
			$textPos = strpos ( $alphabet, $text {$i} );
			$keyPos = strpos ( $alphabet, $this->key {$i % strlen ( $this->key )} );
			
			// Rotate
			$encryptedText .= $alphabet {($textPos + $keyPos) % 26};
		}
		
		// End
		return $encryptedText;
	}
	
	/**
	 * Decrypt the text with the stored keys, and returns the decrypted text.
	 */
	public function decrypt($text) {
		// Clean input
		$text = Cleaner::prepareAlphabet ( $text );
		$text = Cleaner::removeEOL ( $text );
		
		// Encrypt
		$decryptedText = '';
		$alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		for($i = 0; $i < strlen ( $text ); $i ++) {
			// Get positions from text and key
			$textPos = strpos ( $alphabet, $text {$i} );
			$keyPos = strpos ( $alphabet, $this->key {$i % strlen ( $this->key )} );
			
			// Rotate
			$decryptedText .= $alphabet {($textPos - $keyPos + 26) % 26};
		}
		
		// End
		return $decryptedText;
	}
}

?>
