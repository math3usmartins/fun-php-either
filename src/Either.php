<?php

namespace Functional;

/**
 * @template T
 */
abstract class Either
{
    /**
     * @var T
     */
    protected $value;

    /**
     * @param T $value
     */
    protected function __construct($value)
    {
        $this->value = $value;
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
    abstract public function flatMap(callable $f);

    /**
     * @return Either
     */
    abstract public function map(callable $f);

    /**
     * @return Either
     */
    abstract public function mapLeft(callable $f);

    /**
     * @template A
     *
     * @return T|A
     */
    abstract public function getOrElse(callable $f);
}
