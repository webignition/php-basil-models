<?php

namespace webignition\BasilModel\Action;

use webignition\BasilModel\Identifier\IdentifierInterface;
use webignition\BasilModel\Value\ValueInterface;
use webignition\BasilModel\ValueContainerInterface;
use webignition\BasilModel\ValueContainerTrait;

class InputAction extends InteractionAction implements InputActionInterface, ValueContainerInterface
{
    use ValueContainerTrait;

    public function __construct(
        string $actionString,
        ?IdentifierInterface $identifier,
        ?ValueInterface $value,
        string $arguments
    ) {
        parent::__construct($actionString, ActionTypes::SET, $identifier, $arguments);

        $this->value = $value;
    }
}
