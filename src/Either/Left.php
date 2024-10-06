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
        return $this;
    }

    /**
     * @return Either
     */
    public function mapLeft(callable $f)
    {
        $result = $f($this);

        if ($result instanceof Either) {
            return $result;
        }

        return self::fromValue(
            new UnexpectedResult(
                'Left::mapLeft() must return an instance of Either<T>',
                $result
            )
        );
    }

    /**
     * @template A
     *
     * @return T|A
     */
    public function getOrElse(callable $f)
    {
        return $f($this);
    }

    /**
     * @return Either<T>
     */
    public function flatMap(callable $f)
    {
        return $this;
    }
}
