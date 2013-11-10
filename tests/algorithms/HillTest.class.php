<?php
require_once 'src/algorithms/Hill.class.php';

/**
 * This class contains the unit tests for block transposition algorithm.
 */
class HillTest extends PHPUnit_Framework_TestCase {
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
		$algorithm = new Hill ( 3, 5, 1, 2 );
		$encryptedText = $algorithm->encrypt ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE" );
		$this->assertEquals ( "TZCTH CDXUE IYNOV MHLAK DLHLV BXJQD", substr ( $encryptedText, 0, 35 ) );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new Hill ( 3, 5, 1, 2 );
		$decryptedText = $algorithm->decrypt ( "TZCTH CDXUE IYNOV MHLAK DLHLV BXJQD" );
		$this->assertEquals ( "RENDEZVOUSAMIDIPLACEDELALIBERT", $decryptedText );
	}
}

?>