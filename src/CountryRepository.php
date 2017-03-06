<?php

namespace GeoBase\Countries;

use GeoBase\Countries\Country\CountryMapper;
use GeoBase\Countries\Country\CountryLoader;

class CountryRepository
{
    /**
     * @var CountryCollection
     */
    private static $collection;

    /**
     * @var CountryEntity[]
     */
    private static $items = [];

    /**
     * @var CountryMapper
     */
    private static $mapper;

    /**
     * @var CountryLoader
     */
    private static $loader;

    /**
     * @return CountryCollection
     */
    public static function findAll()
    {
        if (null === self::$collection) {
            self::$collection = self::getMapper()->mapArrayToCollection(self::getLoader()->loadAllCountries());
        }
        return self::$collection;
    }

    /**
     * @param string $shortCode
     * @return null|CountryEntity
     */
    public static function findByShortCode($shortCode)
    {
        if (!isset(self::$items[$shortCode])) {
            $country = self::getLoader()->loadCountry($shortCode);
            if (!$country) return null;
            return self::$items[$shortCode] = self::getMapper()->mapArrayToEntity($country);
        }
        return self::$items[$shortCode];
    }

    /**
     * @return CountryLoader
     */
    private static function getLoader()
    {
        if (null === self::$loader) {
            self::$loader = new CountryLoader();
        }
        return self::$loader;
    }

    /**
     * @return CountryMapper
     */
    private static function getMapper()
    {
        if (null === self::$mapper) {
            self::$mapper = new CountryMapper();
        }
        return self::$mapper;
    }
}
