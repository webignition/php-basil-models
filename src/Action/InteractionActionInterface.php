<?php

namespace webignition\BasilModel\Action;

use webignition\BasilModel\Identifier\ActionIdentifierInterface;

interface InteractionActionInterface extends ActionInterface
{
    public function getIdentifier(): ActionIdentifierInterface;
    public function withIdentifier(ActionIdentifierInterface $identifier): InteractionActionInterface;
}
