<?php
require_once 'src/algorithms/Playfair.class.php';

/**
 * This class contains the unit tests for block transposition algorithm.
 */
class PlayfairTest extends PHPUnit_Framework_TestCase {
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
		$algorithm = new Playfair ( "BYDGZ\nJSFUP\nLARKX\nCOIVE\nQNMHT" );
		$encryptedText = $algorithm->encrypt ( "J ESSAYE" );
		$this->assertEquals ( "PC", substr ( $encryptedText, 0, 2 ) );
		$this->assertEquals ( "A OZO", substr ( $encryptedText, 4 ) );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new Playfair ( "BYDGZ\nJSFUP\nLARKX\nCOIVE\nQNMHT" );
		$decryptedText = $algorithm->decrypt ( "PCFJA OZO" );
		$this->assertEquals ( "JESPSAYE", $decryptedText );
	}
}

?>