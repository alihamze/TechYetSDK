<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 12/7/17
	 * Time: 8:08 PM
	 */
	
	namespace TechYet\Services\PhoneNumbers;
	
	
	use TechYet\Core\ListItem;
	use TechYet\Services\Service;
	
	/**
	 * Class PhoneNumber
	 * @package TechYet\Services\PhoneNumbers
	 * @property string $id
	 * @property string $phoneNumber
	 * @property array $capabilities
	 * @property string $incoming_calls_method
	 */
	class PhoneNumber extends ListItem {
		protected $id;
		protected $phoneNumber;
		protected $capabilities;
		protected $incoming_calls_method;
		
		/**
		 * Constructs from the API data
		 * @param array $data
		 * @param Service $service
		 */
		public function __construct(array $data, Service $service) {
			$this->id = $data['id'];
			$this->phoneNumber = $data['phone_number'];
			$this->capabilities = $data['capabilities'];
			$this->incoming_calls_method = $data['incoming_calls'];
			
			foreach ($this->capabilities as $key => $value) {
				$this->capabilities[$key] = boolval($value);
			}
		}
	}
