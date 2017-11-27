<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 11/26/17
	 * Time: 9:32 PM
	 */
	
	namespace TechYet;
	
	
	class TechYet {
		/** The API Host */
		const API_BASE_ENDPOINT = 'https://techyet.com/api/';
		
		/** @var string $token The API token */
		private $token;
		
		/**
		 * Initialize the TechYet SDK
		 * @param $token
		 */
		public function __construct($token) {
			$this->token = $token;
		}
	}
