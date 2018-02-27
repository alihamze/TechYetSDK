<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 12/7/17
	 * Time: 12:20 PM
	 */
	
	namespace TechYet\Core;
	
	
	use TechYet\Services\Service;
	
	abstract class ListItem {
		/**
		 * Constructs from the API data
		 * @param array $data
		 * @param Service $service
		 */
		abstract public function __construct(array $data, Service $service);
		
		/**
		 * @param $name
		 * @return mixed
		 * @throws CoreException
		 */
		public function __get($name) {
			if (property_exists($this, $name))
				return $this->{$name};
			throw new CoreException('Field not found');
		}
		
		/**
		 * @param $name
		 * @return bool
		 */
		public function __isset($name) {
			return property_exists($this, $name);
		}
	}
