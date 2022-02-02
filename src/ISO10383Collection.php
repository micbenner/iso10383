<?php

namespace CipherPixel\ISO10383;

use CipherPixel\ISO10383\Exceptions\ExchangeNotFoundException;

class ISO10383Collection
{
    private array $exchangesByMic;

    public function __construct(array $exchangesByMic)
    {
        $this->exchangesByMic = $exchangesByMic;
    }

    public static function load(): self
    {
        return new self(
            include __DIR__.DIRECTORY_SEPARATOR.'AutoGenerated_Exchanges.php'
        );
    }
    /**
     * @throws \CipherPixel\ISO10383\Exceptions\ExchangeNotFoundException
     */
    public function acronym(string $acronym): ISO10383
    {
        return $this->lookUp('acronym', $acronym);
    }

    /**
     * @throws \CipherPixel\ISO10383\Exceptions\ExchangeNotFoundException
     */
    public function mic(string $mic): ISO10383
    {
        if (isset($this->exchangesByMic[$mic])) {
            return $this->exchangeFromArray($this->exchangesByMic[$mic]);
        }

        throw new ExchangeNotFoundException();
    }

    /**
     * @return \CipherPixel\ISO10383\ISO10383[]
     */
    public function operatingMic(string $operatingMic): array
    {
        return $this->lookUpMany('operatingMic', $operatingMic);
    }

    private function exchangeFromArray(array $data): ISO10383
    {
        return new ISO10383(
            $data['mic'],
            $data['operatingMic'],
            $data['operatingOrSegment'],
            $data['marketName'],
            $this->nullEmptyStrings($data['legalName']),
            $this->nullEmptyStrings($data['legalEntityIdentifier']),
            $data['marketCategory'],
            $this->nullEmptyStrings($data['acronym']),
            $data['countryCode'],
            $data['city'],
            $data['website'],
        );
    }

    /**
     * @return \CipherPixel\ISO10383\ISO10383
     */
    private function lookUp(string $key, string $value): ISO10383
    {
        foreach ($this->exchangesByMic as $exchange) {
            if (0 === strcasecmp($value, $exchange[$key])) {
                return $this->exchangeFromArray($exchange);
            }
        }

        throw new ExchangeNotFoundException();
    }

    /**
     * @return \CipherPixel\ISO10383\ISO10383[]
     */
    private function lookUpMany(string $key, string $value): array
    {
        $matches = [];

        foreach ($this->exchangesByMic as $exchange) {
            if (0 === strcasecmp($value, $exchange[$key])) {
                $matches[] = $exchange;
            }
        }

        return array_map(fn(array $data) => $this->exchangeFromArray($data), $matches);
    }

    private function nullEmptyStrings(string $string): ?string
    {
        return ! empty($string) ? $string : null;
    }
}