<?php

declare(strict_types=1);

namespace Functional\Either;

final class UnexpectedResult
{
    private string $message;

    private $unexpectedResult;

    public function __construct(
        string $message,
        $unexpectedResult
    ) {
        $this->message = $message;
        $this->unexpectedResult = $unexpectedResult;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getUnexpectedResult()
    {
        return $this->unexpectedResult;
    }
}
