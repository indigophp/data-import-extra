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

use Ddeboer\DataImport\Reader;

/**
 * Use an iterator as a reader
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class IteratorReader extends \IteratorIterator implements Reader
{
    /**
     * {@inheritdoc}
     */
    public function getFields()
    {
        return array_keys($this->current());
    }
}
