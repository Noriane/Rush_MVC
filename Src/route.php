<?php 

	class Route 
	{
		private $_path;
		private $_callable;

		public function __construct($path, $callable)
		{
			$this->_path = $path;
			$this->_callable = $callable;
		}

		public function match($url)
		{
			$url = trim($url, '/');
			$path = preg_replace('#:([\w]+)#', '([^\]+)', $this->_path);
			$regex = "#^$path$#i";
		}
	    
    }

?>