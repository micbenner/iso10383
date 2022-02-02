<?php

namespace CipherPixel\ISO10383\Import;

use Iterator;
use SplFileObject;

class CSVImporter implements Importer
{
    private array $columns = [
        'mic',
        'operatingMic',
        'operatingOrSegment',
        'marketName',
        'legalName',
        'legalEntityIdentifier',
        'marketCategory',
        'acronym',
        'countryCode',
        'city',
        'website',
        'status',
        'creationDate',
        'modifiedDate',
        'lastValidationMonth',
        'expiryDate',
        'comments',
    ];

    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function fetchExchanges(): Iterator
    {
        $handler = $this->openFile();
        $first   = true;

        while ($data = $handler->fgetcsv()) {
            if ($first === true) {
                $first = false;
                continue;
            }

            if (count($this->columns) !== count($data)) {
                continue;
            }

            yield array_combine($this->columns, $data);
        }

        return;
    }

    private function openFile(): SplFileObject
    {
        return new SplFileObject($this->filePath);
    }
}
