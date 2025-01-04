<?php

require __DIR__ . '/vendor/autoload.php'; // Load Composer's autoload

$app = require_once __DIR__ . '/bootstrap/app.php'; // Bootstrap the Laravel application

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Boot the application
$kernel->bootstrap();

// Define a stop flag file
$stopFlagFile = __DIR__ . '/stop-schedule.flag';

while (true) {
    // Check if the stop flag file exists
    if (file_exists($stopFlagFile)) {
        echo "Stop flag detected. Exiting script...\n";
        unlink($stopFlagFile); // Remove the flag file
        break; // Exit the loop
    }

    echo "[" . now() . "] Running schedule:run command\n";

    // Run the Laravel scheduler
    $kernel->call('schedule:run');

    // Sleep for 60 seconds before running again
    sleep(60);
}

echo "Script stopped gracefully.\n";
