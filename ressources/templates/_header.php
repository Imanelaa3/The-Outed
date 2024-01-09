<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The outed</title>
    <link rel="stylesheet" href="/style.css">
    <script src="/main.js" defer></script>
    
</head>
<header>



    <nav class="destop">
        <a href="#" class="nav-icon" aria-label="visit homepage" aria-current="page">
            <img src="./../../ressources/photos/logo.png" alt="logo">
            <span>The Outed</span>
        </a>

        <div class="main-nav-link">
            <button class="hamburger" type="button" aria-label="toggle-nav" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="navlinks-container">
                <a href="/../../index.php"
                aria-current="page">Notre histoire</a>
                <a href="./MVC/View/TerrainDeJeu.php">Terrain de jeux</a>
                <a href="#">Rejoingnez nous</a>
                <a href="#">Blog</a>

            </div>
        </div>
    </nav>  
</header>
<body>
    <div class="main">
    <h1><?=$title??"default"?></h1>
