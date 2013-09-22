<?php
require_once 'src/algorithms/ColumnTransposition.class.php';

/**
 * This class contains the unit tests for block transposition algorithm.
 */
class ColumnTranspositionTest extends PHPUnit_Framework_TestCase {
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
		$algorithm = new ColumnTransposition ( "PERMUTATION" );
		
		// RENDEZ VOUS A MIDI PLACE DE LA LIBERTE
		$encryptedText = $algorithm->encrypt ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE" );
		$this->assertEquals ( "VAREI AUEED IIAES DRMLN DLZLE OCTEPB", $encryptedText );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new ColumnTransposition ( "PERMUTATION" );
		
		// RENDEZ VOUS A MIDI PLACE DE LA LIBERTE
		$decryptedText = $algorithm->decrypt ( "VAREI AUEED IIAES DRMLN DLZLE OCTEPB" );
		$this->assertEquals ( "RENDEZVOUSAMIDIPLACEDELALIBERTE", $decryptedText );
	}
}

?>