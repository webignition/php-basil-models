<?php

namespace webignition\BasilModel\Action;

use webignition\BasilModel\Identifier\IdentifierInterface;
use webignition\BasilModel\Value\ValueInterface;

class InputAction extends InteractionAction implements InputActionInterface
{
    private $value;

    public function __construct(?IdentifierInterface $identifier, ?ValueInterface $value, string $arguments)
    {
        parent::__construct(ActionTypes::SET, $identifier, $arguments);

        $this->value = $value;
    }

    public function getValue(): ?ValueInterface
    {
        return $this->value;
    }
}
