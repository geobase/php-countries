<?php

namespace GeoBase\Countries\Tests\Country;

use PHPUnit\Framework\TestCase;
use GeoBase\Countries\Country\CountryEntity;
use GeoBase\Countries\CountryRepository;

class CountryRepositoryTest extends TestCase
{
    public function testFindAll()
    {
        $collection = CountryRepository::findAll();
        $this->assertGreaterThan(1, count($collection));
        $countryExample = $collection->get(0);
        $this->assertInstanceOf(CountryEntity::class, $countryExample);
        $this->assertEquals(3, strlen($countryExample->getCode()));
    }

    public function testFindByShortCode()
    {
        $country = CountryRepository::findByShortCode('DE');
        $this->assertInstanceOf(CountryEntity::class, $country);
        $this->assertEquals(3, strlen($country->getCode()));
    }
}
