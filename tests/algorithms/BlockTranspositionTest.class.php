<?php
require_once 'src/algorithms/BlockTransposition.class.php';

/**
 * This class contains the unit tests for block transposition algorithm.
 */
class BlockTranspositionTest extends PHPUnit_Framework_TestCase {
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
		$algorithm = new BlockTransposition ( "PERMUTATION" );
		
		// RENDEZ VOUS A MIDI PLACE DE LA LIBERTE
		$encryptedText = $algorithm->encrypt ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE" );
		$this->assertEquals ( "VEUDA SRNZO EAIEI EDMDL CPRAE ILLET B", $encryptedText );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new BlockTransposition ( "PERMUTATION" );
		
		// RENDEZ VOUS A MIDI PLACE DE LA LIBERTE
		$decryptedText = $algorithm->decrypt ( "VEUDA SRNZO EAIEI EDMDL CPRAE ILLET B" );
		$this->assertEquals ( "RENDEZVOUSAMIDIPLACEDELALIBERTE", $decryptedText );
	}
}

?>