<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 12/7/17
	 * Time: 11:16 AM
	 */
	
	namespace TechYet\Services\Messages;
	
	
	use TechYet\Core\ResultList;
	use TechYet\Rest\ClientException;
	use TechYet\Services\Service;
	
	class Messages extends Service {
		/**
		 * Creates a new message
		 * @param $to
		 * @param $from
		 * @param $options
		 * @return Message
		 * @throws MessageException
		 */
		public function create($to, $from, $options) {
			if (!isset($options['body']))
				throw new MessageException('Message body is required');
			
			$techYet = $this->getTechYet();
			$client = $techYet->getClient();
			$url = '%s/phones/%s/texts';
			$url = sprintf($url, $techYet->getConfig()->getUrl(), urlencode($from));
			
			$client->reset();
			$client->setHttpMethod($client::HTTP_METHOD_POST);
			$client->setUrl($url);
			$client->setParameters([
									   'api_token' => $techYet->getConfig()->getToken(),
									   'body'      => $options['body'],
									   'to'        => $to,
								   ]);
			try {
				$client->send();
			} catch (ClientException $e) {
				throw new MessageException('Could not send message', 0, $e);
			}
			
			$details = json_decode($client->getReturnData(), true);
			
			return new Message($details);
		}
		
		/**
		 * Retrieves messages
		 * @param $options
		 * @return ResultList
		 * @throws MessageException
		 */
		public function retrieve($options = []): ResultList {
			$phoneNumber = isset($options['phoneNumber']) ? $options['phoneNumber'] : null;
			$url = '%s/phones/%s/texts/';
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
				throw new MessageException('Could not list messages', 0, $e);
			}
			$details = json_decode($client->getReturnData(), true);
			if (!$details['success'])
				throw new MessageException('Could not list messages', MessageException::ERROR_READ);
			
			return new ResultList($this, $details, $options);
		}
		
		/**
		 * @param $id
		 * @param array $options
		 * @return Message
		 * @throws MessageException
		 */
		public function retrieveMessage($id, $options = []): Message {
			$url = '%s/phones/texts/%s';
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
				throw new MessageException('Could not retrieve message', 0, $e);
			}
			$details = json_decode($client->getReturnData(), true);
			
			if (!$details['success'])
				throw new MessageException('Could not retrieve message', MessageException::ERROR_READ);
			
			return new Message($details['results'][0], $this);
		}
		
		public function getIndividualItemType(): string {
			return Message::class;
		}
	}
