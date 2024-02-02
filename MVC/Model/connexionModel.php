<?php 

require_once __DIR__ . "/../../services/_pdo.php";
/**
 * Recupere tous les utilisateurs 
 */
function getAllUsers():array 
{
    $pdo = connexionPDO();
    $sql = $pdo-> query("SELECT idUser, username FROM users");
    return $sql->fetchAll();
}
/**
 * Selection un utilisateur via son ID
 */
function getOneUserById($id)
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $sql->execute([$id]);
    return $sql->fetch();
}
/**
 * Selectionne un utilisateur via son email
 */
function getOneUserByEmail(string $email)
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $sql->execute([$email]);
    return $sql->fetch();
}






