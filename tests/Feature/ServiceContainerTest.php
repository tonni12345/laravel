<?php

namespace Tests\Feature;

use App\Data\Foo;
use Tests\TestCase;
use App\Data\Person;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceContainerTest extends TestCase
{
    public function testDependencyInjection(){
        
        // yang biasa dilakukan
        // $foo = new Foo();

        // menggunakan service container
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }

    public function testBind(){
        $this->app->bind(Person::class, function($app){
            return new Person("Tonni", "Ramdani");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Tonni", $person1->firstName);
        self::assertEquals("Ramdani", $person2->lastName);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton(){
        $this->app->singleton(Person::class, function($app){
            return new Person("Tonni","Ramdani");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class); //object yang sama dengan yang diatas karena singleton
        
        self::assertEquals("Tonni", $person1->firstName);
        self::assertEquals("Ramdani", $person2->lastName);
        self::assertSame($person1, $person2);

    }
}
