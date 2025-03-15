<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testEnv()
    {
        $appName = env("YOUTUBE");

        selfe::assertEquals("Programmer Zaman Now", $appName);
    }

    public function testDefaultValue()
    {
    $author = env("AUTHOR", "Eko");

    self::assertEquals("Eko", $author);
    }
}