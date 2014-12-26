<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a Porta substitution with a given key.
 */
class Porta implements iAlgorithm {
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
		
		// Build Porta's alphabets
		$alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$substitution = Array ();
		for($i = 0; $i < 13; $i ++) {
			@$substitution [$i] = substr ( $alphabet, 0, 13 ) . substr ( $alphabet, 26 - $i, $i ) . substr ( $alphabet, 13, 13 - $i );
		}
		
		$encryptedText = '';
		for($i = 0; $i < strlen ( $text ); $i ++) {
			// Get alphabet index
			$index = intval ( strpos ( $alphabet, $this->key {$i % strlen ( $this->key )} ) / 2 );
			
			// Substitute
			$pos = strpos ( $substitution [$index], $text {$i} );
			$encryptedText .= $substitution [$index] {($pos + 13) % 26};
		}
		
		// End
		return $encryptedText;
	}
	
	/**
	 * Decrypt the text with the stored keys, and returns the decrypted text.
	 */
	public function decrypt($text) {
		// Symmetrical cipher
		return $this->encrypt ( $text );
	}
}

?>
