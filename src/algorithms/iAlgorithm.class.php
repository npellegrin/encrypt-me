<?php

/**
 * This interface represents an encryption algorithm.
 * Classes implementing this interface will be able to encrypt an decrypt phrases.
 * */
interface iAlgorithm {
	public function encrypt($text);
	public function decrypt($text);
}

?>