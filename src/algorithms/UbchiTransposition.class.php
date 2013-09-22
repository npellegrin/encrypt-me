<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a block transposition with a given key.
 */
class UbchiTransposition implements iAlgorithm {
	private $key;
	private $empty;
	
	/**
	 * Constructor.
	 */
	function __construct($key, $empty) {
		// Clean key
		$key = Cleaner::prepareAlphabet ( $key );
		$key = Cleaner::removeEOL ( $key );
		
		// Store params
		$this->key = $key;
		$this->empty = $empty;
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
		$columnAlgorithm = new ColumnTransposition ( $this->key );
		
		// Column transposition
		$encryptedText = $columnAlgorithm->encrypt ( $text );
		
		// Add some letters (empty values)
		for($i = 0; $i < $this->empty; $i ++) {
			$encryptedText .= $alphabet {rand ( 0, 25 )};
		}
		
		// Column transposition
		$encryptedText = $columnAlgorithm->encrypt ( $encryptedText );
		
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
		$columnAlgorithm = new ColumnTransposition ( $this->key );
		
		// Column transposition
		$decryptedText = $columnAlgorithm->decrypt ( $text );
		
		// Remove empty letters
		$decryptedText = substr ( $decryptedText, 0, - $this->empty );
		
		// Column transposition
		$decryptedText = $columnAlgorithm->decrypt ( $decryptedText );
		
		// End
		return $decryptedText;
	}
}

?>