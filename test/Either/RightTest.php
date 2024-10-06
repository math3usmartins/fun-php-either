<?php

namespace Functional\Either;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class RightTest extends TestCase
{
    public function testMap()
    {
        $givenInput = 'this is the input value';
        $either = Right::fromValue($givenInput);

        static::assertEquals($givenInput, $either->value());

        $expectedOutput = 'value returned from closure';

        $actual = $either->map(function () use ($expectedOutput) {
            return Right::fromValue($expectedOutput);
        });

        static::assertInstanceOf(Right::class, $actual);
        static::assertEquals($expectedOutput, $actual->value());
    }

    public function testMapLeft()
    {
        $givenInput = 'this is the input value';
        $either = Right::fromValue($givenInput);

        static::assertEquals($givenInput, $either->value());

        $actual = $either->mapLeft(function () {
            return 'something else which should NOT be returned as value';
        });

        static::assertInstanceOf(Right::class, $actual);
        static::assertEquals(
            $givenInput,
            $actual->value()
        );
    }

    public function testMapLeftAndRight()
    {
        $givenInput = 'this is the input value';
        $either = Right::fromValue($givenInput);

        static::assertEquals($givenInput, $either->value());

        $expectedOutput = 'something else that should be the final result';

        $actual = $either
            ->mapLeft(function () {
                return 'something else which should NOT be returned as value';
            })->map(function () use ($expectedOutput) {
                return Right::fromValue($expectedOutput);
            });

        static::assertInstanceOf(Right::class, $actual);
        static::assertEquals(
            $expectedOutput,
            $actual->value()
        );
    }
}
