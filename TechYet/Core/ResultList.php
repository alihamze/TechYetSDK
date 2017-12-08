<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 12/7/17
	 * Time: 12:42 PM
	 */
	
	namespace TechYet\Core;
	
	
	use TechYet\Services\Service;
	
	class ResultList {
		private $_service;
		
		private $_success;
		private $_currentPage;
		private $_lastPage;
		private $_total;
		private $_perPage;
		private $_results;
		
		/**
		 * ResultList constructor.
		 * @param Service $service
		 * @param array $results
		 * @throws CoreException
		 */
		public function __construct(Service $service, array $results) {
			$this->_service = $service;
			
			$this->_success = boolval($results['success']);
			$this->_currentPage = $results['current_page'];
			$this->_lastPage = $results['last_page'];
			$this->_total = $results['total'];
			$this->_perPage = $results['per_page'];
			
			$class = $service->getIndividualItemType();
			if (!is_subclass_of($class, ListItem::class, true))
				throw new CoreException('Invalid individual item type');
			
			foreach ($results['results'] as $result) {
				$this->_results[] = new $class($result);
			}
		}
	}
