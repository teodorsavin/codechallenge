<?php

namespace Temperworks\Codechallenge\View;

use Temperworks\Codechallenge\Models\Car;
use Temperworks\Codechallenge\Models\ParkingLot;

class Interaction
{
    private const COLOR_RED = "\033[0;31m";
    private const COLOR_GREEN = "\033[0;32m";
    private const COLOR_RESET = "\033[0m";

    public function __construct(private ParkingLot $parkingLot)
    {
    }

    public function run(): void
    {
        $this->print("Welcome to the Parking Lot System!");
        $this->print("Maximum capacity: " . $this->parkingLot->getCapacity());

        while (true) {
            $this->printOptions();

            $choice = (int) readline("Enter your choice: ");

            try {
                match ($choice) {
                    1 => $this->parkCar(),
                    2 => $this->leaveCar(),
                    3 => $this->listParkedCars(),
                    4 => $this->exit(),
                    default => $this->invalid(),
                };
            } catch (\Exception $e) {
                // Handle and print exceptions in red color
                $this->print($e->getMessage(), self::COLOR_RED);
            }
        }
    }

    private function printOptions(): void
    {
        $this->print('');
        $this->print('Options:');
        $this->print('1. Park a car');
        $this->print('2. Remove a car');
        $this->print('3. List parked cars');
        $this->print('4. Exit');
        $this->print('');
    }

    // Print message with color formatting
    private function print(string $message, string $color = self::COLOR_RESET): void
    {
        echo $color . $message . self::COLOR_RESET . PHP_EOL;
    }

    private function exit(): void
    {
        $this->print('Exiting. Goodbye!');
        exit;
    }

    private function invalid(): void
    {
        $this->print('Invalid choice. Please select a valid option.');
    }

    private function parkCar(): void
    {
        try {
            $licensePlate = readline("Enter the license plate of the car you want to park: ");
            $car = new Car($licensePlate);

            $message = $this->parkingLot->parkCar($car);
            $this->print($message, self::COLOR_GREEN);
        } catch (\Exception $e) {
            // Rethrow the exception
            throw $e;
        }
    }

    private function leaveCar(): void
    {
        // Fail early if parking lot is empty
        if ($this->parkingLot->isEmpty()) {
            throw new \Exception("Parking lot is already empty.");
        }

        try {
            $spotIndex = (int) readline("Enter the spot index of the car you want to leave: ");
            $message = $this->parkingLot->leaveCar($spotIndex);
            $this->print($message);
        } catch (\Exception $e) {
            // Rethrow the exception
            throw $e;
        }
    }

    private function listParkedCars(): void
    {
        // Fail early if parking lot is empty
        if ($this->parkingLot->isEmpty()) {
            throw new \Exception("Parking lot is empty.");
        }

        $parkedCars = $this->parkingLot->getParkedCars();
        foreach ($this->parkingLot->getParkedCars() as $parkingSpot => $car) {
            $this->print('Spot ' . $parkingSpot . ' - ' . $car->getLicensePlate());
        }
    }
}
