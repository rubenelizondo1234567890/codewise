<?php
namespace controllers;

use services\controller;

/**
 * 
 */
class helloController extends controller
{
	
	function __construct($request)
	{
		parent::__construct($request);
	}

	public function indexAction () {
		$data['title']	=	'This is Hello Page ';
		$data['content']	=	'Hello World! GREAT!!!';

		return $this->buildHtmlResponse($data);
	}
}