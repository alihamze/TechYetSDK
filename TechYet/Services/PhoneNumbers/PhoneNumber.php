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
	
	class PhoneNumber extends ListItem {
		protected $id;
		protected $phoneNumber;
		protected $capabilities;
		
		/**
		 * Constructs from the API data
		 * @param array $data
		 * @param Service $service
		 */
		public function __construct(array $data, Service $service) {
			$this->id = $data['id'];
			$this->phoneNumber = $data['phone_number'];
			$this->capabilities = $data['capabilities'];
			
			foreach ($this->capabilities as $key => $value) {
				$this->capabilities[$key] = boolval($value);
			}
		}
	}
