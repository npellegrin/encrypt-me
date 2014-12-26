<?php
require_once 'src/algorithms/Gronsfeld.class.php';

/**
 * This class contains the unit tests for the Gronsfeld substitution algorithm.
 */
class GronsfeldTest extends PHPUnit_Framework_TestCase {
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
		$algorithm = new Gronsfeld ( "63071" );
		
		// RENDEZ-VOUS
		$encryptedText = $algorithm->encrypt ( "RENDEZ VOUS PLACE DE LA LIBERTE A MIDI" );
		$this->assertEquals ( $encryptedText, "XHNKFFYOBTVOAJFJHLHMOEEYUKDMPEO" );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new Gronsfeld ( "63071" );
		
		// RENDEZ-VOUS
		$decryptedText = $algorithm->decrypt ( "XHNKFFYOBTVOAJFJHLHMOEEYUKDMPEO" );
		$this->assertEquals ( $decryptedText, "RENDEZVOUSPLACEDELALIBERTEAMIDI" );
	}
}

?>