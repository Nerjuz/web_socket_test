<?php

require_once 'bootstrap.php';

use App\DataRepository;
use App\DataStorageService;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Socket;

sleep(10); // wait for postgres container

$dbConnection = new PDO('pgsql:host=postgres;dbname=postgres', 'changeuser', 'changepassword');
$repository = new DataRepository($dbConnection);
$dataService = new DataStorageService($repository);

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Socket($dataService)
        )
    ),
    8080
);

$server->run();