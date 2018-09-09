<?php
namespace controllers;

use services\controller;
use services\crypto;
use models\cryptoTexts;
use models\errorMsg;

/**
 * TODO: Need to complete all annotations in properties and methods
 */
class cryptoController extends controller
{
	/*
	 *
	 */
	private $crypto;
	/*
	 *
	 */
	private $cryptoService;

	/*
	 *
	 */
	private $ok	=	true;
	
	/*
	 *
	 */
	function __construct($request)
	{
		parent::__construct($request);
		$this->crypto	= $this->getEntityManager('cryptoTexts');
		$this->errorMsg	= $this->getEntityManager('errorMsg');
		$this->cryptoService = new crypto($request);

	}

	/*
	 *
	 */
	public function indexAction () {
		
		//Most of the time data come from database / form or external sources
		//This is a simple implementation just for demo purposes		
		$this->ok	=	$this->ok && $this->crypto->setTitle();
		$this->ok	=	$this->ok && $this->crypto->setContent();

		if ($this->ok) {
			$data['title']		=	$this->crypto->getTitle();
			$data['content']	=	$this->crypto->getContent();
		} else {
			$data['title']		=	$this->errorMsg->getErrorCode('e1');
			$data['content']	=	$this->errorMsg->getErrorText('e1', $msg);
		}


		return $this->buildHtmlResponse($data);
	}

	/*
	 *
	 */
	public function findKeyAction() {
		//Verify the directory route is correct
		if(is_dir($this->cryptoService->getFilesDirectory($dir))) {
			$data['title']		=	$this->errorMsg->getErrorCode('e2');
			$data['content']	=	$this->errorMsg->getErrorText('e2', "{$dir} is not a valid directory!");
			return $this->buildHtmlResponse($data);
		} else {
			$text = "{$dir} found and valid...<br/>";
		}

		//Verify files are there
		if(!$this->cryptoService->checkForFiles($dir, $files, $encFileName, $refFileName)) {
			$data['title']		=	$this->errorMsg->getErrorCode('e3');
			$data['content']	=	$this->errorMsg->getErrorText('e3', "Needed files {$files} are missing!");
			return $this->buildHtmlResponse($data);
		} else {
			$text .= "{$encFileName}, {$refFileName} found and valid...<br/>";
		}

		//Remove blank lines and convert all to lowercase
		$this->ok = $this->ok && $this->cryptoService->setFormatedEncFile($dir, $encFileName, $formatedEncFileName, $handleFormatedEnc);
		$this->ok = $this->ok && $this->cryptoService->setFormatedRefFile($dir, $refFileName, $formatedRefFileName, $handleFormatedRef);

		if (!$this->ok) {
			$data['title']		=	$this->errorMsg->getErrorCode('e4');
			$data['content']	=	$this->errorMsg->getErrorText('e4', "There was an error setting formated files. Please review.");
			return $this->buildHtmlResponse($data);
		}

		if (!$this->cryptoService->prepareEncFile($encFileName, $formatedEncFileName, $handleFormatedEnc)) {
			$data['title']		=	$this->errorMsg->getErrorCode('e5');
			$data['content']	=	$this->errorMsg->getErrorText('e5', "There was an error preparing formated Encrypted files. Please review.");
			return $this->buildHtmlResponse($data);
		}

		if (!$this->cryptoService->prepareRefFile($refFileName, $formatedRefFileName, $handleFormatedRef)) {
			$data['title']		=	$this->errorMsg->getErrorCode('e5');
			$data['content']	=	$this->errorMsg->getErrorText('e5', "There was an error preparing formated Encrypted files. Please review.");
			return $this->buildHtmlResponse($data);
		}

		//Apply pattern recognition
		if (!$this->cryptoService->getEquivalentAlpha($formatedEncFileName, $formatedRefFileName, $alpha)) {
			$data['title']		=	$this->errorMsg->getErrorCode('e6');
			$data['content']	=	$this->errorMsg->getErrorText('e6', "There was an error applying pattern recognition. Please review.");
			return $this->buildHtmlResponse($data);
		} else {
			$alphaStr = implode(', ', $alpha);
			$text .= "{$alphaStr} found and valid...<br/>";
		}						

		$data['title']		=	'All good';
		$data['content']	=	$text;

		return $this->buildHtmlResponse($data);
	}

	public function deCipherFileAction() {
		//Verify the directory route is correct
		if(is_dir($this->cryptoService->getFilesDirectory($dir))) {
			$data['title']		=	$this->errorMsg->getErrorCode('e2');
			$data['content']	=	$this->errorMsg->getErrorText('e2', "{$dir} is not a valid directory!");
			return $this->buildHtmlResponse($data);
		} else {
			$text = "{$dir} found and valid...<br/>";
		}

		//Verify files are there
		if(!$this->cryptoService->checkForFiles($dir, $files, $encFileName, $refFileName)) {
			$data['title']		=	$this->errorMsg->getErrorCode('e3');
			$data['content']	=	$this->errorMsg->getErrorText('e3', "Needed files {$files} are missing!");
			return $this->buildHtmlResponse($data);
		} else {
			$text .= "{$encFileName}, {$refFileName} found and valid...<br/>";
		}

		//Remove blank lines and convert all to lowercase
		$this->ok = $this->ok && $this->cryptoService->setFormatedEncFile($dir, $encFileName, $formatedEncFileName, $handleFormatedEnc);
		$this->ok = $this->ok && $this->cryptoService->setFormatedRefFile($dir, $refFileName, $formatedRefFileName, $handleFormatedRef);

		if (!$this->ok) {
			$data['title']		=	$this->errorMsg->getErrorCode('e4');
			$data['content']	=	$this->errorMsg->getErrorText('e4', "There was an error setting formated files. Please review.");
			return $this->buildHtmlResponse($data);
		}

		if (!$this->cryptoService->prepareEncFile($encFileName, $formatedEncFileName, $handleFormatedEnc)) {
			$data['title']		=	$this->errorMsg->getErrorCode('e5');
			$data['content']	=	$this->errorMsg->getErrorText('e5', "There was an error preparing formated Encrypted files. Please review.");
			return $this->buildHtmlResponse($data);
		}

		if (!$this->cryptoService->prepareRefFile($refFileName, $formatedRefFileName, $handleFormatedRef)) {
			$data['title']		=	$this->errorMsg->getErrorCode('e5');
			$data['content']	=	$this->errorMsg->getErrorText('e5', "There was an error preparing formated Ref. files. Please review.");
			return $this->buildHtmlResponse($data);
		}

		if (!$this->cryptoService->deCipherFile($text, $encFileName, $formatedEncFileName, $handleFormatedEnc)) {
			$data['title']		=	$this->errorMsg->getErrorCode('e5');
			$data['content']	=	$this->errorMsg->getErrorText('e5', "There was an error preparing formated Encrypted files. Please review.");
			return $this->buildHtmlResponse($data);
		}

		$data['title']		=	'All good -- decrypting encrypted.txt';
		$data['content']	=	$text;

		return $this->buildHtmlResponse($data);		

	}

}