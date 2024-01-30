<?php 

require __DIR__."/../../services/_shouldBeLogged.php";
require __DIR__."/../../services/_pdo.php";
/* require __DIR__."/Model/inscriptionModel.php";  */ 


/* ----------------DOIT ETRE DANS LE MODEL MAIS JE N'ARRIVE PAS A RELIER LE FICHIER inscriptionModel.php------------------- */
/**
 * Permet d'ajouter un nouvelle utilisateur a lorsqu'il s'inscrit
 *
 * @param string $us
 * @param string $em
 * @param string $pass
 * @return void
 */
function addUser(string $us, string $em, string $pass): void
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("INSERT INTO users(username, email, password_hash) VALUES(?, ?, ?)");
    $sql->execute([$us, $em, $pass]);
}


/**
 * Selectionne un utilisateur par son email.
 *
 * @param string $email
 * @return array|boolean
 */
function getOneUserByEmail(string $email): array|bool
{
    $pdo = connexionPDO();
    // "SELECT * FROM users WHERE email = $email"
    // Je prépare ma requête afin d'éviter une injection SQL
    $sql = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    // J'execute ma requête en lui donnant les paramètres dans le même ordre que les "?"
    $sql->execute([$email]);
    // Je récupère la première information trouvé.
    return $sql->fetch();
}


/* ---------------------------------------------------------------------------------------------------- */



/**
 * Gère ma page d'inscription
 *
 * @return void
 */
function inscription():void
{
    // Si l'utilisateur est connecté, on le redirige
    shouldBeLogged(false, "/");

    $username = $email = $password = "";
    $error = [];
    $regexPass = "/^(?=.*[!?@#$%^&*+-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{6,}$/";

    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['inscription']))
    {
        // Traitement username 
        if(empty($_POST["username"]))
        {
            $error["username"] = "Veuillez saisir un nom d'utilisateur";
        }
        else
        {
            $username = clean_data($_POST["username"]);
            if(!preg_match("/^[a-zA-Z' -]{2,25}$/", $username))
            {
                $error["username"] = "Veuillez saisir un nom d'utilisateur valide";
            }
        }
        // Traitement email
        if(empty($_POST["email"]))
        {
            $error["email"] = "Veuillez saisir un email";
        }
        else
        {
            $email = clean_data($_POST["email"]);
            /* 
                La fonction filter_var prendra en premeir argument
                la variable à filter, et en second une constante correspondant au filtre à appliquer.
                Il y a deux types de filtres
                    FILTER_SANITIZE_***
                    FILTER_VALIDATE_***
                Dans le premier cas, la valeur de retour sera la valeur de la variable filtré.
                Dans le second ce sera un boolean.
            */
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $error["email"] = "Veuillez saisir un email valide";
            }
           /*  $resultat = getOneUserByEmail($email);
            if($resultat)
            {
                $error["email"] = "Cet email est déjà enregistré";
            } */
        }
        // Traitement password
        if(empty($_POST["password"]))
        {
            $error["password"] = "Veuillez saisir un mot de passe";
        }
        else
        {
            $password = trim($_POST["password"]);
            if(!preg_match($regexPass, $password))
            {
                $error["password"] = "Veuillez saisir un mot de passe valide";
            }
            else
            {
                $password = password_hash($password, PASSWORD_DEFAULT);
            }
        }
        // Traitement vérification du mot de passe
        if(empty($_POST["passwordBis"]))
        {
            $error["passwordBis"] = "Veuillez saisir à nouveau votre mot de passe";
        }
        else if($_POST["passwordBis"] !== $_POST["password"])
        {
            $error["passwordBis"] = "Veuillez saisir le même mot de passe";
        }
        // Envoi des données :
        if(empty($error))
        {
            addUser($username, $email, $password);
            header("Location: /");
            exit;
        }
    }
    require __DIR__."/../view/connexion-inscription/inscription.php";
}


?>