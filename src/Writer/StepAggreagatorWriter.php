<?php

/*
 * This file is part of the Indigo Data Import Extra package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\DataImport\Writer;

use Ddeboer\DataImport\Writer;
use Ddeboer\DataImport\Step;
use Ddeboer\DataImport\Exception\UnexpectedTypeException;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class StepAggreagatorWriter implements Writer
{
    /**
     * @var Writer
     */
    protected $writer;

    /**
     * @var Step[]
     */
    protected $step = [];

    /**
     * @param Writer $writer
     */
    public function __construct(Writer $writer)
    {
        $this->writer = $writer;
        $this->steps = new \SplPriorityQueue();
    }

    /**
     * {@inheritdoc}
     */
    public function prepare()
    {
        $this->writer->prepare();

        return $this;
    }

    /**
     * Add a step to the current workflow
     *
     * @param Step         $step
     * @param integer|null $priority
     *
     * @return Workflow
     */
    public function addStep(Step $step, $priority = null)
    {
        $priority = null === $priority && $step instanceof PriorityStep ? $step->getPriority() : null;
        $priority = null === $priority ? 0 : $priority;

        $this->steps->insert($step, $priority);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function writeItem(array $item)
    {
        foreach (clone $this->steps as $step) {
            if (false === $step->process($item)) {
                return $this;
            }
        }

        if (!is_array($item) && !($item instanceof \ArrayAccess && $item instanceof \Traversable)) {
            throw new UnexpectedTypeException($item, 'array');
        }

        return $this->writer->writeItem($item);
    }

    /**
     * {@inheritdoc}
     */
    public function finish()
    {
        $this->writer->finish();

        return $this;
    }
}
