<?php

class SEngine
{
    private $_donne;

    public function __construct()
    {
    }


    public function products()
    {
        $filter= $_POST["filter"];

        if (!isset($_POST["order"])) {
            $order = "desc";
        } else {
            $order = "asc";
        }

        if (isset($_POST["order_by"])) {
            $temp = $_POST["order_by"];
            if ($temp == "price") {
                $order_by = "ORDER BY price ".$order;
            } else {
                $order_by = "ORDER BY products.name ".$order;
            }
        } else {
            $order_by ="";
        }

        if (!empty($_POST["search"])) {
            $search = $_POST["search"];

            if (($filter == "products.name") || ($filter == "products.price")) {
                $sql = "SELECT products.name as 'np', price, categories.name as 'nc' FROM products INNER JOIN categories ON products.category_id = categories.id WHERE $filter like '%$search%' $order_by";
            } else {
                $cat = explode('.', $filter);
                $cat_name = $cat[1];
                $cat_order = $cat[0];
                $cat_order = $cat_order.".name";
                $sql = "SELECT products.name as 'np', price, categories.name as 'nc' FROM products INNER JOIN categories ON products.category_id = categories.id WHERE categories.name = '$cat_name' AND products.name like '%$search%' $order_by";
            }
        } else {
            if (($filter == "products.name") || ($filter == "products.price")) {
                $sql = "SELECT products.name as 'np', price, categories.name as 'nc' FROM products INNER JOIN categories ON products.category_id = categories.id $order_by";
            } else {
                $cat = explode('.', $filter);
                $cat_name = $cat[1];
                $cat_order = $cat[0];
                $cat_order = $cat_order.".name";

                $sql = "SELECT products.name as 'np', price, categories.name as 'nc' FROM products INNER JOIN categories ON products.category_id = categories.id WHERE categories.name = '$cat_name' $order_by";
            }
        }
        $this->_bdd = new Db($sql);
        $this->_donne = $this->_bdd->SQLquery(false);
    }

    public function display()
    {
        while ($res = $this->_donne->fetch()) {
            echo "<tr>";
            if (isset($_POST["d_name"])) {
                echo '<th>'.$res["np"].'</th>';
            }
            if (isset($_POST["d_price"])) {
                echo '<th>'.$res["price"].'</th>';
            }
            if (isset($_POST["d_category"])) {
                echo '<th>'.$res["nc"].'</th>';
            }
            echo "</tr>";
        }
    }
}
