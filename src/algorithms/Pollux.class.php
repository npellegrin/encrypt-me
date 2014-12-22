<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a Pollux substitution with a given set of key.
 */
class Pollux implements iAlgorithm {
	private $key;
	
	/**
	 * Constructor.
	 */
	function __construct($dotKey, $dashKey, $spaceKey) {
		// Keys must be arrays
		if (! is_array ( $dotKey )) {
			throw InvalidArgumentException ( "Keys must be arrays" );
		}
		if (! is_array ( $dashKey )) {
			throw InvalidArgumentException ( "Keys must be arrays" );
		}
		if (! is_array ( $spaceKey )) {
			throw InvalidArgumentException ( "Keys must be arrays" );
		}
		
		// Store keys
		$this->dotKey = $dotKey;
		$this->dashKey = $dashKey;
		$this->spaceKey = $spaceKey;
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
		
		// Cipher using morse algorithm
		$morseAlgorithm = new Morse ();
		$cipher = $morseAlgorithm->encrypt ( $text );
		
		// Cipher with Pollux substitution
		$encryptedText = "";
		for($i = 0; $i < strlen ( $cipher ); $i ++) {
			switch (mb_substr ( $cipher, $i, 1, 'UTF-8' )) {
				case '·' :
					$encryptedText .= $this->dotKey [array_rand ( $this->dotKey, 1 )];
					break;
				case '−' :
					$encryptedText .= $this->dashKey [array_rand ( $this->dashKey, 1 )];
					break;
				case ' ' :
					$encryptedText .= $this->spaceKey [array_rand ( $this->spaceKey, 1 )];
					break;
			}
		}
		
		// End
		return $encryptedText;
	}
	
	/**
	 * Decrypt the text with the stored keys, and returns the decrypted text.
	 */
	public function decrypt($text) {
		$text = Cleaner::removeEOL ( $text );
		$text = Cleaner::removeSpaces ( $text );
		
		// Browse cipher to rebuild morse output
		$index = 0;
		$morseCipher = "";
		while ( $index < strlen ( $text ) ) {
			
			// Cut text while we found a correspondance
			$found = false;
			$size = 1;
			while ( ! $found ) {
				
				// Get a segment of the text
				$segment = substr ( $text, $index, $size );
				
				// Search in keys if the segment can be decoded
				if (in_array ( $segment, $this->dotKey )) {
					// Found dot
					$morseCipher .= ".";
					$found = true;
				} elseif (in_array ( $segment, $this->dashKey )) {
					// Found dash
					$morseCipher .= "-";
					$found = true;
				} elseif (in_array ( $segment, $this->spaceKey )) {
					// Found space
					$morseCipher .= " ";
					$found = true;
				} else {
					// Segment not found, increase size
					$size ++;
				}
			}
			
			// Segment found, go next
			$index = $index + $size;
		}
		
		// Decode morse output
		$morseAlgorithm = new Morse ();
		return $morseAlgorithm->decrypt ( $morseCipher );
	}
}

?>
