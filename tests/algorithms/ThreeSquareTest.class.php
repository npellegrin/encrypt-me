<?php
require_once 'src/algorithms/ThreeSquare.class.php';

/**
 * This class contains the unit tests for block transposition algorithm.
 */
class ThreeSquareTest extends PHPUnit_Framework_TestCase {
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
		// To hard to test, the result is always different
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new ThreeSquare ( "IQSMJ\nPAURG\nDZBKX\nTCNHF\nOYLVE", "AJIRX\nCOFBY\nSKEGL\nPTVMZ\nNHUQD", "FSXTU\nEOPYJRAKQV\nBCDIL\nMHNZG" );
		$decryptedText = $algorithm->decrypt ( "SYTHP ANYHO PP" );
		$this->assertEquals ( "CHOUCHOU", $decryptedText );
	}
}

?>