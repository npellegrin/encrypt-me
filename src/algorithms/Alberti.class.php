<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a block transposition with a given key.
 */
class Alberti implements iAlgorithm {
	private $substitution1;
	private $substitution2;
	
	/**
	 * Constructor.
	 */
	function __construct($substitution1, $substitution2) {
		// Clean alpĥabets
		$substitution1 = Cleaner::prepareAlphabet ( $substitution1 );
		$substitution1 = Cleaner::removeEOL ( $substitution1 );
		
		$substitution2 = Cleaner::prepareAlphabet ( $substitution2 );
		$substitution2 = Cleaner::removeEOL ( $substitution2 );
		
		// Store alphabets
		$this->substitution1 = $substitution1;
		$this->substitution2 = $substitution2;
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
		$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		
		// Compute sizes once
		$substitutionSize1 = strlen ( $this->substitution1 );
		$substitutionSize2 = strlen ( $this->substitution2 );
		$textSize = strlen ( $text );
		
		// Cipher
		$encryptedText = "";
		for($i = 0; $i < $textSize; $i ++) {
			if ($i % 2) {
				@$encryptedText .= $this->substitution2 {strpos ( $alphabet, $text {$i} ) % $substitutionSize1};
			} else {
				@$encryptedText .= $this->substitution1 {strpos ( $alphabet, $text {$i} ) % $substitutionSize2};
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
		$text = Cleaner::prepareAlphabet ( $text );
		$text = Cleaner::removeEOL ( $text );
		
		// Init
		$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		
		// Compute sizes once
		$substitutionSize1 = strlen ( $this->substitution1 );
		$substitutionSize2 = strlen ( $this->substitution2 );
		$textSize = strlen ( $text );
		
		// Cipher
		$decryptedText = "";
		for($i = 0; $i < $textSize; $i ++) {
			if ($i % 2) {
				@$decryptedText .= $alphabet {strpos ( $this->substitution2, $text {$i} ) % $substitutionSize2};
			} else {
				@$decryptedText .= $alphabet {strpos ( $this->substitution1, $text {$i} ) % $substitutionSize1};
			}
		}
		
		return $decryptedText;
	}
}

?>