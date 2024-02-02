<?php 
 ;
require __DIR__.'/../../ressources/templates/_header.php';
require __DIR__.'/../Controller/chatController.php';
$title = "Chat";


?>
<div>
    <div class="blockChat">
            <pre class="chat"></pre>
            <div class="btnChat">
                <input type="text" id="message">
                <button id="sendMessage">Envoyer </button>
            </div>
    </div>
    <div class="chateur">
        <div class="chatteurList">
            <div><?php usersConnected()?></div>
        </div>
    </div>
</div>

