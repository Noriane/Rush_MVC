<?php

class WriterMainController extends AppController
{
    protected function beforeRender()
    {
        //verif si c'est un admin
        if ((($this->_params['user']['group'] == "ADMIN") || ($this->_params['user']['group'] == "WRITER")) && ($this->_params['user']['ban'] == false)) {

              //si reçois add_article avec toutes les données nécessaires
            if (!empty($_POST['add_article'])) {
                $router = new Router("");

                $router->post('/', function () {
                    require_once PATH."/Models/Writer.php";
                    require_once PATH."/Controllers/WriterArticleController.php";
                    require_once PATH."/Views/View.php";

                    ArticleController::getInstance("WriterModel", "writerArticle.twig")->run();
                });
            }

            //si reçois modif_article avec tous les champs user sauf password
            if (!empty($_POST['modif_article'])) {
                $router = new Router("");

                $router->post('/', function () {
                    require_once PATH."/Models/Writer.php";
                    require_once PATH."/Controllers/WriterArticleController.php";
                    require_once PATH."/Views/View.php";

                    ArticleController::getInstance("WriterModel", "writerArticle.twig")->run();
                });
            }

            //si reçois delete_article avec un id
            if (!empty($_POST['delete_article'])) {
                $this->delete_article();
            }

            //envois toutes les données de la bdd articles pour la view
            $this->_params['data'] = $this->_model->articles();

            $this->_params['articles']=[];
            $i=0;
            while ($data = $this->_params['data']->fetch(PDO::FETCH_ASSOC)) {
                array_push($this->_params['articles'], $data);
            }
            array_shift($this->_params);
        } else {
            $this->redirect();
        }
    }

    private function delete_article()
    {
        $id = $_POST['delete_article'];
        $this->_model->delete_article($id);
    }
}
