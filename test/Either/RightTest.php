<?php

declare(strict_types=1);

namespace Functional\Either;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class RightTest extends TestCase
{
    public function testMap(): void
    {
        $givenInput = 'this is the input value';
        $either = Right::fromValue($givenInput);

        self::assertEquals($givenInput, $either->value());

        $expectedOutput = 'value returned from closure';

        $actual = $either->map(static fn (): Right => Right::fromValue($expectedOutput));

        self::assertInstanceOf(Right::class, $actual);
        self::assertEquals($expectedOutput, $actual->value());
    }

    public function testMapLeft(): void
    {
        $givenInput = 'this is the input value';
        $either = Right::fromValue($givenInput);

        self::assertEquals($givenInput, $either->value());

        $actual = $either->mapLeft(static fn (): string => 'something else which should NOT be returned as value');

        self::assertInstanceOf(Right::class, $actual);
        self::assertEquals(
            $givenInput,
            $actual->value()
        );
    }

    public function testMapLeftAndRight(): void
    {
        $givenInput = 'this is the input value';
        $either = Right::fromValue($givenInput);

        self::assertEquals($givenInput, $either->value());

        $expectedOutput = 'something else that should be the final result';

        $actual = $either
            ->mapLeft(static fn (): string => 'something else which should NOT be returned as value')
            ->map(static fn (): Right => Right::fromValue($expectedOutput));

        self::assertInstanceOf(Right::class, $actual);
        self::assertEquals(
            $expectedOutput,
            $actual->value()
        );
    }

    public function testUnexpectedResult(): void
    {
        $givenInput = 'this is the input value';
        $either = Right::fromValue($givenInput);

        self::assertEquals($givenInput, $either->value());

        $unexpectedResult = 'this is just a string that should be wrapped using Right::fromValue()';

        $actual = $either->map(static fn (): string => $unexpectedResult);

        $actualValue = $actual->value();
        self::assertInstanceOf(UnexpectedResult::class, $actualValue);

        /* @var UnexpectedResult $actualValue */
        self::assertEquals(
            'Right::map() must return an instance of Either<T>',
            $actualValue->getMessage()
        );

        self::assertEquals($unexpectedResult, $actualValue->getUnexpectedResult());
    }

    public function testGetOrElse(): void
    {
        $givenInput = 'this is the input value';
        $either = Right::fromValue($givenInput);

        self::assertEquals($givenInput, $either->value());

        $expectedOutput = 'value returned from closure';

        $actual = $either
            ->map(static fn (): Right => Right::fromValue($expectedOutput))
            ->getOrElse(static fn (): string => 'this should NOT be returned');

        self::assertEquals($expectedOutput, $actual);
    }

    public function testFlatMap(): void
    {
        $givenInput = 'this is the input value';
        $either = Right::fromValue(
            Right::fromValue($givenInput)
        );

        $expectedOutput = 'value returned from closure';

        $actual = $either->flatMap(static fn (): Right => Right::fromValue($expectedOutput));

        self::assertEquals(
            Right::fromValue($expectedOutput),
            $actual
        );
    }

    public function testFlatMap3Levels(): void
    {
        $givenInput = 'this is the input value';
        $either = Right::fromValue(
            Right::fromValue(
                Right::fromValue($givenInput)
            )
        );

        $expectedOutput = 'value returned from closure';

        $actual = $either->flatMap(static fn (): Right => Right::fromValue($expectedOutput));

        self::assertEquals(
            Right::fromValue($expectedOutput),
            $actual
        );
    }
}
