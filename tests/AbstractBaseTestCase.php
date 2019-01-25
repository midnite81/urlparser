<?php

namespace Midnite81\UrlParser\Tests;

use Midnite81\UrlParser\Url;
use PHPUnit\Framework\TestCase;

abstract class AbstractBaseTestCase extends TestCase
{
    /**
     * @var Url
     */
    protected $url;

   protected function setUp()
   {
       parent::setUp();
       $this->url = Url::create('https://steve:password@www.example.com:80/green/houses?style=blue&type=brick#ajax=1');
   }
}