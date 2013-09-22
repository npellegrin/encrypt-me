<?php
require_once 'src/algorithms/FleissnerTransposition.class.php';

/**
 * This class contains the unit tests for block transposition algorithm.
 */
class FleissnerTranspositionTest extends PHPUnit_Framework_TestCase {
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
		$algorithm = new FleissnerTransposition ();
		
		// RENDEZ VOUS A MIDI PLACE DE LA LIBERTE
		$encryptedText = $algorithm->encrypt ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE" );
		$this->assertEquals ( "ERCERN ETSEDA ", substr ( $encryptedText, 0, 14 ) );
		$this->assertEquals ( "DEME", substr ( $encryptedText, 15, 4 ) );
		$this->assertEquals ( " IZ", substr ( $encryptedText, 20, 3 ) );
		$this->assertEquals ( "LVD ", substr ( $encryptedText, 24, 4 ) );
		$this->assertEquals ( "AI", substr ( $encryptedText, 29, 2 ) );
		$this->assertEquals ( "PO LLIUBA", substr ( $encryptedText, 32 ) );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new FleissnerTransposition ();
		
		// RENDEZ VOUS A MIDI PLACE DE LA LIBERTE
		$decryptedText = $algorithm->decrypt ( "ERCERN ETSEDA ZDEMEQ IZWLVD JAIPPO LLIUBA" );
		$this->assertEquals ( "RENDEZVOUSAMIDIPLACEDELALIBERTE", substr ( $decryptedText, 0, 31 ) );
	}
}

?>