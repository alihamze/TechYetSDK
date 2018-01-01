<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 12/7/17
	 * Time: 11:12 AM
	 */
	
	namespace TechYet\Services;
	
	
	use TechYet\Core\ResultList;
	use TechYet\TechYet;
	
	abstract class Service {
		/**
		 * @var TechYet
		 */
		private $_techYet;
		
		/**
		 * Initializes service
		 * @param TechYet $techYet
		 */
		public function __construct(TechYet $techYet) {
			$this->_techYet = $techYet;
		}
		
		/**
		 * @return TechYet
		 */
		public function getTechYet() {
			return $this->_techYet;
		}
		
		abstract public function getIndividualItemType(): string;
		abstract public function retrieve($options = []): ResultList;
	}
