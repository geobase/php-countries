<?php

namespace GeoBase\Countries\Language;

class LanguageMapper
{
    /**
     * @var array
     */
    private $languages = [
        'en',
        'fr',
        'de',
    ];

    /**
     * @return LanguageCollection
     */
    public function mapCollection()
    {
        $collection = new LanguageCollection();
        foreach ($this->languages as $code) {
            $collection->add($this->mapEntity($code));
        }

        return $collection;
    }

    /**
     * @param string $code
     *
     * @return LanguageEntity
     */
    public function mapEntity($code)
    {
        $language = new LanguageEntity();
        $language->setCode($code);

        return $language;
    }
}
