<?php

namespace Functional\Either;

use PHPUnit\Framework\TestCase;

final class RightTest extends TestCase
{
    public function test_map()
    {
        $givenInput = 'this is the input value';
        $either = Right::fromValue($givenInput);

        self::assertEquals($givenInput, $either->value());

        $expectedOutput = 'value returned from closure';

        $actual = $either->map(function () use ($expectedOutput) {
            return $expectedOutput;
        });

        self::assertEquals($expectedOutput, $actual);
    }
}
