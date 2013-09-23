<?php
require_once 'src/algorithms/Atbah.class.php';

/**
 * This class contains the unit tests for block transposition algorithm.
 */
class AtbahTest extends PHPUnit_Framework_TestCase {
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
		$algorithm = new Atbah ();
		$encryptedText = $algorithm->decrypt ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE" );
		$this->assertEquals ( "JNEFNS WMXZ I OAFA LPIGN FN PI PAHNJYN", $encryptedText );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new Atbah ();
		$decryptedText = $algorithm->encrypt ( "JNEFNS WMXZ I OAFA LPIGN FN PI PAHNJYN" );
		$this->assertEquals ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE", $decryptedText );
	}
}

?>