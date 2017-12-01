<?php

class AccueilModel extends AModel
{

  public function ten_articles()
  {
    $sql= "SELECT articles.id, title, content, users.username, categories.name as 'cat', tag_id, url_img, articles.create_date, articles.edit_date FROM articles INNER JOIN users ON articles.author_id = users.id INNER JOIN categories ON articles.categories_id = categories.id ORDER BY articles.id DESC LIMIT 10"; 
  }

  public function nb_comment($id)
  {
    # code...
  }

}
