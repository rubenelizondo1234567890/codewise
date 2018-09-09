<?php
/*
 * Index file
 */

//------------------------------------------------
// Basic autoloader
include 'autoloader.php';

$app = new services\router();

$app->run();

$app->shutdown();

?>