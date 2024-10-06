<?php

declare(strict_types=1);

namespace Functional\Either;

use Functional\Either;

/**
 * @template T
 *
 * @extends Either<T>
 */
class Right extends Either
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

    public function mapLeft(callable $f): Either
    {
        return $this;
    }

    /**
     * @template A
     *
     * @return T|A
     */
    public function getOrElse(callable $f)
    {
        return $this->value;
    }

    /**
     * @return Either<T>
     */
    public function flatMap(callable $f): Either
    {
        $value = $this->value;

        return $value instanceof self
            ? $value->map($f)
            : $this;
    }
}
