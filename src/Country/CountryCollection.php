<?php

namespace GeoBase\Countries\Country;

use GeoBase\Countries\ArrayCollection;
use GeoBase\Countries\Coordinate\CoordinateCollectionInterface;
use GeoBase\Countries\Language\LanguageEntity;

/**
 * @method CountryEntity get($key)
 */
class CountryCollection extends ArrayCollection implements CoordinateCollectionInterface
{
    /**
     * @param string|LanguageEntity $language
     *
     * @return $this
     */
    public function orderByName($language)
    {
        if ($language instanceof LanguageEntity) {
            $language = $language->getCode();
        }
        $this->order("names.{$language}.name");

        return $this;
    }
}
