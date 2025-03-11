<?php

namespace App;

readonly class DataDto
{
    public function __construct(
        public ?int $id,
        public ?string $name,
        public ?string $props,
    ) {
    }
}
