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

use Ddeboer\DataImport\Reader\CountableReader;

/**
 * Use a class implementing both \Iterator and \Countable as a reader
 *
 * This class uses count() on iterators implementing \Countable interface
 * and iterator_count in any further cases
 *
 * Be careful! iterator_count iterates through the whole iterator loading every data into the memory (for example from streams)
 * It is not recommended for very big datasets.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class CountableIteratorReader extends IteratorReader implements CountableReader
{
    /**
     * {@inheritdoc}
     */
    public function count()
    {
        if ($this->iterator instanceof \Countable) {
            return count($this->iterator);
        }

        return iterator_count($this->iterator);
    }
}
