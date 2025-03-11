<?php

namespace Tests;

use App\DataDtoFactory;
use App\DataRepository;
use PDO;
use PDOStatement;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

class DataRepositoryTest extends TestCase
{
    #[TestWith([[
        'id' => null,
        'name' => null,
        'props' => null,
    ]])]
    #[TestWith([[
        'id' => 1,
        'name' => 'name',
        'props' => '{a:1}',
    ]])]
    #[TestWith([[]])]
    public function test_save_data_to_db(array $data): void
    {
        $statementMock = $this->createMock(PDOStatement::class);
        $statementMock->expects($this->once())->method('execute');

        $dbMock = $this->createMock(PDO::class);
        $dbMock->expects($this->once())->method('prepare')->willReturn($statementMock);

        $service = new DataRepository($dbMock);
        $service->save(DataDtoFactory::create($data));
    }
}