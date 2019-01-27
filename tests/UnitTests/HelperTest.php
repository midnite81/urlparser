<?php

namespace Midnite81\UrlParser\Tests\UnitTests;

use PHPUnit\Framework\TestCase;
use Midnite81\UrlParser\Url;

class HelperTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_an_instance_of_the_class()
    {
        $instance = urlparse('https://www.example.com');

        $this->assertInstanceOf(Url::class, $instance);
    }
}