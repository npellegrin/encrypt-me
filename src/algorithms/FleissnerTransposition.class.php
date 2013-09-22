<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a block transposition with a given key.
 */
class FleissnerTransposition implements iAlgorithm {
	private $fleissner;
	
	/**
	 * Constructor.
	 */
	function __construct() {
		// Fleissner reference
		$this->fleissner = Array (
				Array (
						1,
						3,
						5 
				),
				Array (
						4 
				),
				Array (
						2 
				),
				Array (
						1,
						4 
				),
				Array (
						5 
				),
				Array (
						3 
				) 
		);
	}
	
	/**
	 * Destructor.
	 */
	function __destruct() {
	}
	
	/**
	 * Encrypt the text, and returns the encrypted text.
	 */
	public function encrypt($text) {
		// Clean input
		$text = Cleaner::prepareAlphabet ( $text );
		$text = Cleaner::removeEOL ( $text );
		
		// Declare letters
		$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		
		// Compute sizes once
		$textSize = strlen ( $text );
		
		// Get grille
		$grille = $this->fleissner;
		
		// Encrypt
		$encryptedArray = Array ();
		$n = 0;
		for($i = 0; $i < 4; $i ++) { // 4 rotations
			for($ligne = 0; $ligne < 6; $ligne ++) { // 6x6 array
				for($colonne = 0; $colonne < sizeof ( $grille [$ligne] ); $colonne ++) {
					if ($n < $textSize) {
						// Add letters to grille
						$encryptedArray [$ligne] [$grille [$ligne] [$colonne]] = $text {$n};
						$n ++;
					} else {
						// Add random letters
						$encryptedArray [$ligne] [$grille [$ligne] [$colonne]] = $alphabet {rand ( 0, 25 )};
						$n ++;
					}
				}
				unset ( $colonne );
			}
			
			// Rotate grille
			$grille = AlgorithmUtils::rotateArray ( $grille );
		}
		
		// Merge text
		$encryptedText = "";
		for($i = 0; $i < 6; $i ++) {
			ksort ( $encryptedArray [$i] );
			for($j = 0; $j < 6; $j ++) {
				$encryptedText .= $encryptedArray [$i] [$j];
			}
		}
		
		// Group by 6
		for($i = 6; $i < strlen ( $encryptedText ); $i += 7) {
			$encryptedText = substr_replace ( $encryptedText, " ", $i, 0 );
		}
		
		// End
		return $encryptedText;
	}
	
	/**
	 * Decrypt the text, and returns the decrypted text.
	 */
	public function decrypt($text) {
		// Clean input
		$text = Cleaner::prepareAlphabet ( $text );
		$text = Cleaner::removeEOL ( $text );
		
		// Compute sizes once
		$textSize = strlen ( $text );
		
		// Get grille
		$grille = $this->fleissner;
		
		// Rebuild text
		$decryptedArray = Array ();
		for($i = 0; $i < 6; $i ++) {
			for($j = 0; $j < 6; $j ++) {
				if (6 * $i + $j < $textSize) {
					$decryptedArray [$i] [$j] = $text {6 * $i + $j};
				} else {
					$decryptedArray [$i] [$j] = " ";
				}
			}
		}
		
		// Implode array
		$decryptedText = "";
		for($n = 0; $n < 4; $n ++) { // 4 rotations
			for($i = 0; $i < 6; $i ++) { // 6x6 array
				for($j = 0; $j < sizeof ( $grille [$i] ); $j ++) {
					$decryptedText .= $decryptedArray [$i] [$grille [$i] [$j]];
				}
			}
			
			// Rotate grid
			$grille = AlgorithmUtils::rotateArray ( $grille );
		}
		
		// End
		return $decryptedText;
	}
}

?>