<?php
    // include_once($basePath.'/Config/config.php');

    class Db
    {
        private $_query;
        private $_pdo;
        private $_variable;

        public function __construct($query, $variable = array())
        {
            $this->_pdo = $this->connect_db();
            $this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
            $this->_query = $query;
            $this->_variable = $variable;
        }

        public function SQLquery($fetch = true)
        {
            $res = $this->_pdo->prepare($this->_query);
            $check = $res->execute($this->_variable);
            if (!$check) {//La requete n'est pas passée
                return (-1);
            } elseif ($fetch) {
                $result = $res->fetchAll();
                return($result);
            }else {
              return $res;
            }
            //return $this->_pdo->lastInsertId();
        }

        private function connect_db()
        {
					$host=HOST;
					$port=PORT;
					$db = DB;
            return (new PDO("mysql:host=$host;port=$port;dbname=$db", USERNAME, PASSWORD));
        }

        public function getErrors()
        {
            return $this->_pdo->errorInfo();
        }
    }
