<?php
require_once 'src/algorithms/UbchiTransposition.class.php';

/**
 * This class contains the unit tests for block transposition algorithm.
 */
class UbchiTranspositionTest extends PHPUnit_Framework_TestCase {
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
		$algorithm = new UbchiTransposition ( "PERMUTATION", 4 );
		
		// RENDEZ VOUS A MIDI PLACE DE LA LIBERTE
		$encryptedText = $algorithm->encrypt ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE" );
		$this->assertEquals ( "UMEAA L", substr ( $encryptedText, 0, 7 ) );
		$this->assertEquals ( "ENB ESOIL ", substr ( $encryptedText, 8, 10 ) );
		$this->assertEquals ( "DD", substr ( $encryptedText, 19, 2 ) );
		$this->assertEquals ( "V IZ", substr ( $encryptedText, 22, 4 ) );
		$this->assertEquals ( "RE EARTE LPIDC", substr ( $encryptedText, 27 ) );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new UbchiTransposition ( "PERMUTATION", 4 );
		
		// RENDEZ VOUS A MIDI PLACE DE LA LIBERTE
		$decryptedText = $algorithm->decrypt ( "UMEAA LXENB ESOIL BDDGV IZLRE EARTE LPIDC" );
		$this->assertEquals ( "RENDEZVOUSAMIDIPLACEDELALIBERTE", $decryptedText );
	}
}

?>