<?php

namespace webignition\BasilModel\Action;

use webignition\BasilModel\Identifier\IdentifierInterface;
use webignition\BasilModel\IdentifierContainerTrait;

class InteractionAction extends AbstractAction implements InteractionActionInterface
{
    use IdentifierContainerTrait;

    public function __construct(string $actionString, string $type, ?IdentifierInterface $identifier, string $arguments)
    {
        parent::__construct($actionString, $type, $arguments, true);

        $this->identifier = $identifier;
    }
}
