<?php

use GuzzleHttp\Psr7\UploadedFile;

function save_file($fieldName,$repos=""){

     if(!isset($_FILES[$fieldName]))return false;

     $valid_file_exten=[
        'image/png'=>  'png',
        'image/jpeg' =>  'jpe',
        'image/jpeg'=>  'jpeg',
        'image/jpeg' =>'jpg',
        'image/gif' => 'gif',
     ];
     $tmp=$_FILES[$fieldName]["tmp_name"];
     $type=$_FILES[$fieldName]["type"];
     if(isset($valid_file_exten[$type])){
       $type=$valid_file_exten[$type];
       $uniqName=hexdec(uniqid());
       $fileName=$uniqName.".".$type;
        move_uploaded_file($tmp,dirname(__DIR__)."/../public/img/$repos".$fileName);
       $url="https://news-api-global.herokuapp.com/src/public/img/$repos".$fileName;
        return ["url"=>$url,"origin"=>dirname(__DIR__)."/../public/img/$repos".$fileName];
     }else return false;
     
    

   }





?>