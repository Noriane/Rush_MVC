<?php

class WriterMainController extends WriterMainController
{
    private $_modelComment;

    protected function loadModel($model)
    {
        $this->_model = new $model();
        require_once PATH."/Models/Comment.php";
        $this->_modelComment = new CommentModel();
    }

    protected function beforeRender()
    {
        //verif si c'est un admin ou un writer
        if ((($this->_params['user']['group'] == "ADMIN") || ($this->_params['user']['group'] == "WRITER")) && ($this->_params['user']['ban'] == false)) {

              //si reçois add_article avec toutes les données nécessaires
            if (!empty($_POST['add_categorie'])) {
                $cat = $this->add_categorie();
            }

            if (!empty($_POST['add_tag'])) {
                $tag = $this->add_tag();
            }

            if (!empty($_POST['add_article'])) {
                $id_article = ($this->add_article());
            }

            //si reçois modif_article avec les données nécessaires
            if (!empty($_POST['modif_article'])) {
                $this->modif_article();
            }

            if (!empty($_POST['delete_article'])) {
                $this->delete_article();
            }

            if (!empty($_POST['add_comment'])) {
                $id_comment = ($this->add_comment());
            }

            //si reçois modif_comment avec les données nécessaires
            if (!empty($_POST['modif_comment'])) {
                $this->modif_comment();
            }

            if (!empty($_POST['delete_comment'])) {
                $this->delete_comment();
            }

            if (!empty($_POST['article_id']) || !empty($id_article)) {
                //envois les données de la bdd articles pour la view
                if (empty($id_article)) {
                    $id_article = $_POST['article_id'];
                }
                $this->_params['data'] = $this->_model->article($id_article);

                $this->_params['article']['nb_comment'] = $this->_modelComment($id_article);
                while ($data = $this->_params['data']->fetch(PDO::FETCH_ASSOC)) {
                    array_push($this->_params['article'], $data);
                }
                array_shift($this->_params);
            }
        } else {
            $this->redirect();
        }
    }


    private function add_categorie()
    {
        $new_cat = $this->secure_input($_POST['add_categorie']);
        return ($this->_model->add_cat($new_cat));
    }

    private function add_tag()
    {
        $new_tag = $this->secure_input($_POST['add_tag']);
        return ($this->_model->add_tag($new_tag));
    }

    private function add_article()
    {
        $input=[];

        $uploaddir = PATH."Webroot/Img/";
        $uploadfile = $uploaddir . basename($this->secure_input($_POST['modif_article']['url_img']));

        if (move_uploaded_file($_POST['add_article']['url_img'], $uploadfile)) {
            echo "Le fichier est valide, et a été téléchargé avec succès.\n";
        } else {
            echo "Attaque potentielle par téléchargement de fichiers.\n";
            return false;
        }

        foreach ($_POST['add_article'] as $key => $value) {
            $input[$key] = $this->secure_input($value);
        }
        $input['author_id']= $_SESSION["log"];
        return ($this->_model->add_article($input));
    }

    private function modif_article()
    {
        $input=[];

        if (!empty($_POST['modif_article']['url_img'])) {
            $uploaddir = PATH."Webroot/Img/";
            $uploadfile = $uploaddir . basename($this->secure_input($_POST['modif_article']['url_img']));

            if (move_uploaded_file($_POST['modif_article']['img'], $uploadfile)) {
                echo "Le fichier est valide, et a été téléchargé avec succès.\n";
            } else {
                echo "Attaque potentielle par téléchargement de fichiers.\n";
                return false;
            }
        }

        foreach ($_POST['modif_article'] as $key => $value) {
            $input[$key] = $this->secure_input($value);
        }
        $this->_model->modif_article($input);
    }

    private function delete_article()
    {
        $id = $_POST['delete_article'];
        $this->_model->delete_article($id);

        $this->redirect("GET", "/writer");
    }

    private function add_comment()
    {
        $input=[];
        foreach ($_POST['add_comment'] as $key => $value) {
            $input[$key] = $this->secure_input($value);
        }
        $input['author_id']= $_SESSION["log"];
        $this->_modelComment->add_comment($input);
    }

    private function modif_comment()
    {
        $input=[];
        foreach ($_POST['modif_comment'] as $key => $value) {
            $input[$key] = $this->secure_input($value);
        }
        $this->_modelComment->modif_comment($input);
    }

    private function delete_comment($id)
    {
        $this->_modelComment->delete_comment($id);
    }
}
