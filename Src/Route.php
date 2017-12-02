<?php

    class Route
    {
        private $_path;
        private $_callable;
        private $_matches = [];
		private $_params = [];

        public function __construct($path, $callable)
        {

            $this->_path = trim($path, '/');
            $this->_callable = $callable;
        }

        public function match($url)
        {
            
            $url = trim($url, '/');
            
            $path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->_path);
            $regex = "#^$path$#i";
            if (!preg_match($regex, $url, $matches)) {
                return false;
            }
            array_shift($matches);
            $this->_matches = $matches;
            return true;
        }

		public function with($param, $regex)
		{
			$this->_params[$param] = str_replace('(','(?',$regex);
			return $this;
		}

        private function paramMatch($match)
        {
            if (isset($this->_params[$match[1]])) {
                return '('.$this->_params[$match[1]].')';
            }
            return '([^/]+)';
        }

        public function call()
        {
            echo "call:".$this->_path.":<br/>";
            return call_user_func_array($this->_callable, $this->_matches);
        }
    }
