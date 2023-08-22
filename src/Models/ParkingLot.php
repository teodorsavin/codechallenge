<?php

namespace Temperworks\Codechallenge\Models;

class ParkingLot
{
    private int $occupiedSpots;
    private array $parkedCars;

    public function __construct(private int $capacity)
    {
        $this->occupiedSpots = 0;
        $this->parkedCars = [];
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function isFull(): bool
    {
        return $this->occupiedSpots >= $this->capacity;
    }

    public function isEmpty(): bool
    {
        return $this->occupiedSpots <= 0;
    }

    public function parkCar(Car $car): string
    {
        if ($this->isFull()) {
            throw new \Exception("Sorry, no place left");
        }

        $this->occupiedSpots++;
        $this->parkedCars[] = $car;
        return "Welcome, please go in";
    }

    public function leaveCar(int $spotIndex): string
    {
        if ($this->occupiedSpots > 0 && isset($this->parkedCars[$spotIndex])) {
            $this->occupiedSpots--;
            $leftCar = $this->parkedCars[$spotIndex];
            unset($this->parkedCars[$spotIndex]);
            // Reset array keys
            $this->parkedCars = array_values($this->parkedCars);

            return "Car with license plate '{$leftCar->getLicensePlate()}' left. Another car can park now.";
        } else {
            throw new \Exception("No car is parked on {$spotIndex} spot.");
        }
    }

    public function getParkedCars(): array
    {
        return $this->parkedCars;
    }
}
