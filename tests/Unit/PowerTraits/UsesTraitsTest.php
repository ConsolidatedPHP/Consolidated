<?php

namespace Consolidated\Tests\Unit\PowerTraits;

use Consolidated\PowerTraits\UsesTraits;
use PHPUnit\Framework\TestCase;

class UsesTraitsTest extends TestCase
{
    use UsesTraits;

    protected bool $ran = false;

    /** @test */
    public function get_trait_method_will_prefix_the_trait_with_the_method_by_default_with_namespaced_traits(): void
    {
        $this->assertEquals(
            'exampleTestTrait',
            $this->getTraitMethod('example', '\Consolidated\Tests\TestTrait')
        );
    }

    /** @test */
    public function get_trait_method_will_prefix_the_trait_with_the_method_by_default_with_non_namespaced_traits(): void
    {
        $this->assertEquals(
            'exampleTestTrait',
            $this->getTraitMethod('example', 'TestTrait')
        );
    }

    /** @test */
    public function run_trait_will_run_the_method_on_the_insance_if_it_exists(): void
    {
        $this->runTrait('void', 'TestTrait');
        $this->assertTrue($this->ran);
    }

    /** @test */
    public function run_trait_will_not_run_the_function_if_it_does_not_exist(): void
    {
        $this->runTrait('::DOES_NOT_EXIST::', 'TestTrait');
        $this->assertTrue(true);
    }

    /** @test */
    public function run_trait_will_return_null_when_no_result_is_provided(): void
    {
        $this->assertNull(
            $this->runTrait('void', 'TestTrait')
        );
    }

    /** @test */
    public function run_trait_will_return_a_result_when_a_resulit_is_provided(): void
    {
        $this->assertEquals(
            '::RESULT::',
            $this->runTrait('result', 'TestTrait')
        );
    }

    protected function resultTestTrait(): string
    {
        return '::RESULT::';
    }

    protected function voidTestTrait(): void
    {
        $this->ran = true;
    }
}
