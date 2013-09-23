<?php
require_once 'src/algorithms/Polybe.class.php';

/**
 * This class contains the unit tests for block transposition algorithm.
 */
class PolybeTest extends PHPUnit_Framework_TestCase {
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
		$algorithm = new Polybe ();
		$encryptedText = $algorithm->encrypt ( "RENDEZ VOUS A MIDI" );
		$this->assertEquals ( "421533141555 51344543 11 32241424", $encryptedText );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new Polybe ();
		$decryptedText = $algorithm->decrypt ( "421533141555 51344543 11 32241424" );
		$this->assertEquals ( "RENDEZ VOUS A MJDJ", $decryptedText );
	}
}

?>