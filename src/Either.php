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
    private $value;

    /**
     * @param T $value
     */
    public function __construct($value)
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
