<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 12/7/17
	 * Time: 12:20 PM
	 */
	
	namespace TechYet\Services\Messages;
	
	
	use TechYet\Core\ListItem;
	use TechYet\Services\Service;
	
	/**
	 * Class Message
	 * @package TechYet\Services\Messages
	 * @property string $id
	 * @property string $status
	 * @property string $body
	 * @property string $from
	 * @property string $to
	 * @property string $date
	 * @property string $direction
	 * @property string|null $errorCode
	 * @property bool $hasMedia
	 * @property int $segments
	 */
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
		protected $direction;
		
		/**
		 * Constructs from the API data
		 * @param array $data
		 * @param Service $service
		 */
		public function __construct(array $data, Service $service) {
			$this->id = $data['id'];
			$this->status = $data['status'];
			$this->body = $data['message'];
			$this->from = $data['from'];
			$this->to = $data['to'];
			$this->date = $data['date'];
			$this->errorCode = $data['error_code'];
			$this->hasMedia = boolval($data['has_media']);
			$this->segments = $data['segments'];
			$this->direction = $data['direction'];
		}
	}
