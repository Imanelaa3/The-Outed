<?php
namespace MESS;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

require __DIR__ . "/vendor/autoload.php";


class Chat implements MessageComponentInterface
{
    protected $clients;
    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }
    public function OnOpen(ConnectionInterface $conn ){
        $this->clients->attach($conn);
        echo "Nouvelle connexion !({$conn->resourceId})\n";
    }
    public function OnMessage(ConnectionInterface $from, $msg){
        $numRecv = count($this->clients) - 1;
        $shouldS =$numRecv<=1?"":"s";
        echo sprintf('Connexion %d envoi le message "%s" à %d autre%s connexion%s' . "\n"
        , $from->resourceId, $msg, $numRecv, $shouldS, $shouldS);
        foreach($this->clients as $client)
        {
            if($from != $client)
            {
                $client->send($msg);
            }
        }

    }


    public function OnClose(ConnectionInterface $conn){
        $this->clients->detach($conn);
        echo "connexion {$conn->resourceId} est déconnecté. \n";
    }


    public function OnError(ConnectionInterface $conn, \Exception $e){
        echo " Une erreur a eu lieu: {$e->getMessage()}\n";
        $conn->close();
    }

}

?>