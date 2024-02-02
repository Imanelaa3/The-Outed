<?php 

require __DIR__ ."/../../services/_pdo.php";
require __DIR__ ."/../Model/chatModel.php";

function usersConnected() 
{

    // J'appelle la fonction du modele pour recuperer les utilisateur connecté 
    $users = getUserByConnection();
    var_dump($users);
    // Afficher les utilisateurs connectés 
    echo "<h2>Utilisateurs Connectés</h2>";
    echo "<ul>";
    foreach ($users as $user) {
        echo "<li>" . $user['username'] . "</li>";
    }
        echo "</ul>";
}


