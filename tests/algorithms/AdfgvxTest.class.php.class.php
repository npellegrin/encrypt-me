<?php
require_once 'src/algorithms/Adfgvx.class.php';

/**
 * This class contains the unit tests for Adfgvx substitution algorithm.
 */
class AdfgvxTest extends PHPUnit_Framework_TestCase {
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
		$algorithm = new Adfgvx ( "NEBEL" );
		
		// RENDEZ-VOUS A MIDI
		$encryptedText = $algorithm->encrypt ( "RENDEZ-VOUS A MIDI" );
		$this->assertEquals ( $encryptedText, "VXXFD XDVGV FVDVA FDFXD AXFAX VXFFA" );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new Adfgvx ( "NEBEL" );
		
		// RENDEZ-VOUS A MIDI
		$decryptedText = $algorithm->decrypt ( "VXXFDXDVGVFVDVAFDFXDAXFAXVXFFA" );
		$this->assertEquals ( $decryptedText, "RENDEZVOUSAMIDI" );
	}
}

?>