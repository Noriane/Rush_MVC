<?php 

	
	$router = new Router($_GET['url']);

	$router->get('/', function()
	{
		echo "tous les articles";
	});

	$router->get('/articles/:id', function($id)
	{
		echo "affiche l'article".$id;
	});

	$router->get('/admin', function($id)
	{
		echo "Page admin";
	});

	$router->get('/writer', function($id)
	{
		echo "Page writer";
	});

	$router->get('/login', function($id)
	{
		echo "Page login";
	});
	
	$router->get('/logout', function($id)
	{
		echo "Page logout";
	});

?>