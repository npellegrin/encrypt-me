<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a block transposition with a given key.
 */
class ThreeSquare implements iAlgorithm {
	private $topGrid;
	private $leftGrid;
	private $rightGrid;
	
	/**
	 * Constructor.
	 */
	function __construct($topGrid, $leftGrid, $rightGrid) {
		// Clean keys
		$topGrid = Cleaner::prepareAlphabet ( $topGrid );
		$topGrid = Cleaner::removeEOL ( $topGrid );
		$topGrid = substr ( $topGrid, 0, 25 );
		
		$leftGrid = Cleaner::prepareAlphabet ( $leftGrid );
		$leftGrid = Cleaner::removeEOL ( $leftGrid );
		$leftGrid = substr ( $leftGrid, 0, 25 );
		
		$rightGrid = Cleaner::prepareAlphabet ( $rightGrid );
		$rightGrid = Cleaner::removeEOL ( $rightGrid );
		$rightGrid = substr ( $rightGrid, 0, 25 );
		
		// Store keys
		$this->topGrid = $topGrid;
		$this->leftGrid = $leftGrid;
		$this->rightGrid = $rightGrid;
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
		
		// Add a letter to have a pair count of characters
		if ($textSize % 2) {
			$text .= $alphabet {rand ( 0, 25 )};
			$textSize ++;
		}
		
		// Encrypt
		$encryptedText = "";
		for($i = 0; $i < $textSize; $i += 2) {
			// Get position in the left
			$leftColumn = strpos ( $this->leftGrid, $text {$i} );
			$leftLine = intval ( $leftColumn / 5 );
			$leftColumn = $leftColumn % 5;
			
			// Get position in the top
			$topColumn = strpos ( $this->topGrid, $text {$i + 1} );
			$topLine = intval ( $topColumn / 5 );
			$topColumn = $topColumn % 5;
			
			// Encrypt with left
			$pos = rand ( 0, 4 ) * 5 + $leftColumn;
			$encryptedText .= $this->leftGrid {$pos};
			
			// Encrypt with right
			$pos = $leftLine * 5 + $topColumn;
			$encryptedText .= $this->rightGrid {$pos};
			
			// Encrypt with top
			$pos = $topLine * 5 + rand ( 0, 4 );
			$encryptedText .= $this->topGrid {$pos};
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
		
		// Add letters to have a multiple of 3 in the text
		while ( $textSize % 3 ) {
			$text .= $alphabet {rand ( 0, 25 )};
			$textSize ++;
		}

				// Decrypt
		$decryptedText = "";
		for($i = 0; $i < $textSize; $i += 3) {
			// Get left position
			$leftColumn = strpos ( $this->leftGrid, $text {$i} );
			$leftLine = intval ( $leftColumn / 5 );
			$leftColumn = $leftColumn % 5;
			
			// Get right position
			$rightColumn = strpos ( $this->rightGrid, $text {$i + 1} );
			$rightLine = intval ( $rightColumn / 5 );
			$rightColumn = $rightColumn % 5;
			
			// Get top position
			$topColumn = strpos ( $this->topGrid, $text {$i + 2} );
			$ligne_haut = intval ( $topColumn / 5 );
			$topColumn = $topColumn % 5;
			
			// Decrypt first letter
			$pos = $rightLine * 5 + $leftColumn;
			$decryptedText .= $this->leftGrid {$pos};

			// Decrypt second letter
			$pos = $ligne_haut * 5 + $rightColumn;
			$decryptedText .= $this->topGrid {$pos};
		}
		
		// End
		return $decryptedText;
	}
}

?>