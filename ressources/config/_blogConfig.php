<?php 
return [
    //l'host est l'hebergeur de la BDD
    "host"=>$_ENV["DB_HOST"]??"127.1.1.1",
    // le port utilisé pour se connecter
    "port"=>$_ENV["DB_PORT"]??"3306",
    //le nom de la BDD
    "database"=>$_ENV["DB_NAME"]??"theOutedBlog",
    //Le nom utilisateur pour se connecter
    "user"=>$_ENV["DB_USER"]??"root",
    //Le mot de passe 
    "password"=>$_ENV["DB_PASSWORD"]??"root",
    //le set de caratere utilisé
    "charset"=>$_ENV["DB_CHARSET"]??"utf8mb4",
    /*
        Ce tableau d'option sera utilisé par "PDO

PHP data Object est un objet servant a la connexcion au BDD        */
    "options"=>
    [
        //Choisi le mode d'affichage d'erreur
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Choisi le mode de recuperation des données (ici tableau associatif)
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // J'indique a PDO de ne pas emuler les requtes preparer, ce sera la BDD qui va s'en occuper 
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
]
?>