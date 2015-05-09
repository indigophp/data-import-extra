<?php

/*
 * This file is part of the Indigo Data Import Extra package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\DataImport;

use Ddeboer\DataImport\WorkflowInterface;
use Ddeboer\DataImport\Workflow;
use League\CLImate\CLImate;

/**
 * Process a workflow and show the result in console
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class ConsoleWorkflow implements WorkflowInterface
{
    /**
     * @var WorkflowInterface
     */
    protected $workflow;

    /**
     * @var CLImate
     */
    protected $climate;

    /**
     * @param WorkflowInterface $workflow
     * @param CLImate           $climate
     */
    public function __construct(WorkflowInterface $workflow, CLImate $climate = null)
    {
        $this->workflow = $workflow;
        $this->climate = $climate ?: new CLImate;
    }

    /**
     * {@inheritdoc}
     */
    public function process()
    {
        $msg = 'Processing workflow';

        if ($this->workflow instanceof Workflow and $name = $this->workflow->getName()) {
            $msg.= ': '.$name;
        }

        $this->climate->write($msg."\n");

        $result = $this->workflow->process();

        $this->climate->info('Time elapsed: '.$result->getElapsed()->format('%i minute(s) %s second(s)'));
        $this->climate->info('Total processed: '.$result->getTotalProcessedCount().' row(s)');

        if ($errorCount = $result->getErrorCount() > 0) {
            $this->climate->error('Errors: '.$errorCount);
        }

        return $result;
    }
}
