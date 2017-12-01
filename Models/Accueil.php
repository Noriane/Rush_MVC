<?php

class AccueilModel extends AModel
{
    public function ten_articles()
    {
        $sql= "SELECT articles.id, title, content, users.username, categories.name as 'cat', tag_id, CONCAT('Webroot/Img/',url_img) as 'url_img', articles.create_date, articles.edit_date FROM articles INNER JOIN users ON articles.author_id = users.id INNER JOIN categories ON articles.categories_id = categories.id ORDER BY articles.id DESC LIMIT 10";

        $this->_connect->setQuery($sql);
        return $this->_connect->SQLquery(false);
    }

    public function nb_comment($id)
    {
        $sql = "SELECT COUNT(id) as 'nb' FROM comments WHERE articles_id = '$id'";
        $this->_connect->setQuery($sql);
        $res = $this->_connect->SQLquery();
        if (empty($res["nb"])) {
            $ret =0;
        } else {
            $ret = $res["nb"];
        }
        return $ret;
    }
}
