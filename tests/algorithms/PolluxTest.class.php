<?php
require_once 'src/algorithms/Pollux.class.php';

/**
 * This class contains the unit tests for chase substitution algorithm.
 */
class PolluxTest extends PHPUnit_Framework_TestCase {
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
		$dot = array (
				0,
				3,
				7,
				8 
		);
		$dash = array (
				1,
				4,
				5 
		);
		$space = array (
				2,
				6,
				9 
		);
		$algorithm = new Pollux ( $dot, $dash, $space );
		
		// ATTAQUEZ
		$encryptedText = $algorithm->encrypt ( "ATTAQUEZ" );
		$i = 0;
		// A
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $dot ) );
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $dash ) );
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $space ) );
		// T
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $dash ) );
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $space ) );
		// T
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $dash ) );
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $space ) );
		// A
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $dot ) );
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $dash ) );
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $space ) );
		// Q
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $dash ) );
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $dash ) );
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $dot ) );
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $dash ) );
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $space ) );
		// U
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $dot ) );
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $dot ) );
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $dash ) );
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $space ) );
		// E
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $dot ) );
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $space ) );
		// Z
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $dash ) );
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $dash ) );
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $dot ) );
		$this->assertTrue ( in_array ( $encryptedText {$i ++}, $dot ) );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$dot = array (
				0,
				3,
				7,
				8 
		);
		$dash = array (
				1,
				4,
				5 
		);
		$space = array (
				2,
				6,
				9 
		);
		
		// ATTAQUEZ
		$algorithm = new Pollux ( $dot, $dash, $space );
		$decryptedText = $algorithm->decrypt ( "31649 52042 54819 37460 91187" );
		$this->assertEquals ( "ATTAQUEZ", $decryptedText );
	}
}

?>