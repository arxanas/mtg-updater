<?php
namespace Framework;

class Slug {
    /**
     * Converts a slug, like foo-bar-baz, to a camel-cased name, like FooBarBaz.
     * @param  string $slug
     * @return string
     */
    public static function slugToName($slug) {
        $name = str_replace('-', ' ', $slug);
        $name = ucwords($name);
        $name = str_replace(' ', '', $name);
        return $name;
    }

    /**
     * Converts a camel-cased name, like FooBarBaz, to a slug, like foo-bar-baz.
     * @param  string $name
     * @return string
     */
    public static function nameToSlug($name) {
        $words = preg_split('/(?=[A-Z])/', $name);
        if ($words[0] === '') {
            array_shift($words);
        }
        return strtolower(implode('-', $words));
    }
}
