<?php

session_start();

require_once __DIR__ . "/vendor/autoload.php";

$collection = (new MongoDB\Client)->mongotest->notes;

$collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);

$_SESSION['success'] = "Book deleted successfully";
header("Location: index.php");

?>
