<?php

header('Content-Type: application/json; charset=utf-8');

// Pretpostavimo ovakav sadržaj baze podataka...
$database_content = [
  "user1" => [
    "password"    => "1234",
    "session_id"  => "session1"
  ],
  "user2" => [
    "password"    => "123",
    "session_id"  => "session2"
  ],
];

$username = $_GET["username"] ?? false;
$password = $_GET["password"] ?? false;

if(!array_key_exists($username, $database_content)) {
  die(json_encode([
    "succes" => false,
    "message" => "Username doesn't exist"
  ]));
}

if($database_content[$username]["password"] !== $password) {
  die(json_encode([
    "succes" => false,
    "message" => "Password doesn't match"
  ]));
}

// Uspjesna autentifikacija
echo json_encode([
  "success" => true,
  "session" => $database_content[$username]["session_id"]
]);
