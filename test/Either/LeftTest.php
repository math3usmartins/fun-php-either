<?php

namespace Functional\Either;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class LeftTest extends TestCase
{
    public function testMap()
    {
        $givenInput = 'something went wrong';
        $either = Left::fromValue($givenInput);

        static::assertEquals($givenInput, $either->value());

        $actual = $either->map(function () {
            return 'something else which should NOT be returned as value';
        });

        static::assertEquals(
            new Left($givenInput),
            $actual
        );

        static::assertEquals($givenInput, $actual->value());
    }

    public function testMapLeft()
    {
        $givenInput = 'something went wrong';
        $either = Left::fromValue($givenInput);

        static::assertEquals($givenInput, $either->value());

        $expectedOutput = 'something else that should be returned as the final value';

        $actual = $either->mapLeft(function () use ($expectedOutput) {
            return Left::fromValue($expectedOutput);
        });

        static::assertInstanceOf(Left::class, $actual);
        static::assertEquals(
            $expectedOutput,
            $actual->value()
        );
    }

    public function testMapLeftAndRight()
    {
        $givenInput = 'something went wrong';
        $either = Left::fromValue($givenInput);

        static::assertEquals($givenInput, $either->value());

        $expectedOutput = 'something else that should be returned as the final value';

        $actual = $either
            ->mapLeft(function () use ($expectedOutput) {
                return Left::fromValue($expectedOutput);
            })->map(function () {
                return 'something else which should NOT be returned as value';
            });

        static::assertInstanceOf(Left::class, $actual);
        static::assertEquals(
            $expectedOutput,
            $actual->value()
        );
    }
}
