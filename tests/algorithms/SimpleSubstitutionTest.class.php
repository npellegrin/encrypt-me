<?php
require_once 'src/algorithms/SimpleSubstitution.class.php';

/**
 * This class contains the unit tests for block transposition algorithm.
 */
class SimpleSubstitutionTest extends PHPUnit_Framework_TestCase {
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
		$algorithm = new SimpleSubstitution ( "LIBERTE" );
		
		// RENDEZ VOUS A MIDI PLACE DE LA LIBERTE
		$encryptedText = $algorithm->encrypt ( "RENDEZ VOUS A MIDI" );
		$this->assertEquals ( "PFJBFX ZSQT E NKBK", $encryptedText );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new SimpleSubstitution ( "LIBERTE" );
		
		// RENDEZ VOUS A MIDI PLACE DE LA LIBERTE
		$decryptedText = $algorithm->decrypt ( "PFJBFX ZSQT E NKBK" );
		$this->assertEquals ( "RENDEZ VOUS A MIDI", $decryptedText );
	}
}

?>