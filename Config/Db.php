<?php
	// include_once($basePath.'/Config/config.php');

	class Db
	{
	    private $_query;
	    private $_pdo;
	    private $_variable;

	    public function __construct($query, $variable = array())
	    {
	        $this->_pdo = $this->connect_db($this->_ddbName);
	        $this->_pdo->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING );
	        $this->_query = $query;
	        $this->_variable = $variable;
	    }

	    public function SQLquery($fetch = True)
	    {
	        $res = $this->_pdo->prepare($this->_query);
	        $check = $res->execute($this->_variable);
	        if (!$check)//La requete n'est pas passée
	        {
	        	return (-1);
	        }
	        else if($fetch)
	        {
	        	$result = $res->fetchAll();
	       	 	return($result);
	        }
	        //return $this->_pdo->lastInsertId();
	    }

        private function connect_db()
	    {
            return (new PDO("mysql:host=HOST;port=PORT;dbname=DB", USERNAME, PASSWORD));
	    }
	    public function getErrors()
	    {
	    	return $this->_pdo->errorInfo();
	    }
	}
?>
