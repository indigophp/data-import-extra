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
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class NullWriter implements WriterInterface
{
    /**
     * {@inheritdoc}
     */
    public function prepare()
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function writeItem(array $item)
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function finish()
    {
        return $this;
    }
}
