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
}
