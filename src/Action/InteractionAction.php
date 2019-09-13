<?php

namespace webignition\BasilModel\Action;

use webignition\BasilModel\Identifier\ActionIdentifierInterface;

class InteractionAction extends AbstractAction implements InteractionActionInterface
{
    private $identifier;

    public function __construct(
        string $actionString,
        string $type,
        ActionIdentifierInterface $identifier,
        string $arguments
    ) {
        parent::__construct($actionString, $type, $arguments, true);

        $this->identifier = $identifier;
    }

    public function getIdentifier(): ActionIdentifierInterface
    {
        return $this->identifier;
    }

    public function withIdentifier(ActionIdentifierInterface $identifier): InteractionActionInterface
    {
        $new = clone $this;
        $new->identifier = $identifier;

        return $new;
    }
}
