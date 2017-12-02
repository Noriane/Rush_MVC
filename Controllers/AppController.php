<?php

abstract class AppController
{
    protected $_model;
    protected $_file;
    protected $_view;
    protected $_params = [];
    protected $_log;
    protected $redirected = False;
    protected static $_instance = [];

    protected function __construct($model, $file)
    {
        $this->loadModel($model);
        $this->user_id();
        $this->_file = $file;
        
        if (!is_integer($this->_log)) {
            $login = $this->_log;
            $this->_params['user']['group'] = $login->is_group();
            $this->_params['user']['name'] = $login->this_name();
            $this->_params['user']['ban'] = $login->is_ban();
        }
    }

    //retourn l'instance en cours ou en crée une
    public static function getInstance($model, $file = null)
    {
        $cls = get_called_class(); // renvoi le nom de la vraie classe (pas AppController)
        if (!isset(self::$_instance[$cls])) {
            self::$_instance[$cls] = new $cls($model, $file);
        }
        return self::$_instance[$cls];
    }
    protected function loadModel($model)
    {
        $this->_model = new $model();
    }

    abstract protected function beforeRender();

    protected function render()
    {   
        $this->_view = new View($this->_file, $this->_params);
    }

    public function run()
    {
        $this->beforeRender();
        if(!$this->redirected)
        {
            $this->render();            
        }

    }
    protected function fullredirect($url = "/")
    {
        Header("Location: ".BASE_URL.$url);
        exit();
    }
    protected function redirect($method = "GET", $url = "/")
    {
        $router = Router::getInstance();
        $this->redirected = True;
        //var_dump($router);
        return $router->redirect($method, $url);
    }

    public function secure_input($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //return id ou -1
    public function user_id()
    {
        if (isset($_COOKIE["log"])) {
            $_SESSION["log"] = $_COOKIE["log"];
            $this->_log= new Log($_SESSION["log"]);
        }

        if (!empty($_SESSION) && (!isset($this->_log)) && isset($_SESSION['log'])) {
            $this->_log= new Log($_SESSION["log"]);
        } else {
            $this->_log = -1;
        }
    }
}
