<?php

require(realpath('vendor/autoload.php'));

// Path to the result source file
$file = realpath(dirname(__FILE__)
        .'/vendor/mauserrifle/simresults/tests/logs/assettocorsa-competizione'
        .DIRECTORY_SEPARATOR.'191003_235558_R.json');

// Check if the file exists
if (!file_exists($file)) {
    die("Error: File not found.");
}

try {
    // Get a reader using the source file
    $reader = \Simresults\Data_Reader::factory($file);

    // Get the first session. Note: Use `getSessions()` to get all sessions
    $session = $reader->getSession();
    $participants = $session->getParticipants();

    foreach ($participants as $participant) {
        $car = $participant->getVehicle()->getName();
        $best_lap = $participant->getBestLap()->getTime();
        $driver = $participant->getDriver()->getName();
        $laps = $participant->getNumberOfLaps();
        echo '<pre>';
        echo '|driver:';
        print_r($driver);
        echo '|car:';
        print_r($car);
        echo '|time:';
        print_r($best_lap);
        echo '|laps:';
        print_r($laps);
        echo '</pre>';   
      }
      //todo: connect this to database
} catch (\Exception $e) {
    // Handle general exceptions
    die("An error occurred: " . $e->getMessage());
}
