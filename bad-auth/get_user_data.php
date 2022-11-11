<?php

header('Content-Type: application/json; charset=utf-8');

// Pretpostavimo ovakav sadržaj baze podataka...
$database_content = [
  "session1" => [
    "secret"      => "Ovo je tajni sadržaj kojemu smije pristupiti samo user1...",
  ],
  "session2" => [
    "secret"      => "Ovo je tajni sadržaj kojemu smije pristupiti samo user2...",
  ],
];

$session = $_GET["session_id"] ?? false;

if(!array_key_exists($session, $database_content)) {
  die(json_encode([
    "succes"  => false,
    "message" => "Session invalid"
  ]));
}

echo json_encode([
  "success" => true,
  "secret"  => $database_content[$session]["secret"]
]);