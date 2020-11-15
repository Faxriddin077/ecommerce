<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\App;

trait Translatable
{
    protected $defaultLocale = 'ru';

    public function __($originalFieldName)
    {
        $locale = App::getLocale() ?? $this->defaultLocale;

        if ($locale == 'en') {
            $fieldName = $originalFieldName . '_en';
        } else {
            $fieldName = $originalFieldName;
        }

        $attributes = array_keys($this->attributes);

        if (!in_array($fieldName, $attributes)) {
            throw new \LogicException('no such attribute for model ' . get_class($this));
        }

        if ($locale == 'en' && (is_null($this->$fieldName) || empty($this->$fieldName))) {
            return $originalFieldName;
        }
        return $this->$fieldName;
    }
}
