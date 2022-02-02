# micbenner/iso10383

A PHP library providing ISO 10383 data.

## What is ISO 10383

> The Market Identifier Code (MIC) (ISO 10383) is a unique identification code used to identify securities trading exchanges, regulated and non-regulated trading markets. The MIC is a four alphanumeric character code, and is defined in ISO 10383 by the International Organization for Standardization (ISO). For example, trades that are executed on the US NASDAQ market are identified using MIC code XNAS.
>
> *-- [Wikipedia](https://en.wikipedia.org/wiki/Market_Identifier_Code)*

## Installing

``` sh
$ composer require micbenner/iso10383
```

## Using

Quick guide:

``` php
$exchange = CipherPixel\ISO10383\ISO10383Collection::load()->acronym('NASDAQ'); // Find by acronym
$exchange = CipherPixel\ISO10383\ISO10383Collection::load()->mic('XNAS'); // Find by MIC
$exchanges = CipherPixel\ISO10383\ISO10383Collection::load()->operatingMic('XNAS'); // Find all segment/child exchanges belonging to XNAS
```

Each method returns either a single instance, or an array of, the `CipherPixel\ISO10383\ISO10383Collection` class.

## Contributing

Feel free to submit a pull request or create an issue.

## License

micbenner/iso10383 is licensed under the MIT license.

## Source(s)

* [ISO 10383](https://www.iso20022.org/market-identifier-codes)
