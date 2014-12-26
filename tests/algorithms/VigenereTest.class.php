<?php
require_once 'src/algorithms/Vigenere.class.php';

/**
 * This class contains the unit tests for Vigenere substitution algorithm.
 */
class VigenereTest extends PHPUnit_Framework_TestCase {
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
		$algorithm = new Vigenere ( "SIMPLE" );
		
		// RENDEZ-VOUS
		$encryptedText = $algorithm->encrypt ( "RENDEZ VOUS" );
		$this->assertEquals ( $encryptedText, "JMZSPDNWGH" );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new Vigenere ( "SIMPLE" );
		
		// RENDEZ-VOUS
		$decryptedText = $algorithm->decrypt ( "JMZSPDNWGH" );
		$this->assertEquals ( $decryptedText, "RENDEZVOUS" );
	}
}

?>