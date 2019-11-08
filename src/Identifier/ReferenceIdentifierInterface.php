<?php

declare(strict_types=1);

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\ValueInterface;

interface ReferenceIdentifierInterface extends IdentifierInterface
{
    public function getValue(): ValueInterface;
    public function getType(): string;
}
