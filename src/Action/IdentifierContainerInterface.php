<?php

namespace webignition\BasilModel\Action;

use webignition\BasilModel\Identifier\IdentifierInterface;

interface IdentifierContainerInterface extends ActionInterface
{
    public function getIdentifier(): ?IdentifierInterface;
    public function withIdentifier(IdentifierInterface $identifier): IdentifierContainerInterface;
}
