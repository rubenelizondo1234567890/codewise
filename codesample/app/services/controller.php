<?php
namespace services;

/**
 * Main Controller with methods common to all controllers
 */
class controller
{
	protected $_request;

	protected $_view;

	protected $_entityManager;
	
	function __construct(request $request)
	{
		$this->_request			=	$request;

		if (!$this->_view) {
			$this->_view			=	new view($request);
		}		

		if (!$this->_entityManager) {
			$this->_entityManager	=	new entityManager($request);
		}
		
	}

	public function getEntityManager(string $model = '') {
		if ($model != '') {
			return $this->instantiateModelClass('models\\'.$model);
		} else {
			return $this->_entityManager; //This provides database access through pdo
		}
		
	}

	private function instantiateModelClass($modelClass) {
		return new $modelClass($this->_entityManager);
	}

	public function getView() {
		return $this->_view;
	}

	public function buildHtmlResponse($data) {
		$baseView	=	$this->_view->getCurrentView($this->_request->getControllerName(), $this->_request->getActionName(), $data);

		$view	=	implode('', $baseView);

		echo $view;
	}

}