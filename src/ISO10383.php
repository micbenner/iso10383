<?php

namespace CipherPixel\ISO10383;

/// MIC: Market Identifier Code allocated to the market named in ‘Market Name-Institution Description’.
//- Operating MIC: entity operating an exchange/market/trade reporting facility in a specific market/country.
//- OPRT (Operating) or SGMT (Segment1): indicates whether the MIC is an operating MIC or a market segment MIC.
//- Market Name - Institution Description: name of the market.
//- Legal entity name: legal name of the entity owning the market.
//- LEI: Legal Entity Identifier (LEI) see ISO 17442-1.
//- Market category: specifies the type of market. The list of market types is predefined (1). The list can be updated
//  upon request to the RA, which will validate the request.
//- Acronym: known acronym of the market.
//- ISO country code (see ISO 3166-1): alpha-2 code of the country where the market is
//  registered.
//- City: city where the market is located.
//- Website: website of the market.
//- Status: active, updated (since last publication), expired (= deactivated).
//- Creation date: date indicating when the MIC was originally created.
//- Last update date: date indicating when the MIC was last modified
//- Last validation date: date indicating when the MIC was last reviewed for correctness.
//- Expiry date: The expiry date is populated when the MIC is deactivated; upon request from the MIC owner; following
//  market research (user request) or maintenance. The expiry date field is left blank when a MIC is created.
//- Comments: any additional information worth mentioning to help users with identifying the exchange or understanding
//  a modification.

class ISO10383
{
    private const TYPE_OPRT = 'OPRT';
    private const TYPE_SGMT = 'SGMT';

    private string  $mic;
    private string  $operatingMic;
    private string  $operatingOrSegment;
    private string  $marketName;
    private ?string $legalName;
    private ?string $legalEntityIdentifier;
    private string  $marketCategory;
    private ?string $acronym;
    private string  $countryCode;
    private string  $city;
    private string  $website;

    public function __construct(
        string $mic,
        string $operatingMic,
        string $operatingOrSegment,
        string $marketName,
        ?string $legalName,
        ?string $legalEntityIdentifier,
        string $marketCategory,
        ?string $acronym,
        string $countryCode,
        string $city,
        string $website
    ) {
        $this->mic                   = $mic;
        $this->operatingMic          = $operatingMic;
        $this->operatingOrSegment    = $operatingOrSegment;
        $this->marketName            = $marketName;
        $this->legalName             = $legalName;
        $this->legalEntityIdentifier = $legalEntityIdentifier;
        $this->marketCategory        = $marketCategory;
        $this->acronym               = $acronym;
        $this->countryCode           = $countryCode;
        $this->city                  = $city;
        $this->website               = $website;
    }

    public function getMic(): string
    {
        return $this->mic;
    }

    public function getOperatingMic(): string
    {
        return $this->operatingMic;
    }

    public function isOperating(): bool
    {
        return $this->operatingOrSegment === self::TYPE_OPRT;
    }

    public function isSegment(): bool
    {
        return $this->operatingOrSegment === self::TYPE_SGMT;
    }

    public function getMarketName(): string
    {
        return $this->marketName;
    }

    public function getLegalName(): ?string
    {
        return $this->legalName;
    }

    public function getLegalEntityIdentifier(): ?string
    {
        return $this->legalEntityIdentifier;
    }

    public function getMarketCategory(): string
    {
        return $this->marketCategory;
    }

    public function getAcronym(): ?string
    {
        return $this->acronym;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }
}
