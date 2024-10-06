<?php

declare(strict_types=1);

namespace Functional\Either;

use Functional\Either;
use Override;

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

    #[Override]
    public function map(callable $f): Either
    {
        return $this;
    }

    #[Override]
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
    #[Override]
    public function getOrElse(callable $f)
    {
        return $f($this);
    }

    #[Override]
    public function flatMap(callable $f): Either
    {
        return $this;
    }
}
