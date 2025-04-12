<?php
require 'vendor/autoload.php'; // Ensure Google Client is loaded

session_start();

$client = new Google_Client();


$client->setRedirectUri('http://localhost/BookStore/google_callback.php');
$client->addScope("email");
$client->addScope("profile");

$login_url = $client->createAuthUrl();

header("Location: $login_url");
exit();
?>

