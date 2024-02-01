<?php 

require __DIR__ ."/../../services/_shouldBeLogged.php";
require __DIR__ ."/../../services/_pdo.php";
require __DIR__ ."/../Model/connexionModel.php";


function connexion() {
    shouldBeLogged(false,"/");

    $email = $pass = "";
    $error = [];

    if($_SERVER["REQUEST_METHOD"]==='POST' && isset($_POST['email'])) 
    {
        if(empty($_POST['email']))
            $error["email"]="Veuillez entrer un email";
        else
            $email = trim($_POST["email"]);

        if(empty($_POST["password"]))
            $error["password"] = "Veuillez entrer votre mot de passe";
        else
            $pass = trim($_POST["password"]);

        if(empty($error))
        {
            //Je regarde si j'ai un utilisateur qui correspond a l'email
            $user = getOneUserByEmail($email);
            //si oui
            if($user)
            {
                if(password_verify($pass,$user["password_hash"]))
                {
                    //Tout est bon on sauvegardes les infos pour toutes les pages 
                    $_SESSION["logged"] = true;
                    $_SESSION["username"] = $user["username"];
                    $_SESSION["email"] = $user["email"];
                    $_SESSION["id"] = $user["id"];
                    //et on redirige sur la page d'acceuil ou ailleur on verra plus tard pour la redirection
                    header("Location:/"); 
                    exit;
                }
                else
                {
                    $error["login"] = "Email ou mot de passe incorrect (password)" ;
                }
            }
            else
            {
                $error["login"] = "Email ou mot de passe incorrect (login)" ;
            }

        }
    };

    require __DIR__ ."/../View/connexion-inscription/connexion.php";
}

//On va egalement gerer la deconnecion ici 

function deconnexion() 
{
    shouldBeLogged(true,"/");

    unset($_SESSION);
    session_destroy();
    setcookie("PHPSESSID","", time() -3600);
    header("refresh: 1;url=/");
    require __DIR__ ."/../View/connexion-inscription/deconnexion.php";

}
?>