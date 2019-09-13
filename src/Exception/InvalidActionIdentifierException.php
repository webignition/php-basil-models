<?php

namespace webignition\BasilModel\Exception;

use webignition\BasilModel\Identifier\IdentifierInterface;

class InvalidActionIdentifierException extends \Exception
{
    private $identifier;

    public function __construct(IdentifierInterface $identifier)
    {
        parent::__construct('Invalid action identifier "' . (string) $identifier . '"');

        $this->identifier = $identifier;
    }

    public function getIdentifier(): IdentifierInterface
    {
        return $this->identifier;
    }
}
