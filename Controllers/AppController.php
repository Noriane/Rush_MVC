<?php

abstract class AppController
{
    protected $_model;
    protected $_file;
    protected $_params = [];
    protected $_log;
    protected static $_instance = null;

    protected function __construct($model, $file)
    {
        $this->loadModel($model);
        $this->user_id();
        $this->_file = $file;

        if ($this->_log >= 0) {
            $login = new log($this->_log);
            $this->_params['user']['group'] = $login->is_group();
            $this->_params['user']['name'] = $login->this_name();
        }
    }

    //retourn l'instance en cours ou en crée une
    abstract public static function getInstance($model, $file = null);
    // {
    // 		if (is_null(self::$_instance)) {
    // 				self::$_instance = new AppController();
    // 		}
    // 		return self::$_instance;
    // }

    protected function loadModel($model)
    {
        $this->_model = new $model();
    }

    abstract protected function beforeRender();

    protected function render()
    {
        $this->_file = new View($this->_file, $this->_params);
        //$this->_file->run();
    }

    public function run()
    {
        $this->beforeRender();
        $this->render();
    }

    protected function redirect()
    {
        $router = new Router();

        $router->get('/', function () {
            echo "tous les articles";
        });
    }

    public function secure_input($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function user_id()
    {
        if (isset($_COOKIE["log"])) {
            $_SESSION["log"] = $_COOKIE["log"];
            $this->_log= new Log($_SESSION["log"]);
        }

        if (!empty($_SESSION) && (!isset($this->_log))) {
            $this->_log= new Log($_SESSION["log"]);
        } else {
            $this->_log = -1;
        }
    }
}
