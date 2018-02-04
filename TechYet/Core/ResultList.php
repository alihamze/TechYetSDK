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
		private $_results = [];
		private $_options;
		
		/**
		 * ResultList constructor.
		 * @param Service $service
		 * @param array $results
		 * @param array $options
		 * @throws CoreException
		 */
		public function __construct(Service $service, array $results, array $options = []) {
			$this->_service = $service;
			$this->_options = $options;
			
			$this->_success = boolval($results['success']);
			$this->_currentPage = $results['current_page'];
			$this->_lastPage = $results['last_page'];
			$this->_total = $results['total'];
			$this->_perPage = $results['per_page'];
			
			$class = $service->getIndividualItemType();
			if (!is_subclass_of($class, ListItem::class, true))
				throw new CoreException('Invalid individual item type');
			
			foreach ($results['results'] as $result) {
				$this->_results[] = new $class($result, $service);
			}
		}
		
		public function read() {
			return $this->_results;
		}
		
		public function hasNextPage(): bool {
			return $this->_currentPage < $this->_lastPage;
		}
		
		public function nextPage(): ResultList {
			return $this->_service->retrieve(array_merge($this->_options, ['page' => $this->_currentPage + 1]));
		}
	}
