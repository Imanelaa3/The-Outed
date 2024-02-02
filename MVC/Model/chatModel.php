<?php 
require_once __DIR__ . "/../../services/_pdo.php";


/**
 * Modifie le statut de connection si l'utilisateur est connecté (true) ou pas (false) 
 */
function isConnected(int $id)
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("UPDATE users SET statutConnexion = TRUE WHERE id = ?");
    $sql->execute([$id]);
    return $sql->fetch();
}

/**
 * Recupere les utilisateurs connecté 
 */
function getUserByConnection(): array|false
{
    $pdo = connexionPDO();
    $sql =$pdo->query( "SELECT * FROM users WHERE statutConnexion = TRUE");
    return $sql->fetchAll();

}