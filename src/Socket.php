<?php

namespace App;

use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use SplObjectStorage;

class Socket implements MessageComponentInterface
{
    // @phpstan-ignore-next-line missingType.generics
    protected SplObjectStorage $clients;

    public function __construct(readonly DataStorageServiceInterface $dataStorageService)
    {
        $this->clients = new SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn): void
    {
        $this->clients->attach($conn);
        // @phpstan-ignore-next-line encapsedStringPart.nonString
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg): void
    {

        $this->dataStorageService->save($msg);
        dump(json_decode($msg, true));

        $numRecv = count($this->clients) - 1;
        /** @var int $resourceId */
        $resourceId = $from->resourceId;
        echo sprintf(
            'Connection %d sending message "%s" to %d other connection%s' . "\n",
            $resourceId,
            $msg,
            $numRecv,
            $numRecv == 1 ? '' : 's'
        );

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // @phpstan-ignore-next-line method.notFound
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn): void
    {
        $this->clients->detach($conn);
        // @phpstan-ignore-next-line encapsedStringPart.nonString
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, Exception $e): void
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}