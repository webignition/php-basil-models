<?php

namespace webignition\BasilModel\Exception;

use webignition\BasilModel\Value\ValueInterface;

abstract class AbstractInvalidAssertionValueException extends \Exception
{
    private $value;

    public function __construct(string $message, ValueInterface $value)
    {
        parent::__construct($message);

        $this->value = $value;
    }

    public function getValue(): ValueInterface
    {
        return $this->value;
    }
}
