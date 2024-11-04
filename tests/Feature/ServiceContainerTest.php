<?php

namespace Tests\Feature;

use App\Data\Bar;
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

    public function testInstance(){
        $person = new Person("Tonni", "Ramdani");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Tonni", $person1->firstName);
        self::assertEquals("Ramdani", $person2->lastName);
        self::assertSame($person, $person1);
        self::assertSame($person, $person2);
        self::assertSame($person1, $person2);
    }

    public function testDependencyInjectionService(){
        $this->app->singleton(Foo::class, function($app){
            return new Foo();
        });

        // membuat bar menjadi singleton juga tetapi dengan object yang kompleks karena ada parameternya maka dari itu kita buat dari variable $app

        $this->app->singleton(Bar::class, function($app){
            return new Bar($app->make(Foo::class));
        });


        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);


        self::assertEquals("Foo and Bar", $bar1->bar());
        self::assertSame($foo, $bar1->foo);

        self::assertSame($bar1, $bar2);
    }
}
