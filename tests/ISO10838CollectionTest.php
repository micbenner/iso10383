<?php

namespace CipherPixel\ISO10383\Tests;

use CipherPixel\ISO10383\Exceptions\ExchangeNotFoundException;
use CipherPixel\ISO10383\ISO10383;
use CipherPixel\ISO10383\ISO10383Collection;
use PHPUnit\Framework\TestCase;

class ISO10838CollectionTest extends TestCase
{
    private ISO10383Collection $collection;

    private array $bar = [
        'mic'                   => 'XBOO',
        'operatingMic'          => 'XFOO',
        'operatingOrSegment'    => 'OPRT',
        'marketName'            => 'Bar Markets, an child of Foo',
        'legalName'             => '',
        'legalEntityIdentifier' => '',
        'marketCategory'        => 'ABCD',
        'acronym'               => '',
        'countryCode'           => 'US',
        'city'                  => 'NEW YORK',
        'website'               => '',
        'status'                => '',
        'creationDate'          => '',
        'modifiedDate'          => '',
        'lastValidationMonth'   => '',
        'expiryDate'            => '',
        'comments'              => '',
    ];

    private array $foo = [
        'mic'                   => 'XFOO',
        'operatingMic'          => 'XFOO',
        'operatingOrSegment'    => 'OPRT',
        'marketName'            => 'Foo Markets',
        'legalName'             => '',
        'legalEntityIdentifier' => '',
        'marketCategory'        => 'ABCD',
        'acronym'               => 'FOO',
        'countryCode'           => 'US',
        'city'                  => 'NEW YORK',
        'website'               => '',
        'status'                => '',
        'creationDate'          => '',
        'modifiedDate'          => '',
        'lastValidationMonth'   => '',
        'expiryDate'            => '',
        'comments'              => '',
    ];

    protected function setUp(): void
    {
        $this->collection = new ISO10383Collection([
            $this->bar['mic'] => $this->bar,
            $this->foo['mic'] => $this->foo,
        ]);
    }

    public function testFetchByAcronym()
    {
        $exchange = $this->collection->acronym('FOO');

        $this->assertInstanceOf(ISO10383::class, $exchange);
    }

    public function testFetchByAcronymFails()
    {
        $this->expectException(ExchangeNotFoundException::class);
        $this->expectExceptionMessage("Could not find exchange with acronym of 'XNO'");

        $this->collection->acronym('XNO');
    }

    public function testFetchByMic()
    {
        $exchange = $this->collection->mic('XFOO');

        $this->assertInstanceOf(ISO10383::class, $exchange);
    }

    public function testFetchByMicFails()
    {
        $this->expectException(ExchangeNotFoundException::class);
        $this->expectExceptionMessage("Could not find exchange with MIC of 'XNO'");

        $this->collection->mic('XNO');
    }

    public function testFetchByOperatingMic()
    {
        $exchanges = $this->collection->operatingMic('XFOO');

        $this->assertCount(2, $exchanges);
        $this->assertSame('XBOO', $exchanges[0]->getMic());
        $this->assertSame('XFOO', $exchanges[0]->getOperatingMic());
    }
}
