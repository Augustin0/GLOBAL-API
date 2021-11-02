<?php

use UserManager\Author;

include_once("../../core/initialize.php");
include_once("../middleware/policies_articles.php");
include_once("../utils/savefile.php");

header($ALLOW_ORIGIN); //access conroll
header($ALLOW_POST); //access conroll
header($ALLOWS_HEADERS); //access conroll

$method = $_SERVER["REQUEST_METHOD"];

if ($method != "POST")                                                 die("Method $method not allowed");

if (!validateFormRegist())                                                            die("Invald data");

$fileData                                                              =save_file("user_image", "users/");
if (!$fileData)                                                      die("Something wrong with the file");
$body                                                                                            = $_POST;
$user                                                                           = new Author($connection);

$user->ctr              = $body["ctr"];
$user->name            = $body["name"];
$user->lang            = $body["lang"];
$user->prov            = $body["prov"];
$user->mail            = $body["mail"];
$user->lastname    = $body["lastname"];
$user->password    = $body["password"];
$user->user_image   = $fileData["url"];

$res                                                                                    = $user->regist();

if ($res <= 0) {
  unlink($fileData["origin"]);
  die (json_encode(["res" => ["message" => "profile required", "error" => 2]]));
}

echo (json_encode(["res" => ["message" => "Success", "error" => 1]]));
