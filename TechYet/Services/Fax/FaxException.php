<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 2/3/18
	 * Time: 7:41 PM
	 */
	
	namespace TechYet\Services\Fax;
	
	
	class FaxException extends \Exception {
		const ERROR_READ = 1000;
		const ERROR_SEND = 1001;
		
		const FILES_NONE_ATTACHED = 2000;
	}
