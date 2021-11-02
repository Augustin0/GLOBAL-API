<?php

use Article\Article;

include_once("../../core/initialize.php");
header($ALLOW_ORIGIN);

header($CONTENT_TYPE_JSON);

$method                                                                                  = $_SERVER["REQUEST_METHOD"];
if ($method != "GET")                                                                die("Mehod $method  not allowed");

$article                                                                           = new Article($connection, $API_KEY);
$validation           = (isset($_GET["q"]) && isset($_GET["to"]) && isset($_GET["lang"]) && isset($_GET["ctr"])) ? true :false;

if (!$validation)                                                                             die("Parameters missing 1");
$validation   = (strlen($_GET["q"]) < 1 | strlen($_GET["to"]) < 1 | strlen($_GET["lang"]) < 1 | strlen($_GET["ctr"]) < 1) ? false : true;
if (!$validation)                                                                            die("Parameters missing 2");

$article->q                                                                  = htmlspecialchars(strip_tags($_GET["q"]));
$article->at                                                                = htmlspecialchars(strip_tags($_GET["at"]));
$article->to                                                                = htmlspecialchars(strip_tags($_GET["to"]));
$article->lang                                                           = htmlspecialchars(strip_tags($_GET["lang"]));
$article->ctr                                                            = htmlspecialchars(strip_tags($_GET["ctr"]));
$res                                                                                                  = $article->get();

echo                                                                json_encode(["res" => ["data" => $res, "error" => false]]);
