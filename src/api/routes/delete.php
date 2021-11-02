<?php

use Article\Article;

include_once                                                                            "../../core/initialize.php";
include_once                                                           "../../api/middleware/policies_articles.php";


header     ($ALLOW_DELETE);
header   ($ALLOWS_HEADERS);
header($CONTENT_TYPE_JSON);



if ($_SERVER["REQUEST_METHOD"] != "POST")                                                   die("Method not allowed");
if (!isset($_POST["token"]) || !isset($_POST["id"]) || !isset($_POST["author"]))               die("Invalid data :(");


$token                                                                                              = $_POST["token"];
$id                                                                                                    = $_POST["id"];
$author                                                                                            = $_POST["author"];

if (strlen($id) < 1)                                                                                 die("Id required");
if (strlen($author) < 1)                                                                         die("Author required");
if (strlen($token) < 150)                                                                   die("invalid access token");
if (!$an_validUser = isValidUser($token, $connection))                                              die("Access denied");
if ($an_validUser["id"] != $author)                                                              die("Access denied");


$article                                                                          = new Article($connection, $API_KEY);
$article->author                                                                                             = $author;
$article->id                                                                                                     = $id;
if (!$deleted = $article->delete())                                                               die("something wrong");

echo (json_encode($article));
