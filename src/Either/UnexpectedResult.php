<?php

namespace Functional\Either;

final class UnexpectedResult
{
    /**
     * @var string
     */
    private $message;

    /**
     * @var mixed
     */
    private $unexpectedResult;

    public function __construct(
        $message,
        $unexpectedResult
    ) {
        $this->message = $message;
        $this->unexpectedResult = $unexpectedResult;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getUnexpectedResult()
    {
        return $this->unexpectedResult;
    }
}
