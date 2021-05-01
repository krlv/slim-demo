<?php

declare(strict_types=1);

namespace Demo\Infrastructure\Persistence\Hydrator;

interface HydratorInterface
{
    public const DATE_FORMAT = 'Y-m-d H:i:s';

    public function hydrate(array $data): object;

    public function toArray(object $object): array;

    public function assignId(int $id, object $object): void;
}
