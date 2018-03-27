<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 3/27/18
	 * Time: 7:06 PM
	 */
	
	namespace TechYet\Services\Calls;
	
	
	use TechYet\Core\ResultList;
	use TechYet\Rest\ClientException;
	use TechYet\Services\Service;
	
	class Calls extends Service {
		public function getIndividualItemType(): string {
			return Call::class;
		}
		
		/**
		 * @param array $options
		 * @return ResultList
		 * @throws CallException
		 */
		public function retrieve($options = []): ResultList {
			$phoneNumber = isset($options['phoneNumber']) ? $options['phoneNumber'] : null;
			$url = '%s/phones/%s/calls/';
			$techYet = $this->getTechYet();
			$client = $techYet->getClient();
			$url = sprintf($url, $techYet->getConfig()->getUrl(), $phoneNumber);
			
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
				throw new CallException('Could not list calls', 0, $e);
			}
			$details = json_decode($client->getReturnData(), true);
			if (!$details['success'])
				throw new CallException('Could not list calls', CallException::ERROR_READ);
			
			return new ResultList($this, $details, $options);
		}
		
		/**
		 * @param $id
		 * @param array $options
		 * @return Call
		 * @throws CallException
		 */
		public function retrieveCall($id, $options = []): Call {
			$url = '%s/phones/calls/%s';
			$techYet = $this->getTechYet();
			$client = $techYet->getClient();
			$url = sprintf($url, $techYet->getConfig()->getUrl(), $id);
			
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
				throw new CallException('Could not retrieve call', 0, $e);
			}
			$details = json_decode($client->getReturnData(), true);
			
			if (!$details['success'])
				throw new CallException('Could not retrieve call', CallException::ERROR_READ);
			
			return new Call($details['results'][0], $this);
		}
	}
