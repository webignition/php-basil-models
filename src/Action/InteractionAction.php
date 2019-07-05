<?php

namespace webignition\BasilModel\Action;

use webignition\BasilModel\Identifier\IdentifierInterface;

class InteractionAction extends AbstractAction implements InteractionActionInterface
{
    private $identifier;

    public function __construct(string $type, ?IdentifierInterface $identifier, string $arguments)
    {
        parent::__construct($type, $arguments, true);

        $this->identifier = $identifier;
    }

    public function getIdentifier(): ?IdentifierInterface
    {
        return $this->identifier;
    }

    public function withIdentifier(IdentifierInterface $identifier): IdentifierContainerInterface
    {
        $new = clone $this;
        $new->identifier = $identifier;

        return $new;
    }
}
