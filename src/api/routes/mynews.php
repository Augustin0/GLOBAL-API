<?php

use Article\Article;
use UserManager\Author;

include_once("../../core/initialize.php");

header($ALLOW_ORIGIN);
header($CONTENT_TYPE_JSON);

$method                                                                       = $_SERVER["REQUEST_METHOD"];
if ($method != "GET")          die(json_encode([["message"=>"Method $method not allowed","error"=>true]]));
if (!isset($_GET["token"]))     die(json_encode([["message" => "Token access required", "error" => true]]));
$token                                                                                     = $_GET["token"];
if (strlen($token) < 150)             die(json_encode([["message"=>"invalid access token","error"=>true]]));

$user                                                                             = new Author($connection);
$user->token                                                                                       = $token;
$user_data                                                                          = $user->validateUser();

if (!$user_data)                              die(json_encode([["message"=>"Access denied","error"=>true]]));

$article                                                                = new Article($connection, $API_KEY);
$article->author                                                                          = $user_data["id"];
$my_news                                                                             = $article->getMynews();

echo json_encode([["data" => $my_news, "error" => false]]);
