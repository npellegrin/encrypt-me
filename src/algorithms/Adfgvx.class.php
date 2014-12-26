<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform an ADFGVX substitution with a given key.
 */
class Adfgvx implements iAlgorithm {
	private $map;
	private $ADFGVX;
	private $key;
	
	/**
	 * Constructor.
	 */
	function __construct($key) {
		// Constants
		$this->map = array(
				array('C', '1', 'O', 'F', 'W', 'J'),
				array('Y', 'M', 'T', '5', 'B', '4'),
				array('I', '7', 'A', '2', '8', 'S'),
				array('P', '3', '0', 'Q', 'H', 'X'),
				array('K', 'E', 'U', 'L', '6', 'D'),
				array('V', 'R', 'G', 'Z', 'N', '9') 
		);
		$this->ADFGVX = "ADFGVX";
		
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
		
		// Substitute with columns indexes
		$cipher = '';
		for($i = 0; $i < strlen ( $text ); $i ++) {
			$found = AlgorithmUtils::array_search_rec ( $text {$i}, $this->map );
			if ($found !== false) {
				$cipher .= $this->ADFGVX {$found [0]} . $this->ADFGVX {$found [1]};
			}
		}
		
		// Transpose columns with given key
		$columnTranspositionAlgorithm = new ColumnTransposition ( $this->key );
		$encryptedText = $columnTranspositionAlgorithm->encrypt ( $cipher );
		
		// End
		return $encryptedText;
	}
	
	/**
	 * Decrypt the text with the stored keys, and returns the decrypted text.
	 */
	public function decrypt($text) {
		$text = Cleaner::removeEOL ( $text );
		$text = Cleaner::removeSpaces ( $text );
		
		// Remove transposition
		$columnTranspositionAlgorithm = new ColumnTransposition ( $this->key );
		$cipher = $columnTranspositionAlgorithm->decrypt ( $text );
		
		// Get back text from grid
		$decryptedText = "";
		for($i = 0; $i < strlen ( $cipher ); $i += 2) {
			$line = strpos ( $this->ADFGVX, $cipher {$i} );
			$column = strpos ( $this->ADFGVX, $cipher {$i + 1} );
			$decryptedText .= $this->map [$line] [$column];
		}
		
		// End
		return $decryptedText;
	}
}

?>
