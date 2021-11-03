<?php

use UserManager\Author;

include_once("../../core/initialize.php");
include_once("../middleware/policies_articles.php");
include_once("../utils/savefile.php");

header($ALLOW_ORIGIN); //access conroll
header($ALLOW_POST); //access conroll
header($ALLOWS_HEADERS); //access conroll

$method = $_SERVER["REQUEST_METHOD"];

if ($method != "POST")                             die(json_encode([["message"=>"Method $method not allowed","error"=>true]]));

if (!validateFormRegist())                                        die(json_encode([["message"=>"Invald data","error"=>true]]));

$fileData                                                                                 =save_file("user_image", "users/");
if (!$fileData)                                  die(json_encode([["message"=>"Something wrong with the file","error"=>true]]));
$body                                                                                                                = $_POST;
$user                                                                                              =  new Author($connection);

$user->ctr              = $body["ctr"];
$user->name            = $body["name"];
$user->lang            = $body["lang"];
$user->prov            = $body["prov"];
$user->mail            = $body["mail"];
$user->lastname    = $body["lastname"];
$user->password    = $body["password"];
$user->user_image   = $fileData["url"];

$res                                                                                                         = $user->regist();

if ($res <= 0) {
  unlink($fileData["origin"]);
  die (json_encode([["message" => "profile required", "error" => true]]));
}

echo (json_encode([["message" => "Success", "error" => false]]));