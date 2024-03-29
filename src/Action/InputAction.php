<?php

declare(strict_types=1);

namespace webignition\BasilModel\Action;

use webignition\BasilModel\Identifier\IdentifierInterface;
use webignition\BasilModel\Value\ValueInterface;

class InputAction extends InteractionAction implements InputActionInterface
{
    private $value;

    public function __construct(
        string $actionString,
        IdentifierInterface $identifier,
        ValueInterface $value,
        string $arguments
    ) {
        parent::__construct($actionString, ActionTypes::SET, $identifier, $arguments);

        $this->value = $value;
    }

    public function getValue(): ValueInterface
    {
        return $this->value;
    }

    public function withValue(ValueInterface $value): InputActionInterface
    {
        $new = clone $this;
        $new->value = $value;

        return $new;
    }
}
