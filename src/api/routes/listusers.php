<?php

use UserManager\Author;

include_once("../../core/initialize.php");

header($ALLOW_ORIGIN);
header($CONTENT_TYPE_JSON);

if ($method = $_SERVER["REQUEST_METHOD"] != "GET")                die(json_encode(["message"=>"Mthos $method not allowed","error"=>true]));
$author                                                                                                          = new Author($connection);
$data                                                                                                              = $author->list_users();
if (!$data)                                                                    die(json_encode(["data" => [], "error" => false]));

echo (json_encode(["data" => $data, "error" => false]));
