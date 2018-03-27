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
	use TechYet\Services\AvailablePhoneNumbers\AvailablePhoneNumbers;
	use TechYet\Services\Calls\Calls;
	use TechYet\Services\Fax\Fax;
	use TechYet\Services\Fax\Faxes;
	use TechYet\Services\Messages\Message;
	use TechYet\Services\Messages\Messages;
	use TechYet\Services\PhoneNumbers\PhoneNumbers;
	use TechYet\Services\Service;
	use TechYet\Services\ServiceException;
	
	/**
	 * TechYet SDK Client
	 * @package TechYet
	 * @property Messages messages
	 * @property PhoneNumbers phoneNumbers
	 * @property AvailablePhoneNumbers availablePhoneNumbers
	 * @property Faxes faxes
	 * @property Calls calls
	 */
	class TechYet {
		/** @var Config $config The config */
		private $config;
		private $client;
		
		private $_messages;
		private $_phoneNumbers;
		private $_availablePhoneNumbers;
		private $_faxes;
		private $_calls;
		
		/**
		 * Initialize the TechYet SDK
		 * @param Config $config
		 */
		public function __construct(Config $config) {
			$this->config = $config;
		}
		
		/**
		 * @param null $id
		 * @return Messages|Message
		 * @throws Services\Messages\MessageException
		 */
		public function getMessages($id = null) {
			if (empty($this->_messages))
				$this->_messages = new Messages($this);
			
			if (!empty($id))
				return $this->_messages->retrieveMessage($id);
			
			return $this->_messages;
		}
		
		/**
		 * @param null $id
		 * @return Services\Calls\Call|Calls
		 * @throws Services\Calls\CallException
		 */
		public function getCalls($id = null) {
			if (empty($this->_calls))
				$this->_calls = new Calls($this);
			
			if (!empty($id))
				return $this->_calls->retrieveCall($id);
			
			return $this->_calls;
		}
		
		/**
		 * @return PhoneNumbers
		 */
		public function getPhoneNumbers() {
			if (empty($this->_phoneNumbers))
				$this->_phoneNumbers = new PhoneNumbers($this);
			
			return $this->_phoneNumbers;
		}
		
		/**
		 * @return AvailablePhoneNumbers
		 */
		public function getAvailablePhoneNumbers() {
			if (empty($this->_availablePhoneNumbers))
				$this->_availablePhoneNumbers = new AvailablePhoneNumbers($this);
			
			return $this->_availablePhoneNumbers;
		}
		
		/**
		 * @param null $id
		 * @return Faxes|Fax
		 * @throws Services\Fax\FaxException
		 */
		public function getFaxes($id = null) {
			if (empty($this->_faxes))
				$this->_faxes = new Faxes($this);
			
			if (!empty($id))
				return $this->_faxes->retrieveFax($id);
			
			return $this->_faxes;
		}
		
		/**
		 * @return Client
		 */
		public function getClient() {
			if (empty($this->client))
				$this->client = new Client();
			
			return $this->client;
		}
		
		/**
		 * @return Config
		 */
		public function getConfig() {
			return $this->config;
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
		
		/**
		 * @param $name
		 * @param $arguments
		 * @return mixed
		 * @throws ServiceException
		 */
		public function __call($name, $arguments) {
			$method = 'get' . ucfirst($name);
			if (method_exists($this, $method))
				return call_user_func_array([$this, $method], $arguments);
			throw new ServiceException('Unknown service ' . $name);
		}
	}
