<?php

namespace GeoBase\Countries\Coordinate;

use League\Geotools\Coordinate\CoordinateInterface;
use League\Geotools\Geotools;

abstract class CoordinateLogic implements CoordinateInterface
{
    /**
     * @param CoordinateCollectionInterface $collection
     *
     * @return CoordinateInterface
     */
    public function findClosest(CoordinateCollectionInterface $collection)
    {
        $geotools = new Geotools();
        $match = null;
        $matchDistance = null;

        foreach ($collection as $coordinate) {
            $distance = $geotools->distance()->setFrom($this)->setTo($coordinate);
            $flatDistance = $distance->flat();
            if ($matchDistance === null || $flatDistance < $matchDistance) {
                $match = $coordinate;
                $matchDistance = $flatDistance;
            }
        }

        return $match;
    }
}
