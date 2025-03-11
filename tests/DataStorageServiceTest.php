<?php

namespace Tests;

use App\DataStorageService;
use App\RepositoryInterface;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

class DataStorageServiceTest extends TestCase {
    #[TestWith(['{"id":1,"name":"name","props":"{a:1}"}'])]
    #[TestWith(['{"another":"value"}'])]
    #[TestWith(['{}'])]
    public function test_save_data_with_service(string $jsonData): void
    {

        $repository = $this->createMock(RepositoryInterface::class);
        $repository->expects($this->once())->method('save');

        $service = new DataStorageService($repository);
        $service->save($jsonData);

    }
}