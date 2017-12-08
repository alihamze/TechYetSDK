<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 12/7/17
	 * Time: 7:46 PM
	 */
	
	namespace Unit;
	
	
	use PHPUnit\Framework\TestCase;
	use TechYet\Core\Config;
	use TechYet\Rest\ClientException;
	use TechYet\Services\Messages\MessageException;
	use TechYet\TechYet;
	
	class MessagesReadTest extends TestCase {
		public function testCanReadMessages() {
			$techYet = new TechYet(Config::create(''));
			try {
				$techYet->messages->retrieve();
			} catch (MessageException $e) {
				$this->assertNotEmpty($e->getPrevious());
				$this->assertTrue(($e->getPrevious() instanceof ClientException));
				$this->assertNotFalse(strpos($e->getPrevious()->getMessage(), 'Received 403'));
			}
		}
	}
