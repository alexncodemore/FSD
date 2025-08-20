<?php
require 'vendor/autoload.php';

try {
    $client = new MongoDB\Client('mongodb://localhost:27017');
    echo "MongoDB connection successful!";
    // List all databases
    foreach ($client->listDatabases() as $database) {
        echo "<br>Database: " . $database->getName();
    }
} catch (Exception $e) {
    echo "MongoDB connection failed: " . $e->getMessage();
}