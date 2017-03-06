<?php

namespace GeoBase\Regions;

use GeoBase\Regions\Region\RegionCollection;
use GeoBase\Regions\Region\RegionEntity;
use GeoBase\Regions\Region\RegionLoader;
use GeoBase\Regions\Region\RegionMapper;

class RegionRepository
{
    /**
     * @var RegionCollection
     */
    private static $collection;

    /**
     * @var RegionEntity[]
     */
    private static $items = [];

    /**
     * @var RegionMapper
     */
    private static $mapper;

    /**
     * @var RegionLoader
     */
    private static $loader;

    /**
     * @return RegionCollection
     */
    public static function findAll()
    {
        if (null === self::$collection) {
            self::$collection = self::getMapper()->mapArrayToCollection(self::getLoader()->loadAllRegions());
        }

        return self::$collection;
    }

    /**
     * @param string $code
     *
     * @return null|RegionEntity
     */
    public static function findByCode($code)
    {
        if (!isset(self::$items[$code])) {
            return self::$items[$code] =
                self::getMapper()->mapArrayToEntity(self::getLoader()->loadRegion($code));
        }

        return self::$items[$code];
    }

    /**
     * @return RegionLoader
     */
    private static function getLoader()
    {
        if (null === self::$loader) {
            self::$loader = new RegionLoader();
        }

        return self::$loader;
    }

    /**
     * @return RegionMapper
     */
    private static function getMapper()
    {
        if (null === self::$mapper) {
            self::$mapper = new RegionMapper();
        }

        return self::$mapper;
    }
}
