<?php 

	include_once($basePath.'/Models/Article.php');

	class TaskController
	{
		private $_title;
		private $_description = NULL;
		private $_tasks = array();

		public function __construct($url, $get, $post)
		{
			$task = new Task();
			$this->_tasks = $task->get_tasks();

			$tasks =  array();
			foreach ($this->_tasks as $key => $task) 
			{
				$tasks[$key]['title'] = htmlspecialchars($task['title']);
				$tasks[$key]['description'] = nl2br((htmlspecialchars($task['description'])));
			}
			$this->_tasks = $tasks;
		
			if (!isset($post['title']) || $post['title'] == "")
			{
				echo "Title is missing";
				return false;
			}
			$this->check_data($post['title'], isset($post['description']) ? $post['description'] : NULL);
		}

		public function get_tasks()
		{
			return $this->_tasks;
		}

		public function check_data($title, $description = NULL)
		{
			if(!empty($title))
			{
				$this->_title = $this->secure_data($title);
				
				if (!empty($description))
				{
					$this->_description = $this->secure_data($description);
				}

				$newTask = new Task();
				$newTask->post_task($this->_title, $this->_description);

				if ($newTask->post_task($title, $description) == -1)
				{
					//Erreur
				}
			}
		}

		public function secure_data($data)
		{
			$data = trim($data); // remove start en and space on text
			$data = stripslashes($data); // remove slash
			$data = htmlspecialchars($data);
			return $data;
		}
	}


	$task = new TaskController($path, $_GET, $_POST);

	$tasks = $task->get_tasks();
	
	include_once($basePath.'/Views/tasks.php');
	