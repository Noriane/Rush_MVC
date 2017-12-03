<?php

class WriterModel extends AModel
{
    public function articles()
    {
        $sql= "SELECT articles.id, title, users.username, categories.name as 'cat',articles.create_date, articles.edit_date FROM articles INNER JOIN users ON articles.author_id = users.id INNER JOIN categories ON articles.categories_id = categories.id ORDER BY articles.id DESC;";

        $this->_connect->setQuery($sql);
        return $this->_connect->SQLquery(false);
    }


    //supprime les comments lié aux articles puis l'article
    public function delete_article($id)
    {
        $sql = " DELETE FROM comments WHERE articles_id = '$id'";

        $this->_connect->setQuery($sql);
        $this->_connect->SQLquery(false);

        $sql = " DELETE FROM articles WHERE id = '$id'";

        $this->_connect->setQuery($sql);
        $this->_connect->SQLquery(false);
    }

}
