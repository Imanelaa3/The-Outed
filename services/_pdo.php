<?php 

function connexionPDO():\PDO
{
    //Je recupere les infos di fichier de configutayion On peut mettre ce fichier dans une varibale grace au faite qu'on areturn dan sl'e fichier blogConfig
    $config = require __DIR__ . "./../config/_blogConfig.php";
    /*
        jE VAIS DEVOIR CONSTRUIRE UN dsn? dATA sOURCE nAME? C4ST UN STRING QUI CONTIENT TOUTES LES INFORMATIONS pour localiser la BDD
        il pre,dra la forme suivante :
                "pilote de la bdd:host="hote de la bdd";
                dbname="nom de la bdd;
                port = "port de la bdd;
                charset = "charser=t de la bdd"
            Par ex 
                mysql:host=localhost;port=3306;dbname=blog;charsert=utf8mb4
    */
    $dsn =  "mysql:host=".$config["host"]
    .";port=". $config["port"]
    .";dbname=". $config["database"]
    .";charset=". $config["charset"];
    try
    {
        //On crée une nouvelle instance de PDO en lui donnant en argument:
        //le DSN,
        //le nom utilisateur,
        //le mot de passe,
        //et les options PDO,

        $pdo = new \PDO($dsn,$config["user"],$config["password"],$config["options"]);
        return $pdo;
    }
    catch(\PDOException $e)
    {
        /*
            On lance uine nouvelle instance de PDOException
        */
        throw new \PDOException($e -> getMessage(),(int)$e->getCode());

    }
}
/**
 * Fitre le string passé en parametre
 *
 * @param string $data
 * @return void
 */
function clean_data(string $data)
{
    $data = trim($data);
    $$data = stripslashes($data);
    return htmlspecialchars($data);
    //return htmlspecialchars(stripcslashes(trim($data)))
}
?>