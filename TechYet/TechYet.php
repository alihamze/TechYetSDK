<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 11/26/17
	 * Time: 9:32 PM
	 */
	
	namespace TechYet;
	
	
	use TechYet\Core\Config;
	
	class TechYet {
		/** @var Config $config The config */
		private $config;
		
		/**
		 * Initialize the TechYet SDK
		 * @param Config $config
		 */
		public function __construct(Config $config) {
			$this->config = $config;
		}
	}
