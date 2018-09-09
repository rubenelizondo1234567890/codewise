<?php
namespace configs;

/**
 * Basic Config class
 */
class config
{
    /**
     * DB Connection String
     *
     * @var Array
     * @access private
     */
    protected $_params;

   
    /**
     * Constructor
     * Loads configuration
     */    
    public function __construct()
    {
    	$this->_params	=	parse_ini_file('params.ini', true);
    }

    public function getParams() {
    	return $this->_params;
    }

}
