<?php

namespace GeoBase\Countries\Country;

use GeoBase\CountriesData\CountriesData;

class CountryLoader
{
    const ALL_COUNTRIES_FILE = 'countries.json';
    const COUNTRY_FILE = 'countries/%s.json';
    const COUNTRY_POLYGON_FILE = 'countries/%s/polygon.json';

    /**
     * @var Storage
     */
    private $path;

    public function __construct()
    {
        $this->path = CountriesData::getCountriesPath();
    }

    /**
     * @return array
     */
    public function loadAllCountries()
    {
        return json_decode(
            file_get_contents($this->path.DIRECTORY_SEPARATOR.self::ALL_COUNTRIES_FILE),
            true
        );
    }

    /**
     * @param string $country
     *
     * @return array
     */
    public function loadCountry($country)
    {
        if (!$country) {
            return;
        }
        $file = $this->path.DIRECTORY_SEPARATOR.sprintf(self::COUNTRY_FILE, $country);
        if (!file_exists($file)) {
            return;
        }

        return json_decode(
            file_get_contents($file),
            true
        );
    }

    /**
     * @param string $country
     *
     * @return array
     */
    public function loadCountryPolygon($country)
    {
        if (!$country) {
            return;
        }
        $file = $this->path.DIRECTORY_SEPARATOR.sprintf(self::COUNTRY_POLYGON_FILE, $country);
        if (!file_exists($file)) {
            return;
        }

        return json_decode(
            file_get_contents($file),
            true
        );
    }
}
