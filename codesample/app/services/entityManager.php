<?php
namespace services;

/**
 * Main Controller with methods common to all controllers
 */
class entityManager
{

    /**
     * Http Request Info
     *
     * @var Array
     * @access private
     */
	protected $_dsn;

    /**
     * Http Request Info
     *
     * @var Array
     * @access private
     */
	protected $_dbData;

    /**
     * Http Request Info
     *
     * @var Array
     * @access private
     */
	protected $_pdo;

    /**
     * Http Request Info
     *
     * @var Array
     * @access private
     */
    protected $_httpRequestInfo;
	
	function __construct(request $request)
	{
    	$this->_httpRequestInfo	=	$request->getHttpRequest();

		$this->_dbData	=	$this->_httpRequestInfo['paramsInfo']['Database'];

		if ($this->_dbData['useDb'] == 'YES') {
			$this->_dsn	=	$this->getDsn();
			$this->_pdo	=	$this->getPdo();
		}

	}

	private function getDsn() {
		return	$this->_dbData['driver'].':host='.$this->_dbData['host'].';port='.$this->_dbData['port'].';dbname='.$this->_dbData['dbName'];
	}

	private function getPdo() {
		try {
			return new \PDO($this->_dsn, $this->_dbData['dbUser'], $this->_dbData['dbPassword'], array(
    \PDO::ATTR_PERSISTENT => $this->_dbData['usePersistent']));
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}

		return $pdo;
	}

	public function getQuery($sql) {
		$this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		return $this->_pdo->query($sql);
	}


}