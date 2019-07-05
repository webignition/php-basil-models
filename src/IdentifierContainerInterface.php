<?php

namespace webignition\BasilModel;

use webignition\BasilModel\Identifier\IdentifierInterface;

interface IdentifierContainerInterface
{
    public function getIdentifier(): ?IdentifierInterface;
    public function withIdentifier(IdentifierInterface $identifier): IdentifierContainerInterface;
}
