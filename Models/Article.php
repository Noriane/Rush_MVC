<?php

    include_once($basePath.'/Config/Db.php');

    class Article
    {
        private $_article;

        public function __construct()
        {
            $queryarticles = "SELECT * FROM articles";
            $query = new Db($queryarticles);
            $resultarticles = $query->SQLquery();//FetchAll
            $this->_article = $resultarticles;
        }
        //all articles
        public function get_articles()
        {
            return $this->_article;
        }

        //all one article by its id
        public function get_article_id($id)
        {
            foreach ($this->_article as $key => $value) {
                if ($value['id'] == $id) {
                    return $value;
                }
            }
        }

        //Create a new article in bdd
        public function post_article($title, $description = null)
        {
            $queryarticlesId = "INSERT INTO articles (title, description, creation_date) VALUES (?, ?, NOW())";
            $variable = array($title, $description);
            $query = new Db($queryarticlesId, $variable);
            $query->SQLquery(false);
        }

        //Edit a article in bdd
        public function put_article($id, $title = null, $description = null)
        {
            if ($title == "") {
                return;
            }
            if ($title == null && $description == null) {
                return;
            }
            if ($title != null && $description != null) {

                $queryAll = "UPDATE articles SET title = (?), description = (?), edition_date = CURDATE() WHERE id =(?)";
                $variable = array($title, $description, $id);
                $query = new Db($queryAll, $variable);
                $query->SQLquery(false);

            } elseif ($title != null) {

                $queryTitle = "UPDATE articles SET title = (?), edition_date = NOW() WHERE id =(?)";
                $variable = array($title, $id);
                $query = new Db($queryTitle, $variable);
                $query->SQLquery(false);

            } elseif ($description != null) {
							
                $queryArticlesDesc = "UPDATE articles SET description = (?), edition_date = NOW() WHERE id =(?)" ;
                $variable = array($description, $id);
                $query = new Db($queryArticlesDesc, $variable);
                $query->SQLquery(false);
            }
        }

        //Delete a article by its id
        public function delete_article($id)
        {
            foreach ($this->_article as $key => $value) {
                if ($value['id'] == $id) {
                    $queryDeletearticle = "DELETE FROM articles WHERE id=(?)";
                    $query = new Db($queryDeletearticle, [$id]);
                    $query->SQLquery(false);
                }
            }
        }
    }

    $test = new article();
    //var_dump($test->_article);
    //$test->post_article("cnpuvelle tache");
    //$test->put_article(4, "", "description test");
    //$test->delete_article(3);
