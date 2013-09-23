<?php
require_once 'src/algorithms/Atbash.class.php';

/**
 * This class contains the unit tests for block transposition algorithm.
 */
class AtbashTest extends PHPUnit_Framework_TestCase {
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
		$algorithm = new Atbash ();
		$encryptedText = $algorithm->encrypt ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE" );
		$this->assertEquals ( "IVMWVA ELFH Z NRWR KOZXV WV OZ ORYVIGV", $encryptedText );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new Atbash ();
		$decryptedText = $algorithm->encrypt ( "IVMWVA ELFH Z NRWR KOZXV WV OZ ORYVIGV" );
		$this->assertEquals ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE", $decryptedText );
	}
}

?>