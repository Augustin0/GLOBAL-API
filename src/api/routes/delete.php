<?php

use Article\Article;

include_once                                                                            "../../core/initialize.php";
include_once                                                           "../../api/middleware/policies_articles.php";


header     ($ALLOW_DELETE);
header   ($ALLOWS_HEADERS);
header($CONTENT_TYPE_JSON);



if ($_SERVER["REQUEST_METHOD"] != "POST")                                   die(json_encode(["message"=>"Method not allowed","error"=>true]));
if (!isset($_POST["token"]) || !isset($_POST["id"]) || !isset($_POST["author"])) die(json_encode(["message"=>"Invalid data :(","error"=>true]));


$token                                                                                                                      = $_POST["token"];
$id                                                                                                                            = $_POST["id"];
$author                                                                                                                    = $_POST["author"];
 
if (strlen($id) < 1)                                                               die(json_encode(["message"=>"Id required","error"=>true]));
if (strlen($author) < 1)                                                       die(json_encode(["message"=>"Author required","error"=>true]));
if (strlen($token) < 150)                                                 die(json_encode(["message"=>"invalid access token","error"=>true]));
if (!$an_validUser = isValidUser($token, $connection))                           die(json_encode(["message"=>"Access denied","error"=>true]));
if ($an_validUser["id"] != $author)                                              die(json_encode(["message"=>"Access denied","error"=>true]));


$article                                                                                                 = new Article($connection, $API_KEY);
$article->author                                                                                                                    = $author;
$article->id                                                                                                                            = $id;
if (!$deleted = $article->delete())                                             die(json_encode(["message"=>"something wrong","error"=>true]));

echo (json_encode(["message"=>"Successfuly delered","error"=>false]));
