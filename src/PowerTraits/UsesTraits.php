<?php

namespace Consolidated\PowerTraits;

trait UsesTraits
{
    protected array $traitsOrder = [];

    /**
     * Runs the function on the trait and returns the potential result.
     *
     * @param string $methodName
     * @param string $trait
     *
     * @return mixed
     */
    protected function runTrait(string $methodName, string $trait)
    {
        $method = $this->getTraitMethod($methodName, $trait);

        if (method_exists($this, $method)) {
            return call_user_func([$this, $method]);
        }
    }

    /**
     * Composes the function name that applies to the specified trait.
     *
     * @param string $methodName
     * @param string $class
     *
     * @return string
     */
    protected function getTraitMethod(string $methodName, string $class): string
    {
        return $methodName . basename(str_replace('\\', '/', $class));
    }
}
