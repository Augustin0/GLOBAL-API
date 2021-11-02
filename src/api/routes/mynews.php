<?php

use Article\Article;
use UserManager\Author;

include_once("../../core/initialize.php");

header($ALLOW_ORIGIN);
header($CONTENT_TYPE_JSON);

$method                                                   = $_SERVER["REQUEST_METHOD"];
if ($method != "GET")                               die("Method $method not allowed");
if (!isset($_GET["token"])) die(json_encode(["res" => ["data" => [], "error" => 1]]));
$token                                                               = $_GET["token"];
if (strlen($token) < 150)                                 die("invalid access token");

$user                                                       = new Author($connection);
$user->token                                                                 = $token;
$user_data                                                    = $user->validateUser();

if (!$user_data)                                                 die("Access denied");

$article                                          = new Article($connection, $API_KEY);
$article->author                                                    = $user_data["id"];
$my_news                                                       = $article->getMynews();

echo json_encode(["res" => ["data" => $my_news, "error" => 0]]);
