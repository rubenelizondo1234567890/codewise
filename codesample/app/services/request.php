<?php
namespace services;

use configs\config;

/**
 * Basic Config class
 */
class request extends config
{
    /**
     * DB Connection String
     *
     * @var Array
     * @access private
     */
    protected $_httpRequest	=	[];

   
    /**
     * Constructor
     * Loads configuration
     */    
    public function __construct()
    {
    	parent::__construct();
		$this->_httpRequest['paramsInfo']	=	$this->_params;
		$this->setRequestGetInfo();
		$this->setRequestPostInfo();
		$this->setRequestCookieInfo();
		$this->setRequestFilesInfo();
		$this->setRequestSessionInfo();
		$this->setRequestServerInfo();
    }

    public function getHttpRequest() {
    	return $this->_httpRequest;
    }

    private function setRequestGetInfo() {
    	if (isset($_GET)) {
    		$this->_httpRequest['getInfo']	=	$_GET;
    	}
    }

    private function setRequestPostInfo() {
    	if (isset($_POST)) {
    		$this->_httpRequest['postInfo']	=	$_POST;
    	}
    }

    private function setRequestCookieInfo() {
    	if (isset($_COOKIE)) {
    		$this->_httpRequest['cookieInfo']	=	$_COOKIE;
    	}
    }

    private function setRequestFilesInfo() {
    	if (isset($_FILES)) {
    		$this->_httpRequest['filesInfo']	=	$_FILES;
    	}
    }

    private function setRequestSessionInfo() {
    	if (isset($_SESSION)) {
    		$this->_httpRequest['sessionInfo']	=	$_SESSION;
    	}
    }

    private function setRequestServerInfo() {
    	$serverInfo	= [
    		'PHP_SELF',
    		'argv',
    		'argc',
    		'GATEWAY_INTERFACE',
    		'SERVER_ADDR',
    		'SERVER_NAME',
    		'SERVER_SOFTWARE',
    		'SERVER_PROTOCOL',
    		'REQUEST_METHOD',
    		'REQUEST_TIME',
    		'REQUEST_TIME_FLOAT',
    		'QUERY_STRING',
    		'DOCUMENT_ROOT',
    		'HTTP_ACCEPT',
    		'HTTP_ACCEPT_CHARSET',
    		'HTTP_ACCEPT_ENCODING',
    		'HTTP_ACCEPT_LANGUAGE',
    		'HTTP_CONNECTION',
    		'HTTP_HOST',
    		'HTTP_REFERER',
    		'HTTP_USER_AGENT',
    		'HTTPS',
    		'REMOTE_ADDR',
    		'REMOTE_HOST',
    		'REMOTE_PORT',
    		'REMOTE_USER',
    		'REDIRECT_REMOTE_USER',
    		'SCRIPT_FILENAME',
    		'SERVER_ADMIN',
    		'SERVER_PORT',
    		'SERVER_SIGNATURE',
    		'PATH_TRANSLATED',
    		'SCRIPT_NAME',
    		'REQUEST_URI',
    		'PHP_AUTH_DIGEST',
    		'PHP_AUTH_USER',
    		'PHP_AUTH_PW',
    		'AUTH_TYPE',
    		'PATH_INFO',
    		'ORIG_PATH_INFO'
    	];
    	
    	foreach ($serverInfo as $arg) {
    		if (isset($_SERVER[$arg])) {
    			$this->_httpRequest['serverInfo'][$arg]	=	$_SERVER[$arg];
    		}
    		else {
    			$this->_httpRequest['serverInfo'][$arg]	=	'';
    		}
    	}
    }

    public function setControllerName(string $controllerName) {
    	$this->_httpRequest['controllerName']	=	$controllerName;
    }

    public function getControllerName() {
    	return $this->_httpRequest['controllerName'];
    }

    public function setActionName(string $actionName) {
    	$this->_httpRequest['actionName']	=	$actionName;
    }

    public function getActionName() {
    	return $this->_httpRequest['actionName'];
    }
}
