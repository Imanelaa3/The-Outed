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

any("/Connexion", function(){
    require __DIR__."/MVC/Controller/connexionController.php";
    connexion();
});

any("/Deconnexion", function(){
    require __DIR__."/MVC/Controller/connexionController.php";
    deconnexion();
});



any("/404", "/404.php");

