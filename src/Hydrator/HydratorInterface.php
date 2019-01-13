<?php

declare(strict_types=1);

namespace Skeleton\Hydrator;

interface HydratorInterface
{
    public function hydrate(array $data): object;

    public function toArray(object $object): array;
}
