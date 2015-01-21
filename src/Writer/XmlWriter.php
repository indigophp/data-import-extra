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
class XmlWriter implements WriterInterface
{
    /**
     * @var string
     */
    protected $file;

    /**
     * @var \XmlWriter
     */
    protected $xmlWriter;

    /**
     * @var string
     */
    protected $rootElement;

    /**
     * @var string
     */
    protected $itemElement;

    /**
     * @param string $file
     */
    public function __construct($file, $rootElement = 'elements', $itemElement = 'element')
    {
        $this->file = $file;
        $this->rootElement = $rootElement;
        $this->itemElement = $itemElement;
    }

    /**
     * {@inheritdoc}
     */
    public function prepare()
    {
        $this->xmlWriter = new \XMLWriter;

        $this->xmlWriter->openUri($this->file);
        $this->xmlWriter->startDocument('1.0', 'UTF-8');
        $this->xmlWriter->startElement($this->rootElement);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function writeItem(array $item)
    {
        $this->xmlWriter->startElement($this->itemElement);

        foreach ($item as $key => $value) {
            $this->xmlWriter->writeElement($key, $value);
        }

        $this->xmlWriter->endElement();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function finish()
    {
        $this->xmlWriter->endElement();
        $this->xmlWriter->endDocument();
        $this->xmlWriter->flush();

        return $this;
    }
}
