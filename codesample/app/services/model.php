<?php
namespace services;

use configs\constants;

/**
 * Main Controller with methods common to all controllers
 */
class model
{

    /**
     * Entity Manager
     *
     * @var object
     */
    protected $_em;

    /**
     * Table name
     *
     * @var string
     */
    protected $_modelClassName;

    /**
     * Table structure (column name, field type, key, length, etc)
     *
     * @var array
     */
    protected $_metadata;

	function __construct(entityManager $em, $modelClassName)
	{
		$this->_em	=	$em;

		$this->setModelClassName($modelClassName);

		$this->setMetaData();
	}

	private function setModelClassName(string $modelClassName) {

		$this->_modelClassName	=	str_replace('models\\', '', $modelClassName);
	}

	private function getModelMetaData() {
		if (!empty($this->_modelClassName)) {
			$q	=	$this->_em->getQuery("DESCRIBE $this->_modelClassName");
			return	$q->fetchAll(\PDO::FETCH_ASSOC);
		} else {
			return false;
		}
	}

	private function setMetaData() {
		//$this->_metadata	=	$this->getModelMetaData();
		$this->_metadata	=	['metadata' => 'describe table Not available in postgres'];
	}

	public function getMetaData() {
		return $this->_metadata;
	}

	public function findAll() {
		$sql	=	"select * from $this->_modelClassName limit ".constants::DEFAULTLIMITFORFINDALL;
		return	$this->_em->getQuery($sql);
	}
}