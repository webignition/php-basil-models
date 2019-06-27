<?php

namespace webignition\BasilModel\Action;

use webignition\BasilModel\Identifier\IdentifierInterface;

interface InteractionActionInterface extends ActionInterface
{
    public function getIdentifier(): ?IdentifierInterface;
}
