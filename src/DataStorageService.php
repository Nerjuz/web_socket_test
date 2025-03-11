<?php

namespace App;

class DataStorageService implements DataStorageServiceInterface
{
    public function __construct(
        public RepositoryInterface $dataRepository
    )
    {
    }

    public function save(string $data): void
    {
        /** @var array{id: ?int,name: string,props: string} $requestData */
        $requestData = json_decode($data, true);

        $this->dataRepository->save(DataDtoFactory::create($requestData));
    }
}
