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

    /**
     * @param array|ActionInterface[] $actions
     *
     * @return StepInterface
     */
    public function withPrependedActions(array $actions): StepInterface;

    /**
     * @param array|AssertionInterface[] $assertions
     *
     * @return StepInterface
     */
    public function withPrependedAssertions(array $assertions): StepInterface;

    /**
     * @param ActionInterface[] $actions
     *
     * @return StepInterface
     */
    public function withActions(array $actions): StepInterface;

    /**
     * @param AssertionInterface[] $assertions
     *
     * @return StepInterface
     */
    public function withAssertions(array $assertions): StepInterface;
}
