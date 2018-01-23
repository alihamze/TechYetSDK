<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 12/7/17
	 * Time: 12:03 PM
	 */
	
	namespace TechYet\Services\PhoneNumbers;
	
	
	use TechYet\Core\ResultList;
	use TechYet\Rest\ClientException;
	use TechYet\Services\Service;
	
	class PhoneNumbers extends Service {
		/**
		 * Retrieves phone numbers
		 * @param $options
		 * @return ResultList
		 * @throws PhoneNumberException
		 */
		public function retrieve($options = []): ResultList {
			$url = '%s/phones/numbers/';
			$techYet = $this->getTechYet();
			$client = $techYet->getClient();
			$url = sprintf($url, $techYet->getConfig()->getUrl());
			
			$data = array_merge($options, [
				'api_token' => $techYet->getConfig()->getToken(),
			]);
			
			$client->reset();
			$client->setHttpMethod($client::HTTP_METHOD_GET);
			$client->setUrl($url);
			$client->setParameters($data);
			
			try {
				$client->send();
			} catch (ClientException $e) {
				throw new PhoneNumberException('Could not list phone numbers', 0, $e);
			}
			$details = json_decode($client->getReturnData(), true);
			if (!$details['success'])
				throw new PhoneNumberException('Could not list phone numbers', PhoneNumberException::ERROR_READ);
			
			return new ResultList($this, $details, $options);
		}
		
		/**
		 * @param $options
		 * @return PhoneNumber
		 * @throws PhoneNumberException
		 */
		public function create($options): PhoneNumber {
			$url = '%s/phones/numbers/';
			$techYet = $this->getTechYet();
			$client = $techYet->getClient();
			$url = sprintf($url, $techYet->getConfig()->getUrl());
			
			$data = array_merge($options, [
				'api_token' => $techYet->getConfig()->getToken(),
			]);
			
			$client->reset();
			$client->setHttpMethod($client::HTTP_METHOD_POST);
			$client->setUrl($url);
			$client->setParameters($data);
			
			try {
				$client->send();
			} catch (ClientException $e) {
				throw new PhoneNumberException('Could not purchase phone number', 0, $e);
			}
			$details = json_decode($client->getReturnData(), true);
			
			return new PhoneNumber($details);
		}
		
		public function getIndividualItemType(): string {
			return PhoneNumber::class;
		}
	}
