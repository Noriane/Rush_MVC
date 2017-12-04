<?php

class WriterArticleModel extends AModel
{
    public function article($id)
    {
        $sql= "SELECT articles.id, title, users.username, categories.name as 'cat', tag_id,CONCAT('Webroot/Img/',url_img) as 'url_img',articles.create_date, articles.edit_date FROM articles INNER JOIN users ON articles.author_id = users.id INNER JOIN categories ON articles.categories_id = categories.id WHERE articles.id = '$id'";

        $this->_connect->setQuery($sql);
        return $this->_connect->SQLquery(false);
    }

    public function categories()
    {
      $sql = "SELECT * FROM categories";


    }

    public function add_article($article)
    {
        $title = $article['title'];
        $content = $article['content'];
        $author = $article['author_id'];
        $cat = $article['categories'];
        $url = $article['url_img'];

        $sql = "INSERT INTO articles VALUES (null,'$title','$content','$author','$cat',null,'$url',NOW(),NOW()";

        $this->_connect->setQuery($sql);
        $this->_connect->SQLquery(false);
    }

    public function add_categorie($categorie)
    {
        $name = $categorie['name'];

        $sql = "INSERT INTO categories VALUES (null,'$name')";

        $this->_connect->setQuery($sql);
        $this->_connect->SQLquery(false);
    }

    public function add_tag($tag)
    {
      $name = $tag['name'];

      $sql = "INSERT INTO tags VALUES (null,'$name')";

      $this->_connect->setQuery($sql);
      $this->_connect->SQLquery(false);
    }


    public function modif_article($article)
    {
        $title = $article['title'];
        $content = $article['content'];
        $cat = $article['cat'];
        $img = $article['url_img'];
        $sql = "UPDATE articles title = '$title',content = '$content', categories_id = '$cat',url_img = $url, edit_date = NOW()";

        $this->_connect->setQuery($sql);
        $this->_connect->SQLquery(false);
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
