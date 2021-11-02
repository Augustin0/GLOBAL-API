<?php

use UserManager\Author;


function isvalidForm(){
    $body=$_POST;
    if(!isset($body["author"])|!isset($body["title"])|!isset($body["description"])|!isset($body["url"])|!isset($body["content"])|!isset($body["publishedAt"])|!isset($body["lang"])|!isset($body["country"]) ){
        return false;
    }else if(strlen($body["author"])<1|strlen($body["title"])<1|strlen($body["description"])<1|strlen($body["url"])<1|strlen($body["content"])<1|strlen($body["publishedAt"])<1|strlen($body["lang"])<1|strlen($body["country"])<1){
        return false;
    }
    else{
        return true;
    }
};

  function isValidUser($token, $conn){
       $author= new Author($conn);
       $author->token=$token;
       $res=$author->validateUser();
       if(!$res)return 0;
       else return $res;
    }

    function validateFormLogin(){
        $body=$_POST;
        if(!isset($body["mail"])|!isset($body["password"]))return 0;
        else if( strlen($body["mail"])<1 | strlen($body["password"]) <1)return 0;
        else return 1;
    }
    
    function validateFormRegist(){
        $body=$_POST;
        if(!isset($body["name"])|!isset($body["lastname"])|!isset($body["ctr"])|!isset($body["lang"])|!isset($body["prov"])|!isset($body["mail"])|!isset($body["password"]))return 0;
        else if(strlen($body["name"])<1|strlen($body["lastname"])<1|strlen($body["ctr"])<1|strlen($body["lang"])<1|strlen($body["prov"])<1|strlen($body["mail"])<1|strlen($body["password"])<1)return 0;
        else return 1;
    }
?>