<?php

namespace GeoBase\Countries\Country;

use GeoBase\Countries\Country\CountryName\CountryNameEntity;

class CountryMapper
{
    /**
     * @param array $data
     *
     * @return CountryCollection
     */
    public function mapArrayToCollection(array $data)
    {
        $collection = new CountryCollection();
        foreach ($data as $attributes) {
            $country = $this->mapArrayToEntity($attributes);
            if (null !== $country) {
                $collection->add($country);
            }
        }

        return $collection;
    }

    /**
     * @param array $attributes
     *
     * @return CountryEntity
     */
    public function mapArrayToEntity(array $attributes)
    {
        $country = new CountryEntity();
        $country->setCode($attributes['code']);
        $country->setShortCode($attributes['shortCode']);
        $country->setLatitude($attributes['latitude']);
        $country->setLongitude($attributes['longitude']);
        $country->setCurrency($attributes['currency']);
        $country->setContinent($attributes['continent']);
        $country->setPopulation($attributes['population']);
        $country->setArea($attributes['area']);
        $country->setCapital($attributes['capital']);
        $country->setTimezone($attributes['timezone']);
        $country->setNorth($attributes['north']);
        $country->setEast($attributes['east']);
        $country->setSouth($attributes['south']);
        $country->setWest($attributes['west']);

        foreach ($attributes['names'] as $language => $name) {
            $countryName = new CountryNameEntity();
            $countryName->setLanguage($language);
            $countryName->setName($name);
            $country->getNames()->add($countryName);
        }

        return $country;
    }
}
