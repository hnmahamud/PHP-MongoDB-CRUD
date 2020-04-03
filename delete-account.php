<?php

session_start();

require_once __DIR__ . "/vendor/autoload.php";

$collection = (new MongoDB\Client)->mongotest->users;
$collection2 = (new MongoDB\Client)->mongotest->notes;

$id = $_SESSION["id"];

$collection->deleteOne(['id' => $id]);
$collection2->deleteMany(['id' => $id]);

$_SESSION['success'] = "Account deleted successfully";
header("Location: landing-page.html");

?>