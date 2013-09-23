<?php
require_once 'src/algorithms/Albam.class.php';

/**
 * This class contains the unit tests for block transposition algorithm.
 */
class AlbamTest extends PHPUnit_Framework_TestCase {
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
		$algorithm = new Albam ();
		$encryptedText = $algorithm->decrypt ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE" );
		$this->assertEquals ( "ERAQRM IBHF N ZVQV CYNPR QR YN YVOREGR", $encryptedText );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new Albam ();
		$decryptedText = $algorithm->decrypt ( "ERAQRM IBHF N ZVQV CYNPR QR YN YVOREGR" );
		$this->assertEquals ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE", $decryptedText );
	}
}

?>