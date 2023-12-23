<?php
$pharFile = 'pro.phar';

if (file_exists($pharFile)) {
    unlink($pharFile);
}

$phar = new Phar($pharFile);
$phar->startBuffering();

$files = [
    '../Sign-Up/SignUp.php',
    '../Manage Account/ManageAccountUseCase.php',
    '../Log-in/Login.php',
    '../DbConnection.php'
];


foreach ($files as $file) {
    // Use the basename of the file as the internal path in the archive.
    $phar->addFile($file, basename($file));
}

// Set the main file (entry point).
$phar->setStub($phar->createDefaultStub('main.php'));

$phar->stopBuffering();
echo 'PHAR archive created successfully.';
?>
