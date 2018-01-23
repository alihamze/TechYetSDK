<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 1/22/18
	 * Time: 6:50 PM
	 */
	
	namespace TechYet\Services\AvailablePhoneNumbers;
	
	
	use TechYet\Core\ListItem;
	
	class AvailablePhoneNumber extends ListItem {
		protected $phoneNumber;
		protected $locality;
		protected $region;
		protected $postalCode;
		protected $country;
		protected $capabilities;
		
		/**
		 * Constructs from the API data
		 * @param array $data
		 */
		public function __construct(array $data) {
			$this->phoneNumber = $data['number'];
			$this->locality = $data['locality'];
			$this->region = $data['region'];
			$this->postalCode = $data['postal_code'];
			$this->country = $data['country'];
			$this->capabilities = $data['capabilities'];
		}
	}
