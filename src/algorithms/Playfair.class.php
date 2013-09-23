<?php
require_once 'src/algorithms/iAlgorithm.class.php';
require_once 'src/utilities/Cleaner.class.php';
require_once 'src/utilities/AlgorithmUtils.class.php';

/**
 * This class can perform a block transposition with a given key.
 */
class Playfair implements iAlgorithm {
	private $grille;
	
	/**
	 * Constructor.
	 */
	function __construct($grille) {
		// Clean key
		$grille = Cleaner::prepareAlphabet ( $grille );
		$grille = Cleaner::removeEOL ( $grille );
		
		// Store key
		$this->grille = $grille;
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
		
		// Compute size
		$textSize = strlen ( $text );
		
		// Insert a letter if there are two identical letters in pairs
		for($i = 0; $i < strlen ( $text ) - 1; $i ++) {
			if ($text {$i} == $text {$i + 1}) {
				// Insert a different letter
				do {
					$lettre = $alphabet {rand ( 0, 25 )};
				} while ( $lettre == $text {$i} );
				$text = substr_replace ( $text, $lettre, $i + 1, 0 );
				$i ++;
				
				// Update grid
				$textSize ++;
			}
		}
		
		// Add a letter if the character count is not peer
		if ($textSize % 2) {
			$text .= $alphabet {rand ( 0, 25 )};
			$textSize ++;
		}
		
		// Encrypt
		$encryptedText = "";
		for($i = 0; $i < $textSize; $i += 2) {
			// Compute coords
			$x1 = strpos ( $this->grille, $text {$i} ) % 5;
			$y1 = intval ( strpos ( $this->grille, $text {$i} ) / 5 );
			$x2 = strpos ( $this->grille, $text {$i + 1} ) % 5;
			$y2 = intval ( strpos ( $this->grille, $text {$i + 1} ) / 5 );
			
			// Substitution using the Playfair cipher
			if ($y1 == $y2) {
				// Same line
				$encryptedText .= $this->grille {5 * $y1 + (($x1 + 1) % 5)};
				$encryptedText .= $this->grille {5 * $y2 + (($x2 + 1) % 5)};
			} elseif ($x1 == $x2) {
				// Same column
				$encryptedText .= $this->grille {5 * (($y1 + 1) % 5) + $x1};
				$encryptedText .= $this->grille {5 * (($y2 + 1) % 5) + $x2};
			} else {
				// Line and column are different
				$encryptedText .= $this->grille {(5 * $y1 + $x2)};
				$encryptedText .= $this->grille {(5 * $y2 + $x1)};
			}
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
		// Clean input
		$text = Cleaner::prepareAlphabet ( $text );
		$text = Cleaner::removeEOL ( $text );
		
		// Init
		$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		
		// Compute size
		$textSize = strlen ( $text );
		
		/* Ajoute une lettre si ce n'est pas un nombre pair (mais à priori on nous a envoyé ce qu'il faut) */
		if ($textSize % 2) {
			$text .= $alphabet {rand ( 0, 25 )};
			$textSize ++;
		}
		
		/* Code la phrase */
		$decryptedText = "";
		for($i = 0; $i < $textSize; $i += 2) {
			/* Calcule les coordonénes des lettres */
			$x1 = strpos ( $this->grille, $text {$i} ) % 5;
			$y1 = intval ( strpos ( $this->grille, $text {$i} ) / 5 );
			$x2 = strpos ( $this->grille, $text {$i + 1} ) % 5;
			$y2 = intval ( strpos ( $this->grille, $text {$i + 1} ) / 5 );
			
			/* Substitue en suivant la règle de Playfair */
			if ($y1 == $y2) {
				/* Même ligne */
				$decryptedText .= $this->grille {5 * $y1 + (($x1 + 4) % 5)};
				$decryptedText .= $this->grille {5 * $y2 + (($x2 + 4) % 5)};
			} elseif ($x1 == $x2) {
				/* Même colonne */
				$decryptedText .= $this->grille {5 * (($y1 + 4) % 5) + $x1};
				$decryptedText .= $this->grille {5 * (($y2 + 4) % 5) + $x2};
			} else {
				/* Ligne et colonne différentes */
				$decryptedText .= $this->grille {(5 * $y1 + $x2)};
				$decryptedText .= $this->grille {(5 * $y2 + $x1)};
			}
		}
		
		// End
		return $decryptedText;
	}
}

?>