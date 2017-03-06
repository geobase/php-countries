<?php

namespace GeoBase\Countries\Tests\Country;

use GeoBase\Countries\CountryRepository;
use PHPUnit\Framework\TestCase;

class CountryCollectionTest extends TestCase
{
    public function getCollection()
    {
        return (new CountryRepository())->findAll();
    }

    public function testOrderByCountryName()
    {
        $collection = $this->getCollection();
        $collection->orderByName('en');
        $this->assertGreaterThan(1, $collection->count());
        $previousName = null;
        foreach ($collection as $country) {
            $name = $country->getNames()->get('en')->getName();
            $result = strcasecmp($name, $previousName);
            $this->assertGreaterThan(0, $result);
            $previousName = $name;
        }
    }
}
