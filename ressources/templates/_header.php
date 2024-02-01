<?php require_once __DIR__ ."/../../services/_shouldBeLogged.php"?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The outed</title>
    <link rel="stylesheet" href="/style.css">
    <script src="/main.js" defer></script>
    <script src="/script/script.js" defer></script>
    <script>
        const user = "<?php echo $_SESSION["username"]??"" ?>"
    </script>
    
</head>
<header>



    <nav class="destop">
        <a href="#" class="nav-icon" aria-label="visit homepage" aria-current="page">
            <img src="./../../ressources/photos/logo.png" alt="logo">
            <span id="titreLogo">The Outed</span>
        </a>

        <div class="main-nav-link">
            <button class="hamburger" type="button" aria-label="toggle-nav" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="navlinks-container">
                <a href="/"
                aria-current="page">Notre histoire</a>
                <a href="/TerrainDeJeu">Terrain de jeux</a>
                <a href="/Rejoindre">Rejoingnez nous</a>
                <a href="#">Blog</a>
                
                    <?php if(!isLogged()){?>
                            <a id="connexionLink" href="/Connexion">Connexion</a>
                    <?php }else{ ?>
                            <a id="connexionLink" href="/Deconnexion">Deconnexion</a>
                            <a id="connexionLink" href="/Chat">Chat</a>
                    <?php }?>
                                                    
                    <?php if(!isLogged()){?>
                    <a id="connexionLink" href="/Inscription">Inscription</a>
                    
                    <?php }?>

                <strong> 
                    <?php 
                        if (isLogged()) {
                            echo "Bonjour " . $_SESSION["username"];
                        } else {
                            echo "";
                        }
                    ?>
                </strong>

            </div>
        </div>
    </nav>  
</header>
<body>
    <div class="main">
    <h1><?=$title??"default"?></h1>
