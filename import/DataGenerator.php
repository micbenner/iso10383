<?php

namespace CipherPixel\ISO10383\Import;

use Brick\VarExporter\VarExporter;

class DataGenerator
{
    private Importer $importer;

    public function __construct(Importer $importer)
    {
        $this->importer = $importer;
    }

    // Referenced in composer.json
    public static function importFromCsv(): void
    {
        $generator = new DataGenerator(
            new CSVImporter(__DIR__."/../data/ISO10383_MIC_NewFormat.csv")
        );

        $generator->createFile(__DIR__."/../src/AutoGenerated_Exchanges.php");
    }

    public function createFile(string $outputPath): void
    {
        $exchanges = [];

        foreach ($this->importer->fetchExchanges() as $exchange) {
            $exchanges[$exchange['mic']] = $exchange;
        }

        ksort($exchanges);

        $generated = "<?php\n\n";
        $generated .= VarExporter::export($exchanges, VarExporter::ADD_RETURN | VarExporter::TRAILING_COMMA_IN_ARRAY);

        file_put_contents($outputPath, $generated);
    }
}