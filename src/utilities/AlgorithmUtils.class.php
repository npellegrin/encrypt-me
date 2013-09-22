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
	
	/**
	 * This function rotate the array given in parameter and returns the new array.
	 */
	public static function rotateArray($array) {
		// Compute size
		$arraySize = sizeof ( $array );
		
		// Create the new array
		$newArray = Array ();
		for($a = 0; $a < $arraySize; $a ++) {
			$newArray [$a] = Array ();
		}
		
		// Rotate
		for($a = 0; $a < $arraySize; $a ++) {
			foreach ( $array [$a] as $value ) {
				// Append values
				array_push ( $newArray [$value], $arraySize - 1 - $a );
			}
			// Remove value read
			unset ( $value );
		}
		
		// Sort arrays
		for($a = 0; $a < $arraySize; $a ++) {
			sort ( $newArray [$a] );
		}
		
		// End
		return $newArray;
	}
}
?>