<?php 
if(session_status()===PHP_SESSION_NONE)
    session_start();
/**
 * Verifie si l'utilisateur est connecté et le redirige dans le cas contraire 
 *
 * @param boolean $logged true si l'utilisateur doit etre connecté et false si il ne doit pas etre connecté
 * @param string $redirect chemin de redirection
 * @return void 
 */
function shouldBeLogged(bool $logged = true,string $redirect = "/"):void 
{
    if($logged)
    {
        //Si la session expire, on la supprime
        if(isset($_SESSION["expire"]))
        {
            if(time()>($_SESSION["expire"]))
            {
                unset($_SESSION);
                session_destroy();
                setcookie("PHPSESSID","",time()-3600);
            }
            else
            {
                //Sinon ellee st renouveler pour une heure 
                $_SESSION["expire"] = time() + 3600;
            }

        }// Fin verification exterieur
        if(!isset($_SESSION["logged"]) || $_SESSION["logged"]!== true)
        {
            header("Location:$redirect");
            exit;
        }
    }
    else
    {
        //Si l'utilisateuir doit etre deconnecté pour accedé a la page alors on verifie si il est connecté et dans ce cas on le redirige
        if(isset($_SESSION["logged"]) && $_SESSION["logged"] == true )
        {
            header("Location:$redirect");
            exit;

        }
    }
}
