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

use Ddeboer\DataImport\Writer\WriterInterface;

/**
 * @author Márk Sági-Kazár <webmaster@firstcomputer.hu>
 */
abstract class ConverterWriter implements WriterInterface
{
    /**
     * @var WriterInterface
     */
    protected $writer;

    /**
     * @param WriterInterface $writer
     */
    public function __construct(WriterInterface $writer)
    {
        $this->writer = $writer;
    }

    /**
     * {@inheritdoc}
     */
    public function prepare()
    {
        return $this->writer->prepare();
    }

    /**
     * {@inheritdoc}
     */
    public function writeItem(array $item)
    {
        if (!$item = $this->convertItem($item)) {
            return $this;
        }

        return $this->writer->writeItem($item);
    }

    /**
     * {@inheritdoc}
     */
    public function finish()
    {
        return $this->writer->finish();
    }

    /**
     * Converts the item
     *
     * @param array $item
     *
     * @return mixed
     */
    abstract protected function convertItem(array $item);
}
