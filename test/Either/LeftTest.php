<?php

namespace Functional\Either;

use PHPUnit\Framework\TestCase;

final class LeftTest extends TestCase
{
    public function test_map()
    {
        $givenInput = 'something went wrong';
        $either = Left::fromValue($givenInput);

        self::assertEquals($givenInput, $either->value());

        $actual = $either->map(function () {
            return 'something else which should NOT be returned as value';
        });

        self::assertEquals(
            new Left($givenInput),
            $actual
        );

        self::assertEquals($givenInput, $actual->value());
    }
}
