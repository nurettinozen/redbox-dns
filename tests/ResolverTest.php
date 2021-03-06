<?php
namespace Redbox\DNS\Tests;
use Redbox\DNS\Resolver as Resolver;

class ResolverTest extends \PHPUnit_Framework_TestCase
{
    public function test_resolve_returns_false_on_empty_string()
    {
        $resolver = new Resolver;
        $this->assertFalse($resolver->resolve(''));
        unset($resolver);
    }

    public function test_resolve_returns_false_on_error()
    {
        $resolver = new Resolver;
        $this->assertFalse($resolver->resolve('i dont exist'));
        unset($resolver);
    }

    public function test_resolve_returns_true_on_success()
    {
        $resolver = new Resolver;
        $this->assertTrue($resolver->resolve('php.net'));
        unset($resolver);
    }

    /**
     * @depends test_resolve_returns_true_on_success
     */
    public function test_resolve_returns_has_records_on_success()
    {
        $resolver = new Resolver;
        $resolver->resolve('php.net');
        $this->assertTrue(($resolver->count() > 0));
        unset($resolver);
    }

    public function test_clear_actually_clears_the_array()
    {
        $resolver = new Resolver;
        $resolver->append(1);
        $this->assertEquals(1, $resolver->count());
        $resolver->clear();
        $this->assertEquals(0, $resolver->count());
    }
}
