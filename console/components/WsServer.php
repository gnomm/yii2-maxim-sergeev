<?php

namespace console\components;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class WsServer implements MessageComponentInterface
{
    protected $clients;

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
        echo "message {$msg} from {$from->resourceId}\n";

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