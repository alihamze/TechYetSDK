<?php
	/**
	 * Created by PhpStorm.
	 * User: alihamze
	 * Date: 3/27/18
	 * Time: 7:09 PM
	 */
	
	namespace TechYet\Services\Calls;
	
	
	class CallException extends \Exception {
		const ERROR_READ = 1000;
		
		const FILES_NONE_ATTACHED = 2000;
	}
