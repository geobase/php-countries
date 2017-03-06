<?php

namespace GeoBase\Countries\Language;

use GeoBase\Countries\ArrayCollection;

class LanguageCollection extends ArrayCollection
{
    /**
     * @var LanguageEntity[]
     */
    protected $elements;

    /**
     * @param string $language
     *
     * @return null|LanguageEntity
     */
    public function get($language)
    {
        foreach ($this->elements as $element) {
            if ($language === $element->getCode()) {
                return $element;
            }
        }
    }
}
