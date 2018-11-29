<?php

namespace common\chat_php_ws;

use common\models\tables\Chat;
use Yii;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

require "../../vendor/autoload.php";


$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    8080
);

$server->run();
