<?php

declare(strict_types=1);

namespace Functional\Either;

/**
 * @template T
 */
final readonly class UnexpectedResult
{
    /**
     * @param T $unexpectedResult
     */
    public function __construct(
        private string $message,
        private mixed $unexpectedResult
    ) {
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getUnexpectedResult(): mixed
    {
        return $this->unexpectedResult;
    }
}
