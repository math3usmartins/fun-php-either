<?php

namespace Functional\Either;

use Functional\Either;

/**
 * @template T
 * @extends Either<T>
 */
class Left extends Either
{
    /**
     * @template V
     * @param V $value
     */
    public static function fromValue($value)
    {
        return new static($value);
    }

    public function map(callable $f)
    {
        return $this;
    }
}
