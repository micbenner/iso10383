<?php

namespace CipherPixel\ISO10383\Import;

use Iterator;

interface Importer
{
    /**
     * The iterator should return an array of the exchange
     *
     * @return \Iterator
     */
    public function fetchExchanges(): Iterator;
}
