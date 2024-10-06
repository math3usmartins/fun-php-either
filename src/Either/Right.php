<?php

namespace Functional\Either;

use Functional\Either;

/**
 * @template T
 * @extends Either<T>
 */
class Right extends Either
{
    /**
     * @template V
     *
     * @param V $value
     */
    public static function fromValue($value)
    {
        return new static($value);
    }

    /**
     * @return Either
     */
    public function map(callable $f)
    {
        $result = $f($this);

        if ($result instanceof Either) {
            return $result;
        }

        return Left::fromValue(
            new UnexpectedResult(
                'Right::map() must return an instance of Either<T>',
                $result
            )
        );
    }

    /**
     * @return Either
     */
    public function mapLeft(callable $f)
    {
        return $this;
    }
}
