<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a block transposition with a given key.
 */
class Albam implements iAlgorithm {
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
		// Rot13
		$cesar = new Cesar(13);
		return $cesar->encrypt($text);
	}
	
	/**
	 * Decrypt the text with the stored key, and returns the decrypted text.
	 */
	public function decrypt($text) {
		// Symetrical cipher
		return $this->encrypt($text);
	}
}

?>