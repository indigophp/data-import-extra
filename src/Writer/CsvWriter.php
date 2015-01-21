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
use League\Csv\Writer;

/**
 * @author Márk Sági-Kazár <webmaster@firstcomputer.hu>
 */
class CsvWriter implements WriterInterface
{
    /**
     * @var Writer
     */
    protected $writer;

    /**
     * @param Writer $writer
     */
    public function __construct(Writer $writer)
    {
        $this->writer = $writer;
    }

    /**
     * {@inheritdoc}
     */
    public function prepare()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function writeItem(array $item)
    {
        return $this->writer->insertOne($item);
    }

    /**
     * {@inheritdoc}
     */
    public function finish()
    {

    }
}
