<?php
require_once 'src/algorithms/SawtoothTransposition.class.php';

/**
 * This class contains the unit tests for block transposition algorithm.
 */
class SawtoothTranspositionTest extends PHPUnit_Framework_TestCase {
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
		$algorithm = new SawtoothTransposition ( 2 );
		
		// RENDEZ VOUS A MIDI PLACE DE LA LIBERTE
		$encryptedText = $algorithm->encrypt ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE" );
		$this->assertEquals ( "RNEVUAIILCDLLBRE\nEDZOSMDPAEEAIET", $encryptedText );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new SawtoothTransposition ( 2 );
		
		// RENDEZ VOUS A MIDI PLACE DE LA LIBERTE
		$decryptedText = $algorithm->decrypt ( "RNEVUAIILCDLLBRE\nEDZOSMDPAEEAIET" );
		$this->assertEquals ( "RENDEZVOUSAMIDIPLACEDELALIBERTE", $decryptedText );
	}
}

?>