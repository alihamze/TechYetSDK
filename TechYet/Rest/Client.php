<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 11/26/17
	 * Time: 9:35 PM
	 */
	
	namespace TechYet\Rest;
	
	
	class Client {
		/**
		 * @var String $url
		 */
		private $url;
		/**
		 * @var String $http_method
		 */
		private $http_method;
		/**
		 * @var mixed[]
		 */
		private $parameters;
		
		/**
		 * @var String
		 */
		private $returnHeaders;
		/**
		 * @var String
		 */
		private $returnData;
		private $connection;
		
		public function __construct($url = null, $method = null, $parameters = null) {
			$this->connection = curl_init();
			
			$this->setUrl($url);
			$this->setHttpMethod($method);
			$this->setParameters($parameters);
		}
		
		public function send($expectedStatus = 200, $rawBody = false) {
			curl_setopt($this->connection, CURLOPT_URL, $this->url);
			curl_setopt($this->connection, CURLOPT_VERBOSE, 0);
			curl_setopt($this->connection, CURLOPT_CONNECTTIMEOUT, 15);
			curl_setopt($this->connection, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($this->connection, CURLOPT_HEADER, 1);
			
			if ($this->getHttpMethod() == 'POST') {
				curl_setopt($this->connection, CURLOPT_POST, true);
				if ($rawBody) {
					$body = '';
					foreach ($this->getParameters() as $key => $value) {
						if (!empty($body))
							$body .= '&';
						$body .= urlencode($key) . '=' . urlencode($value);
					}
					curl_setopt($this->connection, CURLOPT_POSTFIELDS, $body);
				} else {
					curl_setopt($this->connection, CURLOPT_POSTFIELDS, $this->getParameters());
				}
			} else {
				curl_setopt($this->connection, CURLOPT_POST, false);
			}
			
			$response = curl_exec($this->connection);
			$header_size = curl_getinfo($this->connection, CURLINFO_HEADER_SIZE);
			
			$this->returnHeaders = substr($response, 0, $header_size);
			$this->returnData = substr($response, $header_size);
			
			$http_status_code = curl_getinfo($this->connection, CURLINFO_HTTP_CODE);
			
			if ($http_status_code !== $expectedStatus) {
				throw new ClientException('Error sending (' . $this->getHttpMethod() . ') HTTP request to "' . $this->url . '". Received ' . $http_status_code);
			}
		}
		
		/**
		 * @return String
		 */
		public function getUrl() {
			return $this->url;
		}
		
		/**
		 * @param String $url
		 */
		public function setUrl($url) {
			$this->url = $url;
		}
		
		/**
		 * @return String
		 */
		public function getHttpMethod() {
			return $this->http_method;
		}
		
		/**
		 * @param String $http_method
		 */
		public function setHttpMethod($http_method) {
			$this->http_method = $http_method;
		}
		
		/**
		 * @return \mixed[]
		 */
		public function getParameters() {
			return $this->parameters;
		}
		
		/**
		 * @param \mixed[] $parameters
		 */
		public function setParameters($parameters) {
			$this->parameters = $parameters;
		}
		
		/**
		 * @return \String
		 */
		public function getReturnHeaders() {
			return $this->returnHeaders;
		}
		
		/**
		 * @return String
		 */
		public function getReturnData() {
			return $this->returnData;
		}
	}
