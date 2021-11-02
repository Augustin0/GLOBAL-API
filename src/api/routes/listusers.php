<?php

use UserManager\Author;

include_once("../../core/initialize.php");

header($ALLOW_ORIGIN);
header($CONTENT_TYPE_JSON);

if ($method = $_SERVER["REQUEST_METHOD"] != "GET")                   die("Mthos $method not allowed");
$author                                                                     = new Author($connection);
$data                                                                         = $author->list_users();
if (!$data)                       die(json_encode(["res" => ["message" => "No data", "error" => 0]]));

echo (json_encode(["res" => ["data" => $data, "error" => 1]]));
