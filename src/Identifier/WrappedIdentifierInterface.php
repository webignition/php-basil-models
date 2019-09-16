<?php

namespace webignition\BasilModel\Identifier;

interface WrappedIdentifierInterface extends IdentifierInterface
{
    public function getWrappedIdentifier(): IdentifierInterface;
}
