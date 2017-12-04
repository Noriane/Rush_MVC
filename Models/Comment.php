<?php

class CommentModel extends AModel
{
    public function comments()
    {
        $sql= "SELECT comments.id, title, users.username, categories.name as 'cat', CONCAT('Webroot/Img/',url_img) as 'url_img',comments.create_date, comments.edit_date FROM comments INNER JOIN users ON comments.author_id = users.id INNER JOIN categories ON comments.categories_id = categories.id ORDER BY comments.id DESC;";

        $this->_connect->setQuery($sql);
        return $this->_connect->SQLquery(false);
    }

    public function add_comment($comment)
    {
        $content = $comment['content'];
        $author = $comment['author_id'];
        $art = $comment['articles_id'];

        $sql = "INSERT INTO comments VALUES (null, '$content','$author','$art',NOW(),NOW()";

        $this->_connect->setQuery($sql);
        $this->_connect->SQLquery(false);
    }


    public function modif_comment($comment)
    {
        $content = $comment['content'];
        $art = $comment['articles_id'];

        $sql = "UPDATE comments VALUES content = '$content', edit_date = NOW()";

        $this->_connect->setQuery($sql);
        $this->_connect->SQLquery(false);
    }


    //supprime le comment
    public function delete_comment($id)
    {
        $sql = " DELETE FROM comments WHERE id = '$id'";

        $this->_connect->setQuery($sql);
        $this->_connect->SQLquery(false);
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
