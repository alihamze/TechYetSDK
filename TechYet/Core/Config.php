<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 12/7/17
	 * Time: 10:52 AM
	 */
	
	namespace TechYet\Core;
	
	
	/**
	 * Config options helper for TechYet SDK
	 *
	 * @package TechYet\Core
	 */
	class Config {
		/**
		 * @var string $token The API token
		 */
		private $token;
		/**
		 * @var string $url The API Base URL
		 */
		private $url;
		
		/**
		 * Fills the config data
		 * @param $token
		 * @param $url
		 * @return Config
		 */
		public function fill($token, $url) {
			$this->token = $token;
			$this->url = $url;
			
			return $this;
		}
		
		/**
		 * Creates a new Config and fills it
		 *
		 * @param $token
		 * @param string $url
		 * @return Config
		 */
		public static function create($token, $url = 'https://techyet.com/api/') {
			return (new Config())->fill($token, $url);
		}
		
		/**
		 * Returns the API Token
		 * @return string
		 */
		public function getToken(): string {
			return $this->token;
		}
		
		/**
		 * Returns the API Base URL
		 * @return string
		 */
		public function getUrl(): string {
			return $this->url;
		}
	}
