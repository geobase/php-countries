<?php

namespace GeoBase\Countries\Language;

use JsonSerializable;

class LanguageEntity implements JsonSerializable
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'code' => $this->getCode(),
        ];
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
     *
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }
}
