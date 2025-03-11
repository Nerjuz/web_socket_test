<?php

namespace App;

interface DataStorageServiceInterface
{
    public function save(string $data): void;
}
