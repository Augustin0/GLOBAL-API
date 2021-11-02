<?php

use Article\Article;

include_once("../../core/initialize.php");
include_once("../middleware/policies_articles.php");
include_once("../utils/savefile.php");

header($ALLOW_ORIGIN);
header($ALLOW_POST);
header($ALLOWS_HEADERS);


if ($_SERVER["REQUEST_METHOD"] != "POST")                                            die("Method not allowed");
if (!isset($_POST["token"]))                                                     die("Token acces required");
if (!isvalidForm() || !$author = isValidUser($_POST["token"], $connection))                 die("Bad request :(");
if (!$fileName = save_file("urlToImage", "articles/"))                    die("Something wrng with youre file");

$body                                                                                               = $_POST;

$article                                                                 = new Article($connection, $API_KEY);
$article->author                                                                             = $author["id"];
$article->title                                                                             = $body["title"];
$article->description                                                                 = $body["description"];
$article->url                                                                                 = $body["url"];
$article->content                                                                         = $body["content"];
$article->publishedAt                                                                 = $body["publishedAt"];
$article->lang                                                                               = $body["lang"];
$article->ctr                                                                             = $body["country"];
$article->urlToImage                                                                      = $fileName["url"];
$res                                                                                      = $article->post();
if ($res < 0) {
    echo (json_encode(["res" => ["message" => "", "error" => 4]]));
    unlink($fileName["origin"]);
    die("Something wrong ;(");
}
if ($res > 0)                                                                       echo ("Post successfuly :)");
