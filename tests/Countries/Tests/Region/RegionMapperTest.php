<?php

namespace GeoBase\Countries\Tests\Region;

use GeoBase\Regions\Region\RegionEntity;
use GeoBase\Regions\Region\RegionLoader;
use GeoBase\Regions\Region\RegionMapper;
use PHPUnit\Framework\TestCase;

class RegionMapperTest extends TestCase
{
    public function testMapArrayToCollection()
    {
        $collection = (new RegionMapper())->mapArrayToCollection((new RegionLoader())->loadAllRegions());
        $this->assertGreaterThan(1, count($collection));
    }

    public function testMapArrayToEntity()
    {
        $regions = (new RegionLoader())->loadAllRegions();
        $entity = (new RegionMapper())->mapArrayToEntity($regions[0]);
        $this->assertInstanceOf(RegionEntity::class, $entity);
        $this->assertNotEmpty($entity->getCode());
    }
}
