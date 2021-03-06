<?php

namespace Neoxia\DatabaseLocalization;

interface Translatable
{
    public function scopeSearch($query, $search);

    public static function getTranslations($locale, $keyFormat);
}
