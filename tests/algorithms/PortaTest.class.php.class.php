<?php
require_once 'src/algorithms/Porta.class.php';

/**
 * This class contains the unit tests for Porta substitution algorithm.
 */
class PortaTest extends PHPUnit_Framework_TestCase {
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
		$algorithm = new Porta ( "SECRET" );
		
		// RENDEZ-VOUS A MIDI
		$encryptedText = $algorithm->encrypt ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE" );
		$this->assertEquals ( $encryptedText, "APBVPIEDIAYQZOUKWRTPPWWRPTNWGCV" );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new Porta ( "SECRET" );
		
		// RENDEZ-VOUS A MIDI
		$decryptedText = $algorithm->decrypt ( "APBVPIEDIAYQZOUKWRTPPWWRPTNWGCV" );
		$this->assertEquals ( $decryptedText, "RENDEZVOUSAMIDIPLACEDELALIBERTE" );
	}
}

?>