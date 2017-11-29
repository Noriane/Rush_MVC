<?php 
	
	include_once($basePath.'/Config/Db.php');

	class Article
	{
		private $_task;

		public function __construct()
		{
			$queryTasks = "SELECT * FROM tasks";
			$query = new Db($queryTasks);
			$resultTasks = $query->SQLquery();//FetchAll
			$this->_task = $resultTasks;
		}
		//all tasks
		public function get_tasks()
		{
			return $this->_task;
		}

		//all one task by its id
		public function get_task_id($id)
		{
			foreach ($this->_task as $key => $value) 
			{
				if ($value['id'] == $id)
				{
					return $value;
				}
			}
		}

		//Create a new task in bdd
		public function post_task($title, $description = NULL)
		{
			$queryTasksId = "INSERT INTO tasks (title, description, creation_date) VALUES (?, ?, NOW())";
			$variable = array($title, $description);
			$query = new Db($queryTasksId, $variable);
			$query->SQLquery(false);
		}

		//Edit a task in bdd
		public function put_task($id, $title = NULL, $description = NULL)
		{
			if ($title == "")
			{
				return;
			}
			if ($title == NULL && $description == NULL)
			{
				return;
			}
			if ($title != NULL && $description != NULL)
			{
				$queryAll = "UPDATE Tasks SET title = (?), description = (?), edition_date = CURDATE() WHERE id =(?)";
				$variable = array($title, $description, $id);
				$query = new Db($queryAll, $variable);
				$query->SQLquery(false);
			}
			else if ($title != NULL)
			{
				$queryTitle = "UPDATE Tasks SET title = (?), edition_date = NOW() WHERE id =(?)";
				$variable = array($title, $id);
				$query = new Db($queryTitle, $variable);
				$query->SQLquery(false);
			}
			else ($description != NULL)
			{
				$queryTasksDesc = "UPDATE Tasks SET description = (?), edition_date = NOW() WHERE id =(?)";
				$variable = array($description, $id);
				$query = new Db($queryTasksDesc, $variable);
				$query->SQLquery(false);
			}
		}

		//Delete a task by its id
		public function delete_task($id)
		{
			foreach ($this->_task as $key => $value) 
			{
				if ($value['id'] == $id)
				{
					$queryDeleteTask = "DELETE FROM tasks WHERE id=(?)";
					$query = new Db($queryDeleteTask, [$id]);
					$query->SQLquery(false);
				}
			}
		}
	}

	$test = new Task();
	//var_dump($test->_task);
	//$test->post_task("cnpuvelle tache");
	//$test->put_task(4, "", "description test");
	//$test->delete_task(3);

?>