<?php

	//include_once($basePath.'/Models/Article.php');

	class articleController
	{
		private $_title;
		private $_description = NULL;
		private $_articles = array();

		public function __construct($url, $get, $post)
		{
			$article = new article();
			$this->_articles = $article->get_articles();

			$articles =  array();
			foreach ($this->_articles as $key => $article)
			{
				$articles[$key]['title'] = htmlspecialchars($article['title']);
				$articles[$key]['description'] = nl2br((htmlspecialchars($article['description'])));
			}
			$this->_articles = $articles;

			if (!isset($post['title']) || $post['title'] == "")
			{
				echo "Title is missing";
				return false;
			}
			$this->check_data($post['title'], isset($post['description']) ? $post['description'] : NULL);
		}

		public function get_articles()
		{
			return $this->_articles;
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

				$newarticle = new article();
				$newarticle->post_article($this->_title, $this->_description);

				if ($newarticle->post_article($title, $description) == -1)
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


	// $article = new articleController($path, $_GET, $_POST);
	//
	// $articles = $article->get_articles();

	include_once($basePath.'Views/Articles/action.html');
