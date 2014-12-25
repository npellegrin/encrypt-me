<?php
require_once 'src/algorithms/Delastelle.class.php';

/**
 * This class contains the unit tests for chase substitution algorithm.
 */
class DelastelleTest extends PHPUnit_Framework_TestCase {
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
		$key = array (
				array("B", "Y", "D", "G", "Z"),
				array("J", "S", "F", "U", "P"),
				array("L", "A", "R", "K", "X"),
				array("C", "O", "I", "V", "E"),
				array("Q", "N", "M", "H", "T")
		);
		$algorithm = new Delastelle ( $key, 5 );
		
		// RENDEZ-VOUS A MIDI
		$encryptedText = $algorithm->encrypt ( "RENDEZ-VOUS A MIDI" );
		$this->assertEquals ( $encryptedText, "KQINXGOPOOXCORR" );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		$key = array (
				array("B", "Y", "D", "G", "Z"),
				array("J", "S", "F", "U", "P"),
				array("L", "A", "R", "K", "X"),
				array("C", "O", "I", "V", "E"),
				array("Q", "N", "M", "H", "T")
		);
		$algorithm = new Delastelle ( $key, 5 );
		
		// RENDEZ-VOUS A MIDI
		$decryptedText = $algorithm->decrypt ( "KQINXGOPOOXCORR" );
		$this->assertEquals ( $decryptedText, "RENDEZVOUSAMIDI" );
	}
}

?>