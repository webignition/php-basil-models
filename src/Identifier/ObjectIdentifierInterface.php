<?php

namespace webignition\BasilModel\Identifier;

interface ObjectIdentifierInterface extends IdentifierInterface
{
    public function getObjectName(): string;
    public function getObjectProperty(): string;
}
