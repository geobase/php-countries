<?php

namespace GeoBase\Regions\Region;

use GeoBase\Regions\Region\RegionName\RegionNameEntity;

class RegionMapper
{
    /**
     * @param array $data
     *
     * @return RegionCollection
     */
    public function mapArrayToCollection(array $data)
    {
        $collection = new RegionCollection();
        foreach ($data as $attributes) {
            $region = $this->mapArrayToEntity($attributes);
            if (null !== $region) {
                $collection->add($region);
            }
        }

        return $collection;
    }

    /**
     * @param array $attributes
     *
     * @return RegionEntity
     */
    public function mapArrayToEntity(array $attributes)
    {
        $region = new RegionEntity();
        $region->setCode($attributes['code']);
        $region->setLongCode($attributes['long_code']);
        $region->setType($attributes['type']);
        $region->setUnmappedCountry($attributes['country']);
        $region->setTimezone($attributes['timezone']);
        $region->setLatitude($attributes['latitude']);
        $region->setLongitude($attributes['longitude']);
        $region->setNorth($attributes['north']);
        $region->setEast($attributes['east']);
        $region->setSouth($attributes['south']);
        $region->setWest($attributes['west']);

        foreach ($attributes['names'] as $language => $name) {
            $regionName = new RegionNameEntity();
            $regionName->setLanguage($language);
            $regionName->setName($name);
            $region->getNames()->add($regionName);
        }

        return $region;
    }
}
