<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a Chase substitution with a given key.
 */
class Chase implements iAlgorithm {
	private $key;
	
	/**
	 * Constructor.
	 */
	function __construct($key) {
		// Clean key
		$key = Cleaner::removeSpaces ( $key );
		$key = Cleaner::removeEOL ( $key );
		
		// Prepare key (must have a size of 30 caracters)
		$key = substr ( $key, 0, 30 );
		while ( strlen ( $key ) < 30 ) {
			$key .= " ";
		}
		
		// Store key
		$this->key = $key;
	}
	
	/**
	 * Destructor
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
		
		// Get line an column for each letter
		$line = "";
		$column = "";
		for($i = 0; $i < strlen ( $text ); $i ++) {
			$pos = strpos ( $this->key, $text {$i} );
			$line .= intval ( $pos / 10 ) + 1;
			$column .= ($pos % 10 + 1) % 10;
		}
		
		// Multiply by 9
		// We use our own multiplication algorith, as PHP does not supports big integers
		$column = AlgorithmUtils::multiply ( $column, 9 );
		
		// Add elements to lines, to fit with column size
		while ( strlen ( $line ) < strlen ( $column ) ) {
			$line = rand ( 1, 3 ) . $line;
		}
		
		// Cipher
		$encryptedText = "";
		for($i = 0; $i < strlen ( $column ); $i ++) {
			if ($column {$i} == 0) {
				$col = 10;
			} else {
				$col = $column {$i};
			}
			$encryptedText .= $this->key {($line {$i} - 1) * 10 + ($col - 1)};
		}
		
		// End
		return $encryptedText;
	}
	
	/**
	 * Decrypt the text with the stored key, and returns the decrypted text.
	 */
	public function decrypt($text) {
		// Clean input
		$text = Cleaner::removeSpaces ( $text );
		$text = Cleaner::removeEOL ( $text );
		
		// Get line an column for each letter
		$line = "";
		$column = "";
		for($i = 0; $i < strlen ( $text ); $i ++) {
			$pos = strpos ( $this->key, $text {$i} );
			$line .= intval ( $pos / 10 ) + 1;
			$column .= ($pos % 10 + 1) % 10;
		}
		
		// Divide by 9
		// We use our own multiplication algorith, as PHP does not supports big integers
		$column = AlgorithmUtils::divide ( $column, 9 );
		
		// Remove extra numbers
		$line = substr ( $line, - strlen ( $column ) );
		
		// Decipher
		$decryptedText = "";
		for($i = 0; $i < strlen ( $column ); $i ++) {
			if ($column {$i} == 0) {
				$col = 10;
			} else {
				$col = $column {$i};
			}
			$decryptedText .= $this->key {($line {$i} - 1) * 10 + ($col - 1)};
		}
		
		// End
		return $decryptedText;
	}
}

?>
