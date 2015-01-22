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
use XmlIterator\XmlIterator;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class XmlReader implements ReaderInerface
{
    /**
     * @var XmlIterator
     */
    protected $xmlIterator;

    /**
     * @param XmlIterator $xmlIterator
     */
    public function __construct(XmlIterator $xmlIterator)
    {
        $this->xmlIterator = $xmlIterator;
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
        return $this->xmlIterator->current();
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        return $this->xmlIterator->next();
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->xmlIterator->key();
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return $this->xmlIterator->valid();
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        return $this->xmlIterator->rewind();
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return iterator_count($this->xmlIterator)
    }
}
