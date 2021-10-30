<?php

use Article\Article;

include_once("../../core/initialize.php");
include_once("../middleware/policies_articles.php");
include_once("../utils/savefile.php");

header($ALLOW_ORIGIN);//access conroll
header($ALLOW_POST);//access conroll
header($ALLOWS_HEADERS);//access conroll


if($_SERVER["REQUEST_METHOD"]=="POST")
{    $author;
    if(!isset($_POST["token"])){
        echo(json_encode(["res"=>["message"=>"","error"=>0]]));
       
    }else if(!isvalidForm()||!$author=isValidUser($_POST["token"],$connection))
    {
        echo(json_encode(["res"=>["message"=>"","error"=>2]]));
        
    }else{

    $fileName=save_file("urlToImage","articles/");
    $body=$_POST;
    if($fileName){

        $article=new Article($connection,$API_KEY);

        $article->author            =$author["id"];
        $article->title            =$body["title"];
        $article->description=$body["description"];
        $article->url                =$body["url"];
        $article->content        =$body["content"];
        $article->publishedAt=$body["publishedAt"];
        $article->lang              =$body["lang"];
        $article->ctr            =$body["country"];
        $article->urlToImage     =$fileName["url"];
        
        $res= $article->post();

         if($res>0){
            echo(json_encode(["res"=>["message"=>"New news added successfuly","error"=>3]]));
             
         }else {
            echo(json_encode(["res"=>["message"=>"","error"=>4]]));
            unlink($fileName["origin"]);
           
         } ;

        

    }else echo(json_encode(["res"=>["message"=>"","error"=>5]]));



        
    }
  
 

} else  {
    echo(json_encode(["res"=>["message"=>"","error"=>6]]));

  
}



















?>