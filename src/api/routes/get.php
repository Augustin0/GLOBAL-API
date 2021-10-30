<?php

use Article\Article;

  include_once("../../core/initialize.php");
  
  header($ALLOW_ORIGIN);
  header($CONTENT_TYPE_JSON);
 
 if($_SERVER["REQUEST_METHOD"] =="GET"){
    
    $article=new Article($connection,$API_KEY);

    if(isset($_GET["q"]))        $article->q=htmlspecialchars(strip_tags($_GET["q"]));
    if(isset($_GET["at"]))      $article->at=htmlspecialchars(strip_tags($_GET["at"]));
    if(isset($_GET["to"]))      $article->to=htmlspecialchars(strip_tags($_GET["to"]));
    if(isset($_GET["lang"]))$article->lang=htmlspecialchars(strip_tags( $_GET["lang"]));
    if(isset($_GET["ctr"]))  $article->lang=htmlspecialchars(strip_tags( $_GET["ctr"]));
    
    $res=$article->get();
    
    echo json_encode(["res"=>["data"=>$res,"error"=>false]]);

 }else echo (json_encode(["res"=>["Message"=>"Method not supported","error"=>true]]));

?>