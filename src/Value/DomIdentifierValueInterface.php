<?php

declare(strict_types=1);

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Identifier\DomIdentifierInterface;

interface DomIdentifierValueInterface extends ValueInterface
{
    public function getIdentifier(): DomIdentifierInterface;
}
