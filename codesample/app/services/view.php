<?php
namespace services;

use configs\constants;

/**
 * Basic Config class
 */
class view
{

    /**
     * View Directory
     *
     * @var String
     * @access private
     */
    private $_viewDir;

    /**
     * Http Request Info
     *
     * @var Array
     * @access private
     */
    private $_httpRequestInfo;

    /**
     * Base Html View
     *
     * @var Array
     * @access private
     */
    private $_baseHtml =	[]; 

    /**
     * Current View
     *
     * @var Array
     * @access private
     */
    private $_currentView	=	[];

   
    /**
     * Constructor
     * Loads configuration
     */    
    public function __construct(request $request)
    {
    	$this->_httpRequestInfo	=	$request->getHttpRequest();
    	$this->_viewDir			=	$this->getViewDir($this->_httpRequestInfo);
    	$this->parseBaseHtmlFile($this->getBaseFileName($this->_httpRequestInfo));
    }

    private function getViewDir(array $httpRequestInfo) {
    	return $httpRequestInfo['serverInfo']['DOCUMENT_ROOT'].(constants::DS).(constants::DEFAULTAPPDIR).(constants::DS).(constants::DEFAULTVIEWDIR).(constants::DS);
    }

    private function getBaseFileName(array $httpRequestInfo) {
    	$name	=	$this->_viewDir;
    	$name	.=	$httpRequestInfo['paramsInfo']['Views']['baseHTml'] ? $httpRequestInfo['paramsInfo']['Views']['baseHTml'] : constants::DEFAULTBASEHTMLVIEW;
    	$name	.=	$httpRequestInfo['paramsInfo']['Views']['extension'] ? $httpRequestInfo['paramsInfo']['Views']['extension'] : constants::DEFAULTVIEWEXTENSION;

    	return $name;
    }

    private function parseBaseHtmlFile(string $baseFileName) {
    	$server_name	=	constants::DEFAULTPROTOCOL.$this->_httpRequestInfo['serverInfo']['SERVER_NAME'].constants::DEFAULTPORT;
    	$baseHTmlArr	=	file($baseFileName);
    	foreach ($baseHTmlArr as $key => $value) {
			if (strpos($value, 'asset[[')>-1 && strpos($value, ']]')) {		
					$value	=	str_replace('asset[[', $server_name.constants::DS, $value);
					$value	=	str_replace(']]', '', $value);
					$baseHTmlArr[$key] = $value;
			}
    	}

    	$this->_baseHtml	=	$baseHTmlArr;
    }

    public function getBaseView() {

    	return $this->_baseHtml;
    }

    private function getCurrentViewDir(string $controllerName) {
    	return $this->_viewDir.constants::DS.$controllerName.constants::DS;
    }

    private function getParentView(array &$baseHTmlArr = []) {
    	$trimmedValue	=	strip_tags(preg_replace('/\s+/', '', trim($baseHTmlArr[0], " \t\n\r\0\x0B")));
    	$trimmedValue	=	str_replace("'", "", $trimmedValue);
    	if (strpos($trimmedValue, '[[%')>-1 && strpos($trimmedValue, '%]]')) {
    		if (strpos($trimmedValue, 'extends')) {
    			array_shift($baseHTmlArr);
    			return str_replace("%]]", "", substr($trimmedValue, strpos($trimmedValue, 'extends')+7,strpos($trimmedValue, '%]]')));
    		} else {
    		return '';
    		}
    	}
    }

    private function getChunks(array $currentViewArr = [], &$chunks) {

    	foreach ($currentViewArr as $key => $value) {
    		if(isset($chunkName)) {unset($chunkname);}
    		$trimmedValue	=	strip_tags(preg_replace('/\s+/', '', trim($value, " \t\n\r\0\x0B")));
    		if (strpos($trimmedValue, '[[%')>-1 && strpos($trimmedValue, '%]]')) {
    			if (strpos($trimmedValue, 'chunk')) {
    				$chunkName	=	str_replace("%]]", "", substr($trimmedValue, strpos($trimmedValue, 'chunk')+5,strpos($trimmedValue, '%]]')));
    				continue;
    			}
    			if (strpos($trimmedValue, 'end')) {
    				unset($chunkName);
    				continue;
    			}
    		}
    		if (isset($chunkName)) {
    			$chunks[$chunkName][]	=	$currentViewArr[$key];
    		}
    	}
    }

