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
		protected $_id;
		protected $_status;
		protected $_body;
		protected $_from;
		protected $_to;
		protected $_date;
		protected $_errorCode;
		protected $_hasMedia;
		protected $_segments;
		
		/**
		 * Constructs from the API data
		 * @param array $data
		 */
		public function __construct(array $data) {
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
