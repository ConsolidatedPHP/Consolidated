<?php

namespace Consolidated\PowerTraits\Helpers;

class Instance
{
    public static function recursiveUses(string | object $class): array
    {
        if (is_object($class)) {
            $class = $class::class;
        }

        $results = [];

        foreach (class_parents($class) + [$class => $class] as $parentClass) {
            $results += self::recursiveTraitUses($parentClass);
        }

        return array_unique($results);
    }

    protected static function recursiveTraitUses(string | object $class): array
    {
        if (is_object($class)) {
            $class = $class::class;
        }

        $results = class_uses($class) ?: [];

        foreach ($results as $parentTrait) {
            $results += self::recursiveTraitUses($parentTrait);
        }

        return $results;
    }
}
