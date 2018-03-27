<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 3/27/18
	 * Time: 7:08 PM
	 */
	
	namespace TechYet\Services\Calls;
	
	
	use TechYet\Core\ListItem;
	use TechYet\Services\Service;
	
	class Call extends ListItem {
		protected $id;
		protected $status;
		protected $parentId;
		protected $from;
		protected $to;
		protected $duration;
		protected $startTime;
		protected $endTime;
		protected $direction;
		protected $files;
		protected $price;
		
		public function __construct(array $data, Service $service) {
			$this->id = $data['id'];
			$this->status = $data['status'];
			$this->parentId = $data['parent_id'];
			$this->from = $data['from'];
			$this->to = $data['to'];
			$this->duration = $data['duration'];
			$this->startTime = $data['start_time'];
			$this->endTime = $data['end_time'];
			$this->direction = $data['direction'];
			$this->price = $data['price'];
			$this->files = $data['files'];
		}
	}
