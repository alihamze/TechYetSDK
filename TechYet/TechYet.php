<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 11/26/17
	 * Time: 9:32 PM
	 */
	
	namespace TechYet;
	
	
	use TechYet\Core\Config;
	use TechYet\Rest\Client;
	use TechYet\Services\Messages\Messages;
	use TechYet\Services\Service;
	use TechYet\Services\ServiceException;
	
	/**
	 * TechYet SDK Client
	 * @package TechYet
	 * @property Messages messages
	 */
	class TechYet {
		/** @var Config $config The config */
		private $config;
		private $client;
		
		private $_messages;
		
		/**
		 * Initialize the TechYet SDK
		 * @param Config $config
		 */
		public function __construct(Config $config) {
			$this->config = $config;
		}
		
		public function getMessages() {
			if (empty($this->_messages))
				$this->_messages = new Messages($this);
			
			return $this->_messages;
		}
		
		public function getClient() {
			if (empty($this->client))
				$this->client = new Client();
			
			return $this->client;
		}
		
		/**
		 * Returns service helper
		 * @param $name
		 * @return Service
		 * @throws ServiceException
		 */
		public function __get($name) {
			$method = 'get' . ucfirst($name);
			if (method_exists($this, $method))
				return $this->$method();
			throw new ServiceException('Unknown service ' . $name);
		}
	}
