<?php

namespace App;

readonly class DataDtoFactory
{
    /**
     * @param array{id: ?int,name: ?string,props: ?string} $data
     */
    public static function create(array $data): DataDto
    {
        $id = $data['id'] ?? null;
        $name = $data['name'] ?? null;
        $props = $data['props'] ?? null;

        return new DataDto($id, $name, $props);
    }
}
