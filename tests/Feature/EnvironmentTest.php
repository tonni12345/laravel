<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Env;
use function PHPUnit\Framework\assertEquals;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EnvironmentTest extends TestCase
{
    public function testGetEnv(){
        $youtube = env('YOUTUBE');
        self::assertEquals('Programmer Zaman Now', $youtube);

        // Default Environment Value
        $author = Env::get('author', 'Eko');
        self::assertEquals('Eko', $author);
    }
}
