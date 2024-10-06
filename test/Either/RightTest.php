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

    public function testUnexpectedResult()
    {
        $givenInput = 'this is the input value';
        $either = Right::fromValue($givenInput);

        static::assertEquals($givenInput, $either->value());

        $unexpectedResult = 'this is just a string that should be wrapped using Right::fromValue()';

        $actual = $either->map(function () use ($unexpectedResult) {
            return $unexpectedResult;
        });

        $actualValue = $actual->value();
        static::assertInstanceOf(UnexpectedResult::class, $actualValue);

        /** @var UnexpectedResult $actualValue */
        static::assertEquals(
            'Right::map() must return an instance of Either<T>',
            $actualValue->getMessage()
        );

        static::assertEquals($unexpectedResult, $actualValue->getUnexpectedResult());
    }

    public function testGetOrElse()
    {
        $givenInput = 'this is the input value';
        $either = Right::fromValue($givenInput);

        static::assertEquals($givenInput, $either->value());

        $expectedOutput = 'value returned from closure';

        $actual = $either->map(function () use ($expectedOutput) {
            return Right::fromValue($expectedOutput);
        })->getOrElse(function () {
            return 'this should NOT be returned';
        });

        static::assertEquals($expectedOutput, $actual);
    }

    public function testFlatMap()
    {
        $givenInput = 'this is the input value';
        $either = Right::fromValue(
            Right::fromValue($givenInput)
        );

        $expectedOutput = 'value returned from closure';

        $actual = $either->flatMap(function () use ($expectedOutput) {
            return Right::fromValue($expectedOutput);
        });

        static::assertEquals(
            Right::fromValue($expectedOutput),
            $actual
        );
    }

    public function testFlatMap3Levels()
    {
        $givenInput = 'this is the input value';
        $either = Right::fromValue(
            Right::fromValue(
                Right::fromValue($givenInput)
            )
        );

        $expectedOutput = 'value returned from closure';

        $actual = $either->flatMap(function () use ($expectedOutput) {
            return Right::fromValue($expectedOutput);
        });

        static::assertEquals(
            Right::fromValue($expectedOutput),
            $actual
        );
    }
}
