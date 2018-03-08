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
	
	/**
	 * Class Fax
	 * @package TechYet\Services\Fax
	 * @property string $id
	 * @property string $to
	 * @property string $from
	 * @property string $direction
	 * @property string $status
	 * @property string $quality
	 * @property int $num_pages
	 * @property array $files
	 * @property string $date
	 * @property string $price
	 */
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
		protected $price;
		
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
			$this->price = $data['price'];
		}
		
		/**
		 * @return string
		 * @throws FaxException
		 */
		public function retrieveFileUrl() {
			return $this->service->retrieveFileUrl($this);
		}
	}
