<?php
require(realpath('vendor/autoload.php'));

//  Path to the result source file
 $file = realpath(dirname(__FILE__)
         .'/vendor/mauserrifle/simresults/tests/logs/assettocorsa-competizione'
         .DIRECTORY_SEPARATOR.'191003_235558_R.json');
// Check if the file exists
 if (!file_exists($file)) {
     die("Error: File not found.");
 }
try {
    $client = new MongoDB\Client("mongodb://localhost:27017"); // Connect to your MongoDB server
    $collection = $client->SimRacing_Results->Times; // Select your database and collection
     $reader = \Simresults\Data_Reader::factory($file);
    // Get the first session. Note: Use `getSessions()` to get all sessions
     $session = $reader->getSession();
     $participants = $session->getParticipants();
     $track = $session->getTrack()->getFriendlyName();
    foreach ($participants as $participant) {
        $car = $participant->getVehicle()->getName();
        $best_lap = $participant->getBestLap()->getTime();
        $driver = $participant->getDriver()->getName();
        $driver_id = $participant->getDriver()->getDriverId();
        $filter = ["driver_id" => $driver_id, "Track" => $track];
        $update = [
            '$set' => [
                "car" => $car,
                "driver" => $driver,
                "best_lap" => $best_lap
            ],
            '$currentDate' => ["updatedAt" => true] // Set the updatedAt field to the current date and time
        ];
        $options = ['upsert' => true];
    
        $collection->updateOne($filter, $update, $options);
    } 
    echo(date("l jS \of F Y h:i:s A"));
    echo("Sucessfully Updated Entry");
} catch (\Exception $e) {
    // Handle general exceptions
    die("An error occurred: " . $e->getMessage());
} 
