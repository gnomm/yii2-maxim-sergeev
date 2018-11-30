<?php

namespace console\components;

use common\models\tables\Chat;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class WsServer implements MessageComponentInterface
{
    protected $clients = [

    ];

//    /**
//     * Chat constructor.
//     */
//    public function __construct()
//    {
//        $this->clients = new \SplObjectStorage();
//    }


    function onOpen(ConnectionInterface $conn)
    {
        $queryString = $conn->httpRequest->getUri()->getQuery();
        $channel = explode("=", $queryString)[1];
        echo $channel;
//        var_dump( $channel); exit;
//        var_dump($queryString);
        $this->clients[$channel][$conn->resourceId] = $conn;
        echo " - New connection: {$conn->resourceId}\n";
    }


    function onMessage(ConnectionInterface $from, $data)
    {
//        echo "message {$data} from {$from->resourceId}\n";
        $data = json_decode($data,true);
        $channel = $data['channel'];
        (new Chat($data))->save();
//        try {
//            (new Chat())->save();
//        } catch (\Exception $e) {
//            var_dump($e->getMessage());
//        }

        foreach ($this->clients[$channel] as $client) {
            $client->send($data['message']);
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