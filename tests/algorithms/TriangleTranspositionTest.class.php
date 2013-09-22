<?php
require_once 'src/algorithms/TriangleTransposition.class.php';

/**
 * This class contains the unit tests for block transposition algorithm.
 */
class TriangleTranspositionTest extends PHPUnit_Framework_TestCase {
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
		$algorithm = new TriangleTransposition ( "COMPLIQUE" );
		
		// RENDEZ VOUS A MIDI PLACE DE LA LIBERTE
		$encryptedText = $algorithm->encrypt ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE" );
		$this->assertEquals ( "RZDIN UC", substr($encryptedText, 0, 8) );
		$this->assertEquals ( "DM A", substr($encryptedText, 9, 4) );
		$this->assertEquals ( "VLE EPTIB ESE", substr($encryptedText, 14, 13) );
		$this->assertEquals ( "A LD", substr($encryptedText, 28, 4) );
		$this->assertEquals ( "EO A", substr($encryptedText, 33, 4) );
		$this->assertEquals ( "REI L", substr($encryptedText, 38, 5) );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new TriangleTransposition ( "COMPLIQUE" );
		
		// RENDEZ VOUS A MIDI PLACE DE LA LIBERTE
		$decryptedText = $algorithm->decrypt ( "RZDIN UCBDM AAVLE EPTIB ESEMA LDLEO AFREI L" );
		$this->assertEquals ( "RENDEZVOUSAMIDIPLACEDELALIBERTE", substr ( $decryptedText, 0, 31 ) );
	}
}

?>