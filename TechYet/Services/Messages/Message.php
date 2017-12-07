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
		private $_id;
		private $_status;
		private $_body;
		private $_from;
		private $_to;
		private $_date;
		private $_errorCode;
		private $_hasMedia;
		private $_segments;
		
		/**
		 * Constructs from the API data
		 * @param array[] $data
		 */
		public function __construct($data) {
			$this->_id = $data['id'];
			$this->_status = $data['status'];
			$this->_body = $data['message'];
			$this->_from = $data['from'];
			$this->_to = $data['to'];
			$this->_date = $data['date'];
			$this->_errorCode = $data['error_code'];
			$this->_hasMedia = boolval($data['has_media']);
			$this->_segments = $data['segments'];
		}
	}
