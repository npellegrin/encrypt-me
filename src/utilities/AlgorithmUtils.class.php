<?php
/**
 * This class contains some algorithm utilities.
 * */
class AlgorithmUtils {
	/**
	 * This function returns the permutation array built with the given key.
	 * The array contains correspondances between indexes in alphabet.
	 *
	 * Example: If the key is KEY, the permutation is 213 (alphabetical order E, K, Y),
	 * and the permutation array is:
	 * 1 -> 2
	 * 2 -> 1
	 * 3 -> 3
	 * For convenient transformation using strpos, the array is build from 0:
	 * Array ( [0] => 1 [1] => 0 [2] => 2 )
	 */
	public static function getPermutation($key) {
		$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		
		// Declare index of future letter
		$index = 0;
		
		// Declare permutation array
		$permutation = Array ();
		
		// Build permutation
		for($i = 0; $i < 26; $i ++) { // Iterate on all letters of the alphabet
		                              
			// Search the letter in the key
			$offset = 0;
			while ( $offset < strlen ( $key ) && ($pos = strpos ( $key, $alphabet {$i}, $offset )) !== FALSE ) {
				// Update permutation array
				$permutation [$pos] = $index;
				
				// Update offset: search after this position if the same letter exists
				$offset = $pos + 1;
				
				// Update permutation index
				$index ++;
			}
		}
		
		return $permutation;
	}
}
?>