<?php

use Article\Article;

include_once("../../core/initialize.php");

header($ALLOW_ORIGIN);
header($CONTENT_TYPE_JSON);

$method                                                                                            = $_SERVER["REQUEST_METHOD"];
if ($method != "GET")                                 die(json_encode(["message"=>"Mehod $method  not allowed","error"=>true]));

$article                                                                                    = new Article($connection, $API_KEY);
$validation                                   = (isset($_GET["q"]) && isset($_GET["lang"]) && isset($_GET["ctr"])) ? true :false;

if (!$validation)                                            die(json_encode(["message"=>"Parameters missing 1","error"=>true]));
$validation                      = (strlen($_GET["q"]) < 1 | strlen($_GET["lang"]) < 1 | strlen($_GET["ctr"]) < 1) ? false : true;
if (!$validation)                                             die(json_encode(["message"=>"Parameters missing 2","error"=>true]));
 
$article->q                                                                            = htmlspecialchars(strip_tags($_GET["q"]));
$article->lang                                                                      = htmlspecialchars(strip_tags($_GET["lang"]));
$article->ctr                                                                        = htmlspecialchars(strip_tags($_GET["ctr"]));
$res                                                                                                            = $article->get();

echo                                                                    json_encode(["res" => ["data" => $res, "error" => false]]);
