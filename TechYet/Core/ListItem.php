<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 12/7/17
	 * Time: 12:20 PM
	 */
	
	namespace TechYet\Core;
	
	
	abstract class ListItem {
		/**
		 * Constructs from the API data
		 * @param array $data
		 */
		abstract public function __construct(array $data);
		
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
	}
