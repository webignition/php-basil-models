<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Exception\InvalidActionIdentifierException;

interface ActionIdentifierInterface extends IdentifierInterface, WrappedIdentifierInterface
{
    /**
     * @return ElementIdentifierInterface|ReferenceIdentifierInterface
     *
     * @throws InvalidActionIdentifierException
     */
    public function getActionIdentifier();
}
