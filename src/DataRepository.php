<?php

namespace App;

use PDO;

class DataRepository implements RepositoryInterface
{
    private const string TABLE_NAME = "web_socket_data";

    public function __construct(
        private PDO $db
    ) {
    }

    public function save(DataDto $data): void
    {
        $this->createTableIfNotExist();

        $dataToSave = (array) $data;
        unset($dataToSave['id']);

        $sql = sprintf("INSERT INTO %s (name, props) VALUES ( :name, :props)", self::TABLE_NAME);
        $stmt = $this->db->prepare($sql);

        $stmt->execute($dataToSave);
    }

    // this DB should be created during migration,
    // but I cut corners and put it here
    // and feel bad about this :D
    private function createTableIfNotExist(): void
    {
            $this->db->exec(
                sprintf(
                    "CREATE TABLE IF NOT EXISTS %s (
                                    id BIGSERIAL PRIMARY KEY,
                                    name VARCHAR(255),
                                    props TEXT
                            );",
                    self::TABLE_NAME
                )
            );
    }
}
