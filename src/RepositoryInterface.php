<?php

namespace App;

interface RepositoryInterface
{
    public function save(DataDto $data): void;
}
