<?php 

require __DIR__ . "./services/_pdo.php";

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
    $sql = $pdo->prepare("INSERT INTO users(username, email, password) VALUES(?, ?, ?)");
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
