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
            return $expectedOutput;
        });

        static::assertEquals($expectedOutput, $actual);
    }
}
