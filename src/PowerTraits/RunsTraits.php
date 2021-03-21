<?php

namespace Consolidated\PowerTraits;

use Consolidated\PowerTraits\Helpers\Instance;

trait RunsTraits
{
    use UsesTraits;

    /**
     * Tries running a method on all traits applied on the instance.
     * When an array of strings is defined in traitsOrder, that specified order will be used.
     *
     * @param string $methodName
     *
     * @return void
     */
    protected function onTraits(string $methodName): void
    {
        if (is_array($this->traitsOrder) && !empty($this->traitsOrder)) {
            $this->runOnTraits($methodName, $this->traitsOrder);

            return;
        }

        $this->runOnTraits($methodName, Instance::recursiveUses($this));
    }

    /**
     * Runs a specific function on all applied traits if the method exists.
     *
     * @param string $methodName
     * @param array  $traits
     *
     * @return void
     */
    protected function runOnTraits(string $methodName, array $traits): void
    {
        foreach ($traits as $trait) {
            $this->runTrait($methodName, $trait);
        }
    }
}
