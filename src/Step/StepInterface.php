<?php

namespace webignition\BasilModel\Step;

use webignition\BasilModel\Action\ActionInterface;
use webignition\BasilModel\Assertion\AssertionInterface;
use webignition\BasilModel\DataSet\DataSetCollectionInterface;
use webignition\BasilModel\Identifier\IdentifierCollectionInterface;

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
     * @return DataSetCollectionInterface
     */
    public function getDataSetCollection(): DataSetCollectionInterface;

    /**
     * @return IdentifierCollectionInterface
     */
    public function getIdentifierCollection(): IdentifierCollectionInterface;

    /**
     * @param DataSetCollectionInterface $dataSetCollection
     *
     * @return StepInterface
     */
    public function withDataSetCollection(DataSetCollectionInterface $dataSetCollection): StepInterface;

    /**
     * @param IdentifierCollectionInterface $identifierCollection
     *
     * @return StepInterface
     */
    public function withIdentifierCollection(IdentifierCollectionInterface $identifierCollection): StepInterface;

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
