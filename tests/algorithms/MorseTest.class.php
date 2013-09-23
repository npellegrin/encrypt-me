<?php
require_once 'src/algorithms/Morse.class.php';

/**
 * This class contains the unit tests for block transposition algorithm.
 */
class MorseTest extends PHPUnit_Framework_TestCase {
	/**
	 * Set up test.
	 */
	protected function setUp() {
	}
	
	/**
	 * Tear down test.
	 */
	protected function tearDown() {
	}
	
	/**
	 * Test encryption.
	 */
	public function testEncrypt() {
		$algorithm = new Morse ();
		$encryptedText = $algorithm->encrypt ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE" );
		$this->assertEquals ( "·−· · −· −·· · −−·· ···− −−− ··− ··· ·− −− ·· −·· ·· ·−−· ·−·· ·− −·−· · −·· · ·−·· ·− ·−·· ·· −··· · ·−· − ·", $encryptedText );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new Morse ();
		$decryptedText = $algorithm->decrypt ( "·−· · −· −·· · −−·· ···− −−− ··− ··· ·− −− ·· −·· ·· ·−−· ·−·· ·− −·−· · −·· · ·−·· ·− ·−·· ·· −··· · ·−· − ·" );
		$this->assertEquals ( "RENDEZVOUSAMIDIPLACEDELALIBERTE", $decryptedText );
	}
}

?>