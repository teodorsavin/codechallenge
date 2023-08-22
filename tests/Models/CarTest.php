<?php

namespace Models;

use PHPUnit\Framework\TestCase;
use Temperworks\Codechallenge\Models\Car;

class CarTest extends TestCase
{
    public function testCanBeCreated()
    {
        $car = new Car('license-plate');
        $this->assertInstanceOf(Car::class, $car);
    }

    public function testCarLicensePlateIsSet()
    {
        $car = new Car('license-plate');
        $this->assertEquals('license-plate', $car->getLicensePlate());
    }
}
