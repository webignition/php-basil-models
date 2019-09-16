<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Exception\InvalidActionIdentifierException;

class ActionIdentifier extends WrappedIdentifier implements ActionIdentifierInterface
{
    /**
     * @return ElementIdentifierInterface|ReferenceIdentifierInterface
     *
     * @throws InvalidActionIdentifierException
     */
    public function getActionIdentifier()
    {
        $identifier = $this->getWrappedIdentifier();

        if ($identifier instanceof ElementIdentifierInterface) {
            return $identifier;
        }

        if ($identifier instanceof ReferenceIdentifierInterface &&
            ReferenceIdentifierTypes::ELEMENT_REFERENCE === $identifier->getType()) {
            return $identifier;
        }

        throw new InvalidActionIdentifierException($identifier);
    }
}
