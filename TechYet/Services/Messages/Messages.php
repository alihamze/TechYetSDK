<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 12/7/17
	 * Time: 11:16 AM
	 */
	
	namespace TechYet\Services\Messages;
	
	
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
			
			$details = json_decode($client->getReturnData());
			return new Message($details);
		}
	}
