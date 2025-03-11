<?php

namespace Tests;

use App\DataDto;
use App\DataDtoFactory;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

class DataDtoFactoryTest extends TestCase
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
    public function test_create_dto_and_verify_assigned_data(array $data): void
    {

        $dto = DataDtoFactory::create($data);

        $this->assertInstanceOf(DataDto::class, $dto);

        $this->assertSame($data['id'], $dto->id);
        $this->assertSame($data['name'], $dto->name);
        $this->assertSame($data['props'], $dto->props);

    }
}