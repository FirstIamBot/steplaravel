<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class libraryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
        print 'testExample';
    }

    /**
     * A my test example.
     *
     * @return void
     */
    public function testFirst()
    {
        $this->visit('/')
            ->see('welcome');
    }
}