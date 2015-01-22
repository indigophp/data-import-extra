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

use Ddeboer\DataImport\ItemConverter\ItemConverterInterface;
use Ddeboer\DataImport\ValueConverter\ValueConverterInterface;
use Ddeboer\DataImport\Exception\UnexpectedTypeException;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class WorkflowWriter extends ConverterWriter
{
    /**
     * @var ItemConverterInterface[]
     */
    protected $itemConverters = [];

    /**
     * @var ValueConverterInterface[]
     */
    protected $valueConverters = [];

    /**
     * Adds an item converter to the workflow
     *
     * @param ItemConverterInterface $converter
     *
     * @return $this
     */
    public function addItemConverter(ItemConverterInterface $converter)
    {
        $this->itemConverters[] = $converter;

        return $this;
    }

    /**
     * Add a value converter to the workflow
     *
     * @param string                  $field
     * @param ValueConverterInterface $converter
     *
     * @return $this
     */
    public function addValueConverter($field, ValueConverterInterface $converter)
    {
        $this->valueConverters[$field][] = $converter;

        return $this;
    }

    /**
     * Converts the item
     *
     * @param array $item
     *
     * @return array
     *
     * @throws UnexpectedTypeException
     */
    protected function convertItem(array $item)
    {
        foreach ($this->itemConverters as $converter) {
            if (!$item = $converter->convert($item)) {
                return $item;
            }

            $this->checkItem($item);
        }

        $this->checkItem($item);

        foreach ($this->valueConverters as $property => $converters) {
            // isset() returns false when value is null, so we need
            // array_key_exists() too. Combine both to have best performance,
            // as isset() is much faster.
            if (isset($item[$property]) || array_key_exists($property, $item)) {
                foreach ($converters as $converter) {
                    $item[$property] = $converter->convert($item[$property]);
                }
            }
        }

        return $item;
    }

    /**
     * Checks the item after a conversion
     *
     * @param mixed $item
     *
     * @throws UnexpectedTypeException
     */
    protected function checkItem($item)
    {
        if ($item && !(is_array($item) || ($item instanceof \ArrayAccess && $item instanceof \Traversable))) {
            throw new UnexpectedTypeException($item, 'false or array');
        }
    }
}
