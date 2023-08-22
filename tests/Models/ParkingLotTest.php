<?php

namespace Models;

use PHPUnit\Framework\TestCase;
use Temperworks\Codechallenge\Models\Car;
use Temperworks\Codechallenge\Models\ParkingLot;

class ParkingLotTest extends TestCase
{
    public function testIsFull()
    {
        $parkingLot = new ParkingLot(3);
        $this->assertFalse($parkingLot->isFull());

        $parkingLot->parkCar(new Car('ABC123'));
        $this->assertFalse($parkingLot->isFull());

        $parkingLot->parkCar(new Car('DEF456'));
        $parkingLot->parkCar(new Car('GHI789'));
        $this->assertTrue($parkingLot->isFull());
    }

    public function testIsEmpty()
    {
        $parkingLot = new ParkingLot(2);
        $this->assertTrue($parkingLot->isEmpty());

        $parkingLot->parkCar(new Car('ABC123'));
        $this->assertFalse($parkingLot->isEmpty());
    }

    public function testParkCar()
    {
        $parkingLot = new ParkingLot(2);

        $message1 = $parkingLot->parkCar(new Car('ABC123'));
        $this->assertEquals('Welcome, please go in', $message1);

        $message2 = $parkingLot->parkCar(new Car('DEF456'));
        $this->assertEquals('Welcome, please go in', $message2);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Sorry, no place left');
        $parkingLot->parkCar(new Car('GHI789'));
    }

    public function testLeaveCar()
    {
        $parkingLot = new ParkingLot(2);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('No car is parked on 0 spot.');
        $parkingLot->leaveCar(0);

        $car1 = new Car('ABC123');
        $car2 = new Car('DEF456');
        $parkingLot->parkCar($car1);
        $parkingLot->parkCar($car2);

        $message2 = $parkingLot->leaveCar(0);
        $this->assertEquals("Car with license plate 'ABC123' left. Another car can park now.", $message2);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("No car is parked on 1 spot.");
        $parkingLot->leaveCar(1);
    }

    public function testGetCapacity()
    {
        $parkingLot = new ParkingLot(5);
        $this->assertEquals(5, $parkingLot->getCapacity());
    }
}
