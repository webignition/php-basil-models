<?php

declare(strict_types=1);

namespace webignition\BasilModel\Action;

use webignition\BasilModel\Identifier\IdentifierInterface;

interface InteractionActionInterface extends ActionInterface
{
    public function getIdentifier(): IdentifierInterface;
    public function withIdentifier(IdentifierInterface $identifier): InteractionActionInterface;
}
