<?php

use UserManager\Author;


function isvalidForm(){
    $body=$_POST;
    if(!isset($body["author"])|!isset($body["title"])|!isset($body["description"])|!isset($body["url"])|!isset($body["content"])|!isset($body["publishedAt"])|!isset($body["lang"])|!isset($body["country"]) ){
        return false;
    }else if(!$body["author"]|!$body["title"]|!$body["description"]|!$body["url"]|!$body["content"]|!$body["publishedAt"]|!$body["lang"]|!$body["country"]){
        return false;
    }else{
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
        else if(!$body["mail"]|!$body["password"])return 0;
        else return 1;
    }
    
    function validateFormRegist(){
        $body=$_POST;
        if(!isset($body["name"])|!isset($body["lastname"])|!isset($body["ctr"])|!isset($body["lang"])|!isset($body["prov"])|!isset($body["mail"])|!isset($body["password"]))return 0;
        else if(!$body["name"]|!$body["lastname"]|!$body["ctr"]|!$body["lang"]|!$body["prov"]|!$body["mail"]|!$body["password"])return 0;
        else return 1;
    }
?>