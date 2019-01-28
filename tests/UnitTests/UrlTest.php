<?php

namespace Midnite81\UrlParser\Tests\UnitTests;

use Midnite81\UrlParser\Tests\AbstractBaseTestCase;

class UrlTest extends AbstractBaseTestCase
{
    /**
     * @test
     */
    public function it_returns_an_array_for_all()
    {
        $all = $this->url->all();

        $this->assertIsArray($all);
    }
    
    /** 
     * @test 
     */
    public function it_returns_each_key_part_of_the_url()
    {
        $all = $this->url->all();

        $this->assertArrayHasKey('scheme', $all);
        $this->assertArrayHasKey('host', $all);
        $this->assertArrayHasKey('port', $all);
        $this->assertArrayHasKey('user', $all);
        $this->assertArrayHasKey('pass', $all);
        $this->assertArrayHasKey('path', $all);
        $this->assertArrayHasKey('query', $all);
        $this->assertArrayHasKey('fragment', $all);
    }
    
    /** 
     * @test 
     */
    public function it_returns_each_value_part_of_the_url()
    {
        $all = $this->url->all();

        $this->assertEquals('https', $all['scheme']);
        $this->assertEquals('www.example.com', $all['host']);
        $this->assertEquals('80', $all['port']);
        $this->assertEquals('steve', $all['user']);
        $this->assertEquals('password', $all['pass']);
        $this->assertEquals('/green/houses', $all['path']);
        $this->assertEquals('style=blue&type=brick', $all['query']);
        $this->assertEquals('ajax=1', $all['fragment']);
    }

    /**
     * @test
     */
    public function it_can_retrieve_each_part_using_get()
    {
        $this->assertEquals('https', $this->url->get('scheme'));
        $this->assertEquals('www.example.com', $this->url->get('host'));
        $this->assertEquals('80', $this->url->get('port'));
        $this->assertEquals('steve', $this->url->get('user'));
        $this->assertEquals('password', $this->url->get('pass'));
        $this->assertEquals('/green/houses', $this->url->get('path'));
        $this->assertEquals('style=blue&type=brick', $this->url->get('query'));
        $this->assertEquals('ajax=1', $this->url->get('fragment'));
    }

    /**
     * @test
     */
    public function it_can_retrieve_each_part_using_named_get_functions()
    {
        $this->assertEquals('https', $this->url->scheme());
        $this->assertEquals('www.example.com', $this->url->host());
        $this->assertEquals('80', $this->url->port());
        $this->assertEquals('steve', $this->url->user());
        $this->assertEquals('password', $this->url->pass());
        $this->assertEquals('/green/houses', $this->url->path());
        $this->assertEquals('style=blue&type=brick', $this->url->query());
        $this->assertEquals('ajax=1', $this->url->fragment());
    }

    /**
     * @test
     */
    public function it_returns_null_if_a_get_doesnt_exist()
    {
        $this->assertNull($this->url->get('something'));
    }
    
    /** 
     * @test 
     */
    public function it_returns_json()
    {
        $this->assertIsString($this->url->json());
    }

    /**
     * @test
     */
    public function it_returns_the_query_string_with_a_question_mark()
    {
        $queryString = $this->url->query(true);

        $this->assertContains('?', $queryString);
    }

    /**
     * @test
     */
    public function it_returns_the_fragment_with_a_hash()
    {
        $fragment = $this->url->fragment(true);

        $this->assertContains('#', $fragment);
    }


    /**
     * @test
     */
    public function it_returns_an_array_of_segments()
    {
        $segments = $this->url->segments();

        $this->assertIsArray($segments);
    }

    /**
     * @test
     */
    public function it_returns_the_correct_segments()
    {
        $segments = $this->url->segments();

        $this->assertEquals('green', $segments[0]);
        $this->assertEquals('houses', $segments[1]);
    }

    /**
     * @test
     */
    public function it_returns_the_correct_segment()
    {
        $this->assertEquals('green', $this->url->segment(1));
        $this->assertEquals('houses', $this->url->segment(2));
    }

    /**
     * @test
     */
    public function it_returns_an_encoded_version_of_the_url()
    {
        $this->assertEquals('https%3A%2F%2Fsteve%3Apassword%40www.example.com%3A80%2Fgreen%2Fhouses%3Fstyle%3Dblue%26type%3Dbrick%23ajax%3D1', $this->url->encode());
    }

    /**
     * @test
     * @expectedException \Midnite81\UrlParser\Exceptions\ParameterMustBeGreaterThanZeroException
     */
    public function it_throws_an_exception_if_less_than_one()
    {
       $this->url->encode(0);
    }
    
    /** 
     * @test 
     */
    public function it_returns_a_double_encoded_version_of_the_url()
    {
        $this->assertEquals('https%253A%252F%252Fsteve%253Apassword%2540www.example.com%253A80%252Fgreen%252Fhouses%253Fstyle%253Dblue%2526type%253Dbrick%2523ajax%253D1', $this->url->doubleEncode());
    }
    
    /** 
     * @test 
     */
    public function it_returns_a_query_array()
    {
        $query = $this->url->queryArray();

        $this->assertIsArray($query);
    }

    /**
     * @test
     */
    public function it_returns_the_correct_query_array_values()
    {
        $query = $this->url->queryArray();

        $this->assertArrayHasKey('style', $query);
        $this->assertArrayHasKey('type', $query);

        $this->assertEquals('blue', $query['style']);
        $this->assertEquals('brick', $query['type']);
    }

    /**
     * @test
     */
    public function it_returns_null_if_a_query_parameter_is_not_found()
    {
        $this->assertNull($this->url->getQueryValue('something'));
    }

    /**
     * @test
     */
    public function it_returns_the_correct_fragment_array_values()
    {
        $fragment = $this->url->fragmentArray();

        $this->assertArrayHasKey('ajax', $fragment);
        $this->assertEquals('1', $fragment['ajax']);
    }

    /**
     * @test
     */
    public function it_gets_value_of_query_string_key()
    {
        $this->assertEquals('blue', $this->url->getQueryValue('style'));
        $this->assertEquals('brick', $this->url->getQueryValue('type'));
    }

    /**
     * @test
     */
    public function it_gets_null_on_unfound_query_string()
    {
        $this->assertNull($this->url->getHashValue('something'));
    }

    /**
     * @test
     */
    public function it_gets_value_of_hash_key()
    {
        $this->assertEquals('1', $this->url->getHashValue('ajax'));
    }
}