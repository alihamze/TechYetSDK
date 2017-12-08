<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 12/7/17
	 * Time: 12:20 PM
	 */
	
	namespace TechYet\Services\Messages;
	
	
	use TechYet\Core\ListItem;
	
	class Message extends ListItem {
		protected $id;
		protected $status;
		protected $body;
		protected $from;
		protected $to;
		protected $date;
		protected $errorCode;
		protected $hasMedia;
		protected $segments;
		
		/**
		 * Constructs from the API data
		 * @param array $data
		 */
		public function __construct(array $data) {
			$this->id = $data['id'];
			$this->status = $data['status'];
			$this->body = $data['message'];
			$this->from = $data['from'];
			$this->to = $data['to'];
			$this->date = $data['date'];
			$this->errorCode = $data['error_code'];
			$this->hasMedia = boolval($data['has_media']);
			$this->segments = $data['segments'];
		}
	}
