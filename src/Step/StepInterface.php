<?php

namespace webignition\BasilModel\Step;

use webignition\BasilModel\Action\ActionInterface;
use webignition\BasilModel\Assertion\AssertionInterface;
use webignition\BasilModel\DataSet\DataSetInterface;
use webignition\BasilModel\Identifier\IdentifierInterface;

interface StepInterface
{
    /**
     * @return ActionInterface[]
     */
    public function getActions(): array;

    /**
     * @return AssertionInterface[]
     */
    public function getAssertions() :array;

    /**
     * @return DataSetInterface[]
     */
    public function getDataSets(): array;

    /**
     * @return IdentifierInterface[]
     */
    public function getElementIdentifiers(): array;

    /**
     * @param DataSetInterface[] $dataSets
     *
     * @return StepInterface
     */
    public function withDataSets(array $dataSets): StepInterface;

    /**
     * @param IdentifierInterface[] $elementIdentifiers
     *
     * @return StepInterface
     */
    public function withElementIdentifiers(array $elementIdentifiers): StepInterface;

    public function prependActionsFrom(StepInterface $step): StepInterface;
    public function prependAssertionsFrom(StepInterface $step): StepInterface;
}
