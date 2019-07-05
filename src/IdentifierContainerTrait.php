<?php

namespace webignition\BasilModel;

use webignition\BasilModel\Identifier\IdentifierInterface;

trait IdentifierContainerTrait
{
    private $identifier;

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
