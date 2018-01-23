<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 1/22/18
	 * Time: 6:50 PM
	 */
	
	namespace TechYet\Services\AvailablePhoneNumbers;
	
	
	use TechYet\Core\ResultList;
	use TechYet\Rest\ClientException;
	use TechYet\Services\Service;
	
	class AvailablePhoneNumbers extends Service {
		
		public function getIndividualItemType(): string {
			return AvailablePhoneNumber::class;
		}
		
		/**
		 * @param array $options
		 * @return ResultList
		 * @throws AvailablePhoneNumbersException
		 */
		public function retrieve($options = []): ResultList {
			$url = '%s/phones/numbers/available/';
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
				throw new AvailablePhoneNumbersException('Could not list phone numbers', 0, $e);
			}
			$details = json_decode($client->getReturnData(), true);
			if (!$details['success'])
				throw new AvailablePhoneNumbersException('Could not list phone numbers', AvailablePhoneNumbersException::ERROR_READ);
			
			return new ResultList($this, $details, $options);
		}
	}
