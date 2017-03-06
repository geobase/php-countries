<?php

namespace GeoBase\Regions\Region;

use JsonSerializable;
use League\Geotools\Coordinate\Coordinate;
use GeoBase\Countries\Coordinate\CoordinateCollectionInterface;
use GeoBase\Countries\Coordinate\CoordinateLogic;
use GeoBase\Regions\Region\RegionName\RegionNameCollection;
use GeoBase\Countries\Country\CountryEntity;
use GeoBase\Regions\Region\Type\TypeInterface;
use League\Geotools\Polygon\Polygon;
use League\Geotools\BoundingBox\BoundingBox;
use GeoBase\Countries\Geo;

class RegionEntity extends CoordinateLogic implements JsonSerializable, CoordinateCollectionInterface
{
    /**
     * @var Coordinate
     */
    protected $coordinate;

    /**
     * @var BoundingBox
     */
    protected $boundingBox;

    /**
     * @var RegionNameCollection
     */
    protected $names;

    /**
     * @var CountryEntity
     */
    protected $country;

    /**
     * @var Polygon
     */
    protected $polygon;

    /**
     * @var string
     */
    protected $unmappedCountry;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $longCode;

    /**
     * @var TypeInterface|string
     */
    protected $type;

    /**
     * @var string
     */
    protected $timezone;

    /**
     * @var string
     */
    protected $latitude;

    /**
     * @var string
     */
    protected $longitude;

    /**
     * @var string
     */
    protected $north;

    /**
     * @var string
     */
    protected $east;

    /**
     * @var string
     */
    protected $south;

    /**
     * @var string
     */
    protected $west;

    public function __construct()
    {
        $this->boundingBox = new BoundingBox();
        $this->polygon = new Polygon();
        $this->coordinate = new Coordinate([
            $this->latitude,
            $this->longitude
        ]);
        $this->setNames(new RegionNameCollection());
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'names' => $this->getNames(),
            'code' => $this->getCode(),
            'long_code' => $this->getLongCode(),
            'type' => $this->getType(),
            'country' => $this->getCountry(),
            'timezone' => $this->getTimezone(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
            'north' => $this->getNorth(),
            'east' => $this->getEast(),
            'south' => $this->getSouth(),
            'west' => $this->getWest()
        ];
    }

    /**
     * @return Polygon
     */
    public function getPolygon()
    {
        return $this->polygon;
    }

    /**
     * @param Polygon $polygon
     * @return $this
     */
    public function setPolygon(Polygon $polygon)
    {
        $this->polygon = $polygon;
        return $this;
    }

    /**
     * @return BoundingBox
     */
    public function getBoundingBox()
    {
        return $this->boundingBox;
    }

    /**
     * @param BoundingBox $boundingBox
     * @return $this
     */
    public function setBoundingBox(BoundingBox $boundingBox)
    {
        $this->boundingBox = $boundingBox;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getLongCode()
    {
        return $this->longCode;
    }

    /**
     * @param string $longCode
     * @return $this
     */
    public function setLongCode($longCode)
    {
        $this->longCode = $longCode;
        return $this;
    }

    /**
     * @return Coordinate
     */
    public function getCoordinate()
    {
        return $this->coordinate;
    }

    /**
     * @param Coordinate $coordinate
     * @return $this
     */
    public function setCoordinate(Coordinate $coordinate)
    {
        $this->coordinate = $coordinate;
        return $this;
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     * @return $this
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        $this->coordinate->setLatitude($this->latitude);
        return $this;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     * @return $this
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        $this->coordinate->setLongitude($this->longitude);
        return $this;
    }

    /**
     * @return RegionNameCollection
     */
    public function getNames()
    {
        return $this->names;
    }

    /**
     * @param RegionNameCollection $names
     * @return $this
     */
    public function setNames(RegionNameCollection $names)
    {
        $this->names = $names;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @param string $timezone
     * @return $this
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * @return TypeInterface|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param TypeInterface|string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getNorth()
    {
        return $this->north;
    }

    /**
     * @param string $north
     * @return $this
     */
    public function setNorth($north)
    {
        $this->getBoundingBox()->setNorth($north);
        $this->north = $north;
        return $this;
    }

    /**
     * @return string
     */
    public function getEast()
    {
        return $this->east;
    }

    /**
     * @param string $east
     * @return $this
     */
    public function setEast($east)
    {
        $this->getBoundingBox()->setEast($east);
        $this->east = $east;
        return $this;
    }

    /**
     * @return string
     */
    public function getSouth()
    {
        return $this->south;
    }

    /**
     * @param string $south
     * @return $this
     */
    public function setSouth($south)
    {
        $this->getBoundingBox()->setSouth($south);
        $this->south = $south;
        return $this;
    }

    /**
     * @return string
     */
    public function getWest()
    {
        return $this->west;
    }

    /**
     * @param string $west
     * @return $this
     */
    public function setWest($west)
    {
        $this->getBoundingBox()->setWest($west);
        $this->west = $west;
        return $this;
    }

    /**
     * @return CountryEntity
     */
    public function getCountry()
    {
        if (null !== $this->unmappedCountry && null === $this->country) {
            $this->country = Geo::getCountryRepository()->findByShortCode($this->unmappedCountry);
        }
        return $this->country;
    }

    /**
     * @param CountryEntity|string $country
     * @return $this
     */
    public function setCountry($country)
    {
        if (is_string($country)) {
            $this->unmappedCountry = $country;
        } else {
            $this->country = $country;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getUnmappedCountry()
    {
        return $this->unmappedCountry;
    }

    /**
     * @param string $unmappedCountry
     * @return $this
     */
    public function setUnmappedCountry($unmappedCountry)
    {
        $this->unmappedCountry = $unmappedCountry;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function normalizeLatitude($latitude)
    {
        return $this->coordinate->normalizeLatitude($latitude);
    }

    /**
     * {@inheritdoc}
     */
    public function normalizeLongitude($longitude)
    {
        return $this->coordinate->normalizeLongitude($longitude);
    }

    /**
     * {@inheritdoc}
     */
    public function getEllipsoid()
    {
        return $this->coordinate->getEllipsoid();
    }
}
