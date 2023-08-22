<?php

require_once 'vendor/autoload.php';

use Temperworks\Codechallenge\Models\ParkingLot;
use Temperworks\Codechallenge\View\Interaction;

CONST DEFAULT_PARKING_CAPACITY = 10;

$parkingCapacity = getenv('PARKING_CAPACITY') ?: DEFAULT_PARKING_CAPACITY;

$parkingLot = new ParkingLot($parkingCapacity);
$interactiveParking = new Interaction($parkingLot);
$interactiveParking->run();