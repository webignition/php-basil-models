<?php

namespace webignition\BasilModel\Action;

use webignition\BasilModel\Identifier\IdentifierInterface;
use webignition\BasilModel\IdentifierContainerTrait;

class InteractionAction extends AbstractAction implements InteractionActionInterface
{
    use IdentifierContainerTrait;

    public function __construct(string $type, ?IdentifierInterface $identifier, string $arguments)
    {
        parent::__construct($type, $arguments, true);

        $this->identifier = $identifier;
    }
}
