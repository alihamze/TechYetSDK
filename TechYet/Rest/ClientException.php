<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 11/26/17
	 * Time: 9:36 PM
	 */
	
	namespace TechYet\Rest;
	
	
	class ClientException extends \Exception {
		const RATE_LIMIT_REACHED = 1000;
	}
