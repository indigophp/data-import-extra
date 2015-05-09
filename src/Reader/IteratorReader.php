<?php

/*
 * This file is part of the Indigo Data Import Extra package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\DataImport\Reader;

use Ddeboer\DataImport\Reader\ReaderInterface;

/**
 * Use an iterator as a reader
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class IteratorReader implements ReaderInterface
{
    /**
     * @var \Iterator
     */
    protected $iterator;

    /**
     * @param \Iterator $iterator
     */
    public function __construct(\Iterator $iterator)
    {
        $this->iterator = $iterator;
    }

    /**
     * {@inheritdoc}
     */
    public function getFields()
    {
        return array_keys($this->current());
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return $this->iterator->current();
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        return $this->iterator->next();
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->iterator->key();
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return $this->iterator->valid();
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        return $this->iterator->rewind();
    }
}
