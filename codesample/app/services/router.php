<?php
namespace services;

use services\request;
use configs\constants;

/**
 * Main Router
 */
class router
{
	/*
	 * Request data
	 */
	protected $_request;
	
	function __construct()
	{
		$this->_request	=	new request();
	}

	/*
	 *
	 */
	public function run() {
		$httpUri = [];
		$this->mapToRoute($httpUri);

		$controllerName	=	$httpUri['controllerName'];
		$actionName		=	$httpUri['actionName'];

		$this->_request->setControllerName($controllerName);
		$this->_request->setActionName($actionName);

		$this->executeAction($this->instantiateController('controllers\\'.$controllerName.'Controller'), $actionName.'Action');

	}

	public function shutdown() {
		// Unset objects, etc. to free memory
		
	}
    
    private function instantiateController($class)
    {
        return new $class($this->_request);
    }
    
    private function executeAction($controller, $actionName)
    {
        return $controller->$actionName();
    }

	private function mapToRoute(array &$httpUri) {
		$httpRequestInfo	=	$this->_request->getHttpRequest();
		$httpUri			=	$httpRequestInfo['serverInfo']['REQUEST_URI'];
		$this->transformHttpUri($httpUri);

		return ;
	}

	private function transformHttpUri(string &$httpUri) {
		$httpUri	=	explode('/', $httpUri);
		foreach ($httpUri as $key => $value) {
			if($value == '') {unset($httpUri[$key]);} 
			if($value == constants::DEFAULTPAGE) {unset($httpUri[$key]);}
		}

		foreach ($httpUri as $value) {
			$newValues[]	=	$value;
		}

		$newValues[0] ? $httpUri['controllerName'] = $newValues[0] : constants::DEFAULTCONTROLLERNAME;

		if($newValues[1]) {
			list($a)				=	explode('?', $newValues[1]);
			$httpUri['actionName']	=	$a;
		} else {
			$httpUri['actionName']	=	constants::DEFAULTACTIONNAME;
		}
 

	}

}