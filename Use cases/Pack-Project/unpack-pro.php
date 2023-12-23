<?php

// Replace 'your_archive.phar' with the name of your Phar file
$pharFile = 'pro.phar';

try {
    // Create a Phar object from the Phar file
    $phar = new Phar($pharFile);

    // Replace 'extracted_folder' with the desired destination folder
    $destination = 'extracted';

    // Extract the contents of the Phar file to the destination folder
    $phar->extractTo($destination);

    echo "Phar file unpacked successfully to $destination\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

?>

