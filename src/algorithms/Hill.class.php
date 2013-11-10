<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/exceptions/SingularMatrixException.class.php';
require_once 'src/utilities/Cleaner.class.php';

/**
 * This class can perform a block transposition with a given key.
 */
class Hill implements iAlgorithm {
	private $a;
	private $b;
	private $c;
	private $d;
	
	/**
	 * Constructor.
	 */
	function __construct($a, $b, $c, $d) {
		// Clean keys
		$a = Cleaner::prepareNumber ( $a );
		$b = Cleaner::prepareNumber ( $b );
		$c = Cleaner::prepareNumber ( $c );
		$d = Cleaner::prepareNumber ( $d );
		
		// Exception if the matrix is not reversible
		$det = $a * $d - $b * $c;
		if ($det == 0 || ! ($det % 13)) {
			throw new SingularMatrixException ( "The matrix (" + $a + ", " + $b + ", " + $c + ", " + $d + ") cannot be inverted." );
		}
		
		// Store keys
		$this->a = $a;
		$this->b = $b;
		$this->c = $c;
		$this->d = $d;
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
		// Init
		$text = Cleaner::prepareAlphabet ( $text );
		$text = Cleaner::removeEOL ( $text );
		$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		
		// Compute size
		$textSize = strlen ( $text );
		
		// Assert there is a pair number of letters
		if ($textSize % 2) {
			$text .= $alphabet {rand ( 0, 25 )};
			$textSize ++;
		}
		
		// Encrypt
		$encryptedText = "";
		for($i = 0; $i < $textSize; $i += 2) {
			// Get positions
			$pos1 = strpos ( $alphabet, $text {$i} );
			$pos2 = strpos ( $alphabet, $text {$i + 1} );
			
			// Encrypt
			$encryptedText .= $alphabet {(($pos1 * $this->a + $pos2 * $this->b) % 26 + 26) % 26};
			$encryptedText .= $alphabet {(($pos1 * $this->c + $pos2 * $this->d) % 26 + 26) % 26};
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
		// Init
		$text = Cleaner::prepareAlphabet ( $text );
		$text = Cleaner::removeEOL ( $text );
		$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		
		// Compute size
		$textSize = strlen ( $text );
		
		// Assert there is a pair number of letters
		if ($textSize % 2) {
			$text .= $alphabet {rand ( 0, 25 )};
			$textSize ++;
		}
		
		// Invert matrix
		$det = $this->a * $this->d - $this->b * $this->c;
		$decrypt_a = $this->d / $det;
		$decrypt_b = - $this->b / $det;
		$decrypt_c = - $this->c / $det;
		$decrypt_d = $this->a / $det;
		
		// Decrypt (same as encrypt)
		$decryptedText = "";
		for($i = 0; $i < $textSize; $i += 2) {
			// Get positions
			$pos1 = strpos ( $alphabet, $text {$i} );
			$pos2 = strpos ( $alphabet, $text {$i + 1} );
			
			// Decrypt
			$decryptedText .= $alphabet {(($pos1 * $decrypt_a + $pos2 * $decrypt_b) % 26 + 26) % 26};
			$decryptedText .= $alphabet {(($pos1 * $decrypt_c + $pos2 * $decrypt_d) % 26 + 26) % 26};
		}
		
		// End
		return $decryptedText;
	}
}

?>