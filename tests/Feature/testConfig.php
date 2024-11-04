<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class testConfig extends TestCase
{
    public function testConfig(){
        $firstname = config('contoh.author.first');
        $lastname = config('contoh.author.last');
        $email = config('contoh.email');
        $web = config('contoh.web');


        self::assertEquals("dadang", $firstname);
        self::assertEquals("Ramdaffgjhni", $lastname);
        self::assertEquals("tonniramdani@gmail.com", $firstname);
        self::assertEquals("https://tonni12345.git", $firstname);
    }
}
