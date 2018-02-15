<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 2/3/18
	 * Time: 7:39 PM
	 */
	
	namespace TechYet\Services\Fax;
	
	
	use TechYet\Core\ListItem;
	use TechYet\Services\Service;
	
	class Fax extends ListItem {
		/** @var Faxes $service */
		private $service;
		protected $id;
		protected $to;
		protected $from;
		protected $direction;
		protected $status;
		protected $quality;
		protected $num_pages;
		protected $files;
		protected $date;
		
		/**
		 * Constructs from the API data
		 * @param array $data
		 * @param Service $service
		 */
		public function __construct(array $data, Service $service) {
			$this->service = $service;
			$this->id = $data['id'];
			$this->to = $data['to'];
			$this->from = $data['from'];
			$this->direction = $data['direction'];
			$this->status = $data['status'];
			$this->quality = $data['quality'];
			$this->num_pages = $data['num_pages'];
			$this->files = $data['files'];
			$this->date = $data['date'];
		}
		
		/**
		 * @return string
		 * @throws FaxException
		 */
		public function retrieveFileUrl() {
			return $this->service->retrieveFileUrl($this);
		}
	}
