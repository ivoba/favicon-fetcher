<?php

namespace Ivoba\FaviconFetcher\Test\FileNameResolver;

use Ivoba\FaviconFetcher\FileNameResolver\DomainFileNameResolver;

class DomainFileNameResolverTest extends \PHPUnit_Framework_TestCase
{

    public function testGet()
    {
        $resolver  = new DomainFileNameResolver();
        $generated = $resolver->get('http://github.com');
        $this->assertEquals('github.com', $generated);
        $generated = $resolver->get('github.com');
        $this->assertEquals('github.com', $generated);
        $generated = $resolver->get('https://github.com/users/ivoba');
        $this->assertEquals('github.com', $generated);

        $resolver  = new DomainFileNameResolver($prefix = 'favicon.', $suffix = '.png');
        $generated = $resolver->get('http://github.com');
        $this->assertEquals('favicon.github.com.png', $generated);
        $generated = $resolver->get('github.com');
        $this->assertEquals('favicon.github.com.png', $generated);
        $generated = $resolver->get('https://github.com/users/ivoba');
        $this->assertEquals('favicon.github.com.png', $generated);
    }
} 