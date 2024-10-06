<?php

declare(strict_types=1);

namespace Functional\Either;

use Functional\Either;

/**
 * @template T
 *
 * @extends Either<T>
 */
class Left extends Either
{
    /**
     * @template V
     *
     * @param V $value
     */
    public static function fromValue($value): self
    {
        return new static($value);
    }

    public function map(callable $f): Either
    {
        return $this;
    }

    public function mapLeft(callable $f): Either
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

    public function flatMap(callable $f): Either
    {
        return $this;
    }
}
