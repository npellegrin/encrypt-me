<?php
require_once 'src/algorithms/Beaufort.class.php';

/**
 * This class contains the unit tests for the Beaufort substitution algorithm.
 */
class BeaufortTest extends PHPUnit_Framework_TestCase {
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
		$algorithm = new Beaufort ( "SIMPLE" );
		
		// RENDEZ-VOUS
		$encryptedText = $algorithm->encrypt ( "RENDEZ VOUS" );
		$this->assertEquals ( $encryptedText, "QNAHKWMDTS" );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new Beaufort ( "SIMPLE" );
		
		// RENDEZ-VOUS
		$decryptedText = $algorithm->decrypt ( "QNAHKWMDTS" );
		$this->assertEquals ( $decryptedText, "RENDEZVOUS" );
	}
}

?>