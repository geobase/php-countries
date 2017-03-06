<?php

namespace GeoBase\Countries\Tests\Region;

use PHPUnit\Framework\TestCase;
use GeoBase\Regions\Region\RegionEntity;
use GeoBase\Regions\RegionRepository;

class RegionRepositoryTest extends TestCase
{
    public function testFindAll()
    {
        $collection = RegionRepository::findAll();
        $this->assertGreaterThan(1, count($collection));
        $regionExample = $collection->get(0);
        $this->assertInstanceOf(RegionEntity::class, $regionExample);
        $this->assertEquals(2, strlen($regionExample->getCode()));
    }

    public function testFindByCode()
    {
        $region = RegionRepository::findByCode('BC');
        $this->assertInstanceOf(RegionEntity::class, $region);
        $this->assertEquals(2, strlen($region->getCode()));
    }
}
