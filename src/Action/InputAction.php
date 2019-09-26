<?php

namespace webignition\BasilModel\Action;

use webignition\BasilModel\Identifier\IdentifierInterface;
use webignition\BasilModel\Value\ExpectableValueInterface;

class InputAction extends InteractionAction implements InputActionInterface
{
    private $value;

    public function __construct(
        string $actionString,
        IdentifierInterface $identifier,
        ExpectableValueInterface $value,
        string $arguments
    ) {
        parent::__construct($actionString, ActionTypes::SET, $identifier, $arguments);

        $this->value = $value;
    }

    public function getValue(): ExpectableValueInterface
    {
        return $this->value;
    }

    public function withValue(ExpectableValueInterface $value): InputActionInterface
    {
        $new = clone $this;
        $new->value = $value;

        return $new;
    }
}
