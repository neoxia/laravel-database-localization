<?php

namespace Neoxia\DatabaseLocalization;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Translation\Translator as BaseTranslator;

class Translator extends BaseTranslator
{
    /**
     * Retrieve a language line out the loaded array.
     *
     * @param  string  $namespace
     * @param  string  $group
     * @param  string  $locale
     * @param  string  $item
     * @param  array   $replace
     * @return string|array|null
     */
    protected function getLine($namespace, $group, $locale, $item, array $replace)
    {
        $line = Arr::get($this->loaded[$namespace][$locale][$group], $group.'.'.$item);

        if (is_string($line)) {
            return $this->makeReplacements($line, $replace);
        }
    }

    /**
     * Load the specified language group.
     *
     * @param  string  $namespace
     * @param  string  $group
     * @param  string  $locale
     * @return void
     */
    public function load($namespace, $group, $locale)
    {
        if ($this->isLoaded($namespace, $group, $locale)) {
            return;
        }

        // The loader is responsible for returning the array of language lines for the
        // given namespace, group, and locale. We'll set the lines in this array of
        // lines that have already been loaded so that we can easily access them.
        $lines = $this->loader->load($locale, $group, $namespace);
        $this->loaded[$namespace][$locale][$group] = $lines;
    }

    /**
     * Determine if the given group has been loaded.
     *
     * @param  string  $namespace
     * @param  string  $group
     * @param  string  $locale
     * @return bool
     */
    protected function isLoaded($namespace, $group, $locale)
    {
        return isset($this->loaded[$namespace][$locale][$group]);
    }
}
