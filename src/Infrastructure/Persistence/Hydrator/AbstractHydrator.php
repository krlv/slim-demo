<?php

declare(strict_types=1);

namespace Demo\Infrastructure\Persistence\Hydrator;

abstract class AbstractHydrator implements HydratorInterface
{
    /**
     * @param mixed $value
     *
     * @return $this
     */
    protected function setPrivateProperty(object $entity, string $property, $value): self
    {
        \Closure::bind(static function ($entity, $value) use ($property): void {
            $entity->$property = $value;
        }, null, $entity)->__invoke($entity, $value);

        return $this;
    }
}
