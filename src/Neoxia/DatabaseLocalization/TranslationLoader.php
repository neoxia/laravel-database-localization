<?php

namespace Neoxia\DatabaseLocalization;

use Illuminate\Contracts\Translation\Loader;
use Neoxia\DatabaseLocalization\Translatable;

use Exception;

class TranslationLoader implements Loader
{
    /**
     * All of the namespace hints.
     *
     * @var array
     */
    protected $hints = [];

    /**
     * All of the registered paths to JSON translation files.
     *
     * @var string
     */
    protected $jsonPaths = [];

    /**
     * Load the specified translations group for the given locale and eventuallay the given namespace.
     *
     * @param  string  $locale
     * @param  string  $group
     * @param  string  $namespace
     * @return array
     */
    public function load($locale, $group, $namespace = null)
    {
        $model = config('database_localization.model');

        if (! in_array(Translatable::class, class_implements($model))) {
            throw new Exception("The class ".$model." should implement the interface ".Translatable::class);
        }

        if (is_null($namespace) || $namespace == '*' || isset($this->hints[$namespace])) {
            $keyFormat = $group.'.%';
        } else {
            return [];
        }

        return $model::getTranslations($locale, $keyFormat);
    }

    public function addNamespace($namespace, $hint)
    {
        $this->hints[$namespace] = $hint;
    }

    public function namespaces()
    {
        return $this->hints;
    }

    public function addJsonPath($path)
    {
        $this->jsonPaths[] = $path;
    }
}
