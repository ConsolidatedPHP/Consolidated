<?php

namespace Consolidated\Tests\Unit\PowerTraits;

use Consolidated\PowerTraits\RunsTraits;
use Consolidated\Tests\Mocks\MockTrait;
use PHPUnit\Framework\TestCase;

class RunsTraitsTest extends TestCase
{
    use RunsTraits, MockTrait;

    protected $ran = [];

    /** @test */
    public function on_traits_will_run_the_methods_of_all_traits(): void
    {
        $this->flush();

        $this->onTraits('Example');

        $this->assertContains('exampleUsesTraits', $this->ran);
        $this->assertContains('exampleRunsTraits', $this->ran);
    }

    /** @test */
    public function on_traits_will_run_the_methods_in_a_specific_order_if_traits_order_is_specified(): void
    {
        $this->flush();

        $this->traitsOrder = [
            RunsTraits::class,
            MockTrait::class,
        ];

        $this->onTraits('Example');

        $this->assertEquals([
            'exampleRunsTraits',
            'exampleMockTrait',
        ], $this->ran);
    }

    /** @test */
    public function run_on_traits_will_run_the_methods_in_the_given_order(): void
    {
        $this->flush();

        $order = [
            MockTrait::class,
            RunsTraits::class,
        ];

        $this->runOnTraits('Example', $order);

        $this->assertEquals([
            'exampleMockTrait',
            'exampleRunsTraits',
        ], $this->ran);
    }

    protected function exampleUsesTraits(): void
    {
        $this->ran[] = 'exampleUsesTraits';
    }

    protected function exampleRunsTraits(): void
    {
        $this->ran[] = 'exampleRunsTraits';
    }

    protected function exampleMockTrait(): void
    {
        $this->ran[] = 'exampleMockTrait';
    }

    protected function flush(): void
    {
        $this->ran = [];
    }
}
