<?php
require_once 'src/algorithms/Cesar.class.php';

/**
 * This class contains the unit tests for block transposition algorithm.
 */
class CesarTest extends PHPUnit_Framework_TestCase {
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
		// Rot3
		$algorithm = new Cesar ( 3 );
		$encryptedText = $algorithm->encrypt ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE" );
		$this->assertEquals ( "UHQGHC YRXV D PLGL SODFH GH OD OLEHUWH", $encryptedText );
		
		// Rot13
		$algorithm = new Cesar ( 13 );
		$encryptedText = $algorithm->encrypt ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE" );
		$this->assertEquals ( "ERAQRM IBHF N ZVQV CYNPR QR YN YVOREGR", $encryptedText );
		
		// Rot21
		$algorithm = new Cesar ( - 5 );
		$encryptedText = $algorithm->encrypt ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE" );
		$this->assertEquals ( "MZIYZU QJPN V HDYD KGVXZ YZ GV GDWZMOZ", $encryptedText );
		
		// Rot2
		$algorithm = new Cesar ( - 50 );
		$encryptedText = $algorithm->encrypt ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE" );
		$this->assertEquals ( "TGPFGB XQWU C OKFK RNCEG FG NC NKDGTVG", $encryptedText );
	}
	
	/**
	 * Test decryption.
	 */
	public function testDecrypt() {
		// Rot3
		$algorithm = new Cesar ( 3 );
		$decryptedText = $algorithm->decrypt ( "UHQGHC YRXV D PLGL SODFH GH OD OLEHUWH" );
		$this->assertEquals ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE", $decryptedText );
		
		// Rot13
		$algorithm = new Cesar ( 13 );
		$decryptedText = $algorithm->decrypt ( "ERAQRM IBHF N ZVQV CYNPR QR YN YVOREGR" );
		$this->assertEquals ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE", $decryptedText );
		
		// Rot21
		$algorithm = new Cesar ( - 5 );
		$decryptedText = $algorithm->decrypt ( "MZIYZU QJPN V HDYD KGVXZ YZ GV GDWZMOZ" );
		$this->assertEquals ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE", $decryptedText );
		
		// Rot2
		$algorithm = new Cesar ( - 50 );
		$decryptedText = $algorithm->decrypt ( "TGPFGB XQWU C OKFK RNCEG FG NC NKDGTVG" );
		$this->assertEquals ( "RENDEZ VOUS A MIDI PLACE DE LA LIBERTE", $decryptedText );
	}
}

?>