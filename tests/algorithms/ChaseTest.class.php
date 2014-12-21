<?php
require_once 'src/algorithms/Chase.class.php';

/**
 * This class contains the unit tests for chase substitution algorithm.
 */
class ChaseTest extends PHPUnit_Framework_TestCase {
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
		$algorithm = new Chase ( "DOG*&BSMJ_UPAELFYIQRHVKWTZN-XC" );
		
		// ATTAQUEZ
		$encryptedText = $algorithm->encrypt ( "ATTAQUEZ" );
		$this->assertEquals ( substr ( "GUX-LPAUW", 1 ), substr ( $encryptedText, 1 ) );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$algorithm = new Chase ( "DOG*&BSMJ_UPAELFYIQRHVKWTZN-XC" );
		
		// ATTAQUEZ
		$decryptedText = $algorithm->decrypt ( "GUX-LPAUW" );
		$this->assertEquals ( "ATTAQUEZ", $decryptedText );
	}
}

?>