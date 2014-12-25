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
	
	/**
	 * This function substracts two big integer and return the result as a string.
	 * The parameters given in input must be string of integers, for example "29839740842707238748543".
	 *
	 * Substracting elements as string is mandatory for big integers, as PHP does not supports very (very) big integers.
	 */
	function substract($n1, $n2) {
		// Init result
		$result = Array ();
		
		// Properly get string values (thank you php...)
		$n1 = strval ( $n1 );
		$n2 = strval ( $n2 );
		
		// Invert numbers if first is smaller
		if (intval ( $n1 ) < intval ( $n2 )) {
			return '-' . substract ( $n2, $n1 );
		}
		
		// Compute sizes
		$size1 = strlen ( $n1 );
		$size2 = strlen ( $n2 );
		
		// Substract
		$remainder = 0;
		for($i = 0; $i < $size1; $i ++) {
			// Substract current column
			$tmp = $n1 {$size1 - $i - 1} - $remainder;
			
			if ($i < $size2) {
				$tmp -= $n2 {$size2 - $i - 1};
			}
			
			// If tmp < 0, there is a retain
			if ($remainder = ($tmp < 0)) {
				$tmp += 10;
			}
			
			// Set result as tmp
			@$result [$i] = $tmp;
		}
		
		// Concat
		krsort ( $result );
		$result = implode ( $result );
		
		// Remove trailing zeros
		$i = 0;
		while ( strlen ( $result ) > 1 && $result {$i} == '0' ) {
			$result = substr ( $result, 1 - strlen ( $result ) );
		}
		
		// End
		return $result;
	}
	
	/**
	 * This function multiply two big integer and return the result as a string.
	 * The parameters given in input must be string of integers, for example "29839740842707238748543".
	 *
	 * Multiplying elements as string is mandatory for big integers, as PHP does not supports very (very) big integers.
	 */
	public static function multiply($n1, $n2) {
		// Init result
		$result = Array ();
		
		// Properly get string values (thank you php...)
		$n1 = strval ( $n1 );
		$n2 = strval ( $n2 );
		
		// Multiply
		for($i = strlen ( $n1 ) - 1; $i >= 0; $i --) {
			for($j = strlen ( $n2 ) - 1; $j >= 0; $j --) {
				$mult = intval ( $n1 {$i} ) * intval ( $n2 {$j} );
				@$result [$i + $j] += intval ( ($result [$i + $j + 1] + $mult) / 10 );
				@$result [$i + $j + 1] = ($result [$i + $j + 1] + $mult) % 10;
			}
		}
		
		// Concat
		ksort ( $result );
		$result = implode ( $result );
		
		// Delete zero at start of the string
		$i = 0;
		while ( strlen ( $result ) > 1 && $result {$i} == '0' ) {
			$result = substr ( $result, 1 - strlen ( $result ) );
		}
		
		// End
		return $result;
	}
	
	/**
	 * This function divide two big integer and return the result as a string.
	 * The parameters given in input must be string of integers, for example "29839740842707238748543".
	 *
	 * Dividing elements as string is mandatory for big integers, as PHP does not supports very (very) big integers.
	 */
	public static function divide($n1, $n2) {
		// Init result
		$result = Array ();
		
		// Properly get string values (thank you php...)
		$n1 = strval ( $n1 );
		$n2 = strval ( $n2 );
		
		// Compute sizes
		$size1 = strlen ( $n1 );
		
		// Divide
		$remainder = '';
		for($i = 0; $i < $size1; $i ++) {
			// Decrement remainder from n1
			$remainder .= $n1 {$i};
			
			// Quotient have 0
			$result [$size1 - $i - 1] = 0;
			
			/*
			 * In remainder, how many n2 ?
			 * The result is the next quotient number
			 */
			while ( intval ( $remainder ) >= intval ( $n2 ) ) {
				$result [$size1 - $i - 1] ++;
				$remainder = AlgorithmUtils::substract ( $remainder, $n2 );
			}
		}
		
		// Concat
		krsort ( $result );
		$result = implode ( $result );
		
		// Remove trailing zero
		$i = 0;
		while ( strlen ( $result ) > 1 && $result {$i} == '0' ) {
			$result = substr ( $result, 1 - strlen ( $result ) );
		}
		
		// End
		return $result;
	}
	
	/**
	 * Recursive search in array (as array_find, but for n-dimentional arrays).
	 */
	public static function array_search_rec($needle, $haystack) {
		foreach ( $haystack as $key => $value ) {
			// End of recursion
			if ($needle === $value) {
				return array (
						$key 
				);
			}
			
			// Search over
			if (is_array ( $value )) {
				$found = AlgorithmUtils::array_search_rec ( $needle, $value );
				if ($found !== false) {
					// Keys found
					return array_merge ( array (
							$key 
					), $found );
				}
			}
		}
		
		// Not found
		return false;
	}
}
?>
