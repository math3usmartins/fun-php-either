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
            Left::fromValue($givenInput),
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

    public function testUnexpectedResult()
    {
        $givenInput = 'something went wrong';
        $either = Left::fromValue($givenInput);

        static::assertEquals($givenInput, $either->value());

        $unexpectedResult = 'this is just a string that should be wrapped using Left::fromValue()';

        $actual = $either->mapLeft(function () use ($unexpectedResult) {
            return $unexpectedResult;
        });

        $actualValue = $actual->value();
        static::assertInstanceOf(UnexpectedResult::class, $actualValue);

        /** @var UnexpectedResult $actualValue */
        static::assertEquals(
            'Left::mapLeft() must return an instance of Either<T>',
            $actualValue->getMessage()
        );

        static::assertEquals($unexpectedResult, $actualValue->getUnexpectedResult());
    }

    public function testGetOrElse()
    {
        $givenInput = 'something went wrong';
        $either = Left::fromValue($givenInput);

        static::assertEquals($givenInput, $either->value());

        $expectedOutput = 'something else that should be returned as the final value';

        $actual = $either->getOrElse(function () use ($expectedOutput) {
            return $expectedOutput;
        });

        static::assertEquals($expectedOutput, $actual);
    }

    public function testFlatMap()
    {
        $givenInput = 'something went wrong';
        $either = Left::fromValue(
            Left::fromValue($givenInput)
        );

        $actual = $either->flatMap(function () {
            return 'something else which should NOT be returned as value';
        });

        static::assertEquals(
            $either,
            $actual
        );
    }
}
