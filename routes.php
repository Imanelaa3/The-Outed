<?php

require_once __DIR__.'/router.php';

get("/", "./index.php");
get("/TerrainDeJeu", "MVC/View/TerrainDeJeu.php");
get("/Rejoindre", "MVC/View/Rejoindre.php");
get("/Blog", "MVC/View/Blog.php");

any("/Inscription", function(){
    require_once __DIR__."/MVC/Controller/inscriptionController.php";
    inscription();
});

any("/404", "./404.php");