    private function mergeWithParent(array &$currentViewArr, array $parentView, array $chunks) {
    	foreach ($parentView as $key => $value) {
    		$trimmedValue	=	strip_tags(preg_replace('/\s+/', '', trim($value, " \t\n\r\0\x0B")));
    		if (strpos($trimmedValue, '[[%')>-1 && strpos($trimmedValue, '%]]')) {
    			if (strpos($trimmedValue, 'chunk')) {
    				$chunkName	=	str_replace("%]]", "", substr($trimmedValue, strpos($trimmedValue, 'chunk')+5,strpos($trimmedValue, '%]]')));
    				if(array_key_exists($chunkName ,$chunks)) {
    					$parentView[$key]	=	implode('',$chunks[$chunkName]);
    				} else {
    					$parentView[$key]	=	'';
    				}
    				continue;
    			}
    			if (strpos($trimmedValue, 'end')) {
    				$parentView[$key]	=	'';
    				continue;
    			}    			
    		}
    	}
    	$currentViewArr	=	$parentView;
    }

    private function parseCurrentView(array &$currentViewArr = [], array $data) {
		foreach ($currentViewArr as $key => $value) {
			$trimmedValue	=	strip_tags(preg_replace('/\s+/', '', trim($value, " \t\n\r\0\x0B")));
			if (strpos($trimmedValue, '[[')>-1 && strpos($trimmedValue, ']]')) {			
				$keyValue	=	str_replace("]]", "", substr($trimmedValue, strpos($trimmedValue, '[[')+2,strpos($trimmedValue, ']]')));
				if(array_key_exists($keyValue, $data)) {
					$value	=	str_replace('[[', '', $value);
					$value	=	str_replace(']]', '', $value);
					$currentViewArr[$key] = str_replace($keyValue, $data[$keyValue], $value);
				}
			}
		}    	
    }

    private function parseCurrentChunk($data, &$chunks, $chunk, $chunkKey) {
		foreach ($chunk as $key => $value) {
			$trimmedValue	=	strip_tags(preg_replace('/\s+/', '', trim($value, " \t\n\r\0\x0B")));
			if (strpos($trimmedValue, '[[')>-1 && strpos($trimmedValue, ']]')) {			
				$keyValue	=	str_replace("]]", "", substr($trimmedValue, strpos($trimmedValue, '[[')+2,strpos($trimmedValue, ']]')));
				if(array_key_exists($keyValue, $data)) {
					$value	=	str_replace('[[', '', $value);
					$value	=	str_replace(']]', '', $value);
					$chunks[$chunkKey][$key] = str_replace($keyValue, $data[$keyValue], $value);
				}
			}
		}    	
    }

    private function mergeData($data, &$chunks) {
    	foreach ($chunks as $key => $chunk) {
    		$this->parseCurrentChunk($data, $chunks, $chunk, $key);
    	}
    }

    public function getCurrentView(string $controllerName, string $actionName, array $data = []) {
    	$currentViewDir		=	$this->getCurrentViewDir($controllerName);
    	$httpRequestInfo	=	$this->_httpRequestInfo;
    	$viewExtension		=	$httpRequestInfo['paramsInfo']['Views']['extension'] ? $httpRequestInfo['paramsInfo']['Views']['extension'] : constants::DEFAULTVIEWEXTENSION;
    	$currentViewFile	=	$currentViewDir.$actionName.'Html'.$viewExtension;
    	$currentViewArr		=	file($currentViewFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    	$parentViewName		=	$this->getParentView($currentViewArr);
    	$chunks				=	[];
    	$this->getChunks($currentViewArr, $chunks);
    	$this->mergeData($data, $chunks);
    	$this->mergeWithParent($currentViewArr, $this->getBaseView(), $chunks);
    	$this->parseCurrentView($currentViewArr, $data);
    	return $currentViewArr;
    }

}
