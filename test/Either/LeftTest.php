<?php

declare(strict_types=1);

namespace Functional\Either;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class LeftTest extends TestCase
{
    public function testMap(): void
    {
        $givenInput = 'something went wrong';
        $either = Left::fromValue($givenInput);

        self::assertEquals($givenInput, $either->value());

        $actual = $either->map(static fn (): string => 'something else which should NOT be returned as value');

        self::assertEquals(
            Left::fromValue($givenInput),
            $actual
        );

        self::assertEquals($givenInput, $actual->value());
    }

    public function testMapLeft(): void
    {
        $givenInput = 'something went wrong';
        $either = Left::fromValue($givenInput);

        self::assertEquals($givenInput, $either->value());

        $expectedOutput = 'something else that should be returned as the final value';

        $actual = $either->mapLeft(static fn (): Left => Left::fromValue($expectedOutput));

        self::assertInstanceOf(Left::class, $actual);
        self::assertEquals(
            $expectedOutput,
            $actual->value()
        );
    }

    public function testMapLeftAndRight(): void
    {
        $givenInput = 'something went wrong';
        $either = Left::fromValue($givenInput);

        self::assertEquals($givenInput, $either->value());

        $expectedOutput = 'something else that should be returned as the final value';

        $actual = $either
            ->mapLeft(static fn (): Left => Left::fromValue($expectedOutput))->map(static fn (): string => 'something else which should NOT be returned as value');

        self::assertInstanceOf(Left::class, $actual);
        self::assertEquals(
            $expectedOutput,
            $actual->value()
        );
    }

    public function testUnexpectedResult(): void
    {
        $givenInput = 'something went wrong';
        $either = Left::fromValue($givenInput);

        self::assertEquals($givenInput, $either->value());

        $unexpectedResult = 'this is just a string that should be wrapped using Left::fromValue()';

        $actual = $either->mapLeft(static fn (): string => $unexpectedResult);

        $actualValue = $actual->value();
        self::assertInstanceOf(UnexpectedResult::class, $actualValue);

        /* @var UnexpectedResult $actualValue */
        self::assertEquals(
            'Left::mapLeft() must return an instance of Either<T>',
            $actualValue->getMessage()
        );

        self::assertEquals($unexpectedResult, $actualValue->getUnexpectedResult());
    }

    public function testGetOrElse(): void
    {
        $givenInput = 'something went wrong';
        $either = Left::fromValue($givenInput);

        self::assertEquals($givenInput, $either->value());

        $expectedOutput = 'something else that should be returned as the final value';

        $actual = $either->getOrElse(static fn (): string => $expectedOutput);

        self::assertEquals($expectedOutput, $actual);
    }

    public function testFlatMap(): void
    {
        $givenInput = 'something went wrong';
        $either = Left::fromValue(
            Left::fromValue($givenInput)
        );

        $actual = $either->flatMap(static fn (): string => 'something else which should NOT be returned as value');

        self::assertEquals(
            $either,
            $actual
        );
    }
}
