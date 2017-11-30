<?php

abstract class AppController
{
    protected $_model;
    protected $_file;
    protected $_params = [];
		private static $_instance = null;

    protected function __construct($model, $file)
    {
        $this->loadModel($model);
				$this->_file = $file;
    }

		//retourn l'instance en cours ou en crée une
		abstract static function getInstance($model, $file = null);
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
        $this->_file->run();
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
}
