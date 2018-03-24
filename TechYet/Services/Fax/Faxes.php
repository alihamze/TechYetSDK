<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 2/3/18
	 * Time: 7:39 PM
	 */
	
	namespace TechYet\Services\Fax;
	
	
	use TechYet\Core\ResultList;
	use TechYet\Rest\ClientException;
	use TechYet\Services\Service;
	
	class Faxes extends Service {
		
		public function getIndividualItemType(): string {
			return Fax::class;
		}
		
		/**
		 * @param $to
		 * @param $from
		 * @param $fileUrl
		 * @return Fax
		 * @throws FaxException
		 */
		public function create($to, $from, $fileUrl) {
			$url = '%s/fax/';
			$techYet = $this->getTechYet();
			$client = $techYet->getClient();
			$url = sprintf($url, $techYet->getConfig()->getUrl());
			
			$data = [
				'api_token' => $techYet->getConfig()->getToken(),
				'to'        => $to,
				'from'      => $from,
				'url'       => $fileUrl,
			];
			
			$client->reset();
			$client->setHttpMethod($client::HTTP_METHOD_POST);
			$client->setUrl($url);
			$client->setParameters($data);
			
			try {
				$client->send();
			} catch (ClientException $e) {
				throw new FaxException('Could not send fax', 0, $e);
			}
			
			$details = json_decode($client->getReturnData(), true);
			if (!$details['success'])
				throw new FaxException('Could not send fax', FaxException::ERROR_SEND);
			
			return new Fax($details['results'][0], $this);
		}
		
		/**
		 * @param $id
		 * @param array $options
		 * @return Fax
		 * @throws FaxException
		 */
		public function retrieveFax($id, $options = []) {
			$url = '%s/fax/%s';
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
				throw new FaxException('Could not retrieve fax', 0, $e);
			}
			$details = json_decode($client->getReturnData(), true);
			if (!$details['success'])
				throw new FaxException('Could not retrieve fax', FaxException::ERROR_READ);
			
			return new Fax($details['results'][0], $this);
		}
		
		/**
		 * @param array $options
		 * @return ResultList
		 * @throws FaxException
		 */
		public function retrieve($options = []): ResultList {
			$url = '%s/fax/';
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
				throw new FaxException('Could not list faxes', 0, $e);
			}
			$details = json_decode($client->getReturnData(), true);
			if (!$details['success'])
				throw new FaxException('Could not list faxes', FaxException::ERROR_READ);
			
			return new ResultList($this, $details, $options);
		}
		
		/**
		 * @param Fax $fax
		 * @return string
		 * @throws FaxException
		 */
		public function retrieveFileUrl(Fax $fax) {
			if (empty($fax->files))
				throw new FaxException('This fax does not have any files', FaxException::FILES_NONE_ATTACHED);
			if (!empty($fax->files) && isset($fax->files[0]['url']))
				return $fax->files[0]['url'];
			
			$url = '%s/fax/%s/media/%s/';
			$techYet = $this->getTechYet();
			$client = $techYet->getClient();
			$url = sprintf($url, $techYet->getConfig()->getUrl(), $fax->id, $fax->files[0]['id']);
			
			$data = [
				'api_token' => $techYet->getConfig()->getToken(),
			];
			
			$client->reset();
			$client->setHttpMethod($client::HTTP_METHOD_GET);
			$client->setUrl($url);
			$client->setParameters($data);
			
			try {
				$client->send();
			} catch (ClientException $e) {
				throw new FaxException('Could not get fax file', 0, $e);
			}
			$details = json_decode($client->getReturnData(), true);
			if (!$details['success'])
				throw new FaxException('Could not get fax file', FaxException::ERROR_READ);
			
			return $details['url'];
		}
	}
