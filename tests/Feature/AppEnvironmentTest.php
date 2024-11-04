<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function PHPUnit\Framework\assertTrue;

class AppEnvironmentTest extends TestCase {
    public function testAppEnv(){
        if(App::environment('testing')){
            self::assertTrue(true);
        }
    }
}


