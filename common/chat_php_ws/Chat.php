<?php

namespace common\chat_php_ws;

use Yii;
use common\models\User;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

require "../../vendor/autoload.php";

class Chat implements MessageComponentInterface
{
    protected $clients;
    protected $user;

    /**
     * Chat constructor.
     */
    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }


    function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection: {$conn->resourceId}\n";
    }


    function onMessage(ConnectionInterface $from, $msg)
    {
        $chat = new \common\models\tables\Chat();

        $chat->save();

//        Yii::$app->user->identity->username;



//        echo "message {$msg} from {$from->} \n";
//        echo "message {$msg} from {$from->resourceId} \n";


        foreach ($this->clients as $client) {
            $client->send($msg);
        }
    }


    function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "user {$conn->resourceId} disconnect \n";
    }

    function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();
        echo "conn {$conn->resourceId} closed with error \n";
    }


}