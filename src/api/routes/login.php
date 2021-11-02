<?php

use UserManager\Author;

include_once("../../core/initialize.php");
include_once("../middleware/policies_articles.php");
include_once("../utils/savefile.php");

header($ALLOW_ORIGIN);
header($ALLOW_POST);
header($ALLOWS_HEADERS);

$method                                                                = $_SERVER["REQUEST_METHOD"];
if ($method != "POST")                                              die("Method $method not allowed");
if (!validateFormLogin())                                                      die("Access denied");

$body                                                                                      = $_POST;
$user                                                                     = new Author($connection);
$user->mail                                                                         = $body["mail"];
$user->password                                                                 = $body["password"];
$res                                                                               = $user->login();
if (!$res)                                                                    die("Somthing wrong");
echo (json_encode(["res" => ["token" => $res, "error" => false]]));
