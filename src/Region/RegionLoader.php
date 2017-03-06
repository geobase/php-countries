<?php

namespace GeoBase\Regions\Region;

use GeoBase\CountriesData\CountriesData;

class RegionLoader
{
    const ALL_REGIONS_FILE = 'regions.json';
    const REGION_FILE = 'regions/%s.json';
    const REGION_POLYGON_FILE = 'regions/%s/polygon.json';

    /**
     * @var string
     */
    private $path;

    public function __construct()
    {
        $this->path = CountriesData::getRegionsPath();
    }

    /**
     * @return array
     */
    public function loadAllRegions()
    {
        return json_decode(
            file_get_contents($this->path.DIRECTORY_SEPARATOR.self::ALL_REGIONS_FILE),
            true
        );
    }

    /**
     * @param string $region
     *
     * @return array
     */
    public function loadRegion($region)
    {
        return json_decode(
            file_get_contents(
                $this->path.DIRECTORY_SEPARATOR.sprintf(self::REGION_FILE, $region)
            ),
            true
        );
    }

    /**
     * @param string $region
     *
     * @return array
     */
    public function loadRegionPolygon($region)
    {
        return json_decode(
            file_get_contents(
                $this->path.DIRECTORY_SEPARATOR.sprintf(self::REGION_POLYGON_FILE, $region)
            ),
            true
        );
    }
}
