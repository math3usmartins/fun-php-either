<?php

declare(strict_types=1);

namespace Functional;

/**
 * @template T
 */
abstract class Either
{
    /**
     * @param T $value
     */
    protected function __construct(protected $value)
    {
    }

    /**
     * @return T
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @return Either<T>
     */
    abstract public function flatMap(callable $f): self;

    abstract public function map(callable $f): self;

    abstract public function mapLeft(callable $f): self;

    /**
     * @template A
     *
     * @return T|A
     */
    abstract public function getOrElse(callable $f);
}
