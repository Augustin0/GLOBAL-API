<?php

 namespace UserManager{

use PDO;

class Author extends Utils{

      private   $conn;
      private $table="authors";
      private  $utils;
      //
      public $id;
      public $name;
      public $lastname;
      public $ctr;
      public $lang;
      public $prov;
      public $mail;
      public $password;
      public $token;
      public $user_image;

   
     public function __construct( $conn)
     {
         if(!$this->conn) $this->conn=$conn; 
         if(!$this->utils) $this->utils=new Utils($this->table);   

     }

     public function regist()
     {
       if(!$this->name|!$this->lastname|!$this->ctr|!$this->lang|!$this->prov|!$this->mail|!$this->password )return -1;
       //
       $prepare=$this->conn->prepare($this->utils->query_post);
       
       $this->            ctr=htmlspecialchars(strip_tags($this->ctr));
       $this->           mail=htmlspecialchars(strip_tags($this->mail));
       $this->           lang=htmlspecialchars(strip_tags($this->lang));
       $this->            name=htmlspecialchars(strip_tags($this->name));
       $this->    password=htmlspecialchars(strip_tags($this->password));
       $this->    lastname=htmlspecialchars(strip_tags($this->lastname));
       $this->    lastname=htmlspecialchars(strip_tags($this->lastname));
       $this-> user_image=htmlspecialchars(strip_tags($this->user_image));


       
       if($prepare){
        $prepare->bindParam(":ctr",                        $this->ctr);
        $prepare->bindParam(":name",                      $this->name);
        $prepare->bindParam(":lang",                      $this->lang);
        $prepare->bindParam(":prov",                      $this->prov);
        $prepare->bindParam(":mail",                       $this->mail);
        $prepare->bindParam(":password",               $this->password);
        $prepare->bindParam(":lastname",               $this->lastname);
        $prepare->bindParam(":user_image",            $this->user_image);

         if($prepare->execute()){
            return 1;
         }else return -2;

        }else return -3;

     }



     public function login()
     {
      
      if(!$this->mail | !$this->password)return -1;
      $prepare=$this->conn->prepare($this->utils->query_get);
      if($prepare){
        $prepare->bindParam(":mail",$this->mail);
        $prepare->bindParam(":password",$this->password);
        if($prepare->execute()){
           $row =$prepare->fetch(PDO::FETCH_ASSOC);
           extract($row);
           return $this->utils->genToken(["mail"=>$mail,"name"=>$name]);
        }else return -2;
         
      }else return -3;
   
     }

    

    function validateUser()
    {
      if(!$this->token)return -1;
      $data= $this->utils->validateToken($this->token);
      if(!$data["valid"])return -2;
      $this->mail=$data["data"]->mail;
      $this->name=$data["data"]->name;
      if(!$this->mail | !$this->name)return -3;
      $prepare=$this->conn->prepare($this->utils->query_get_with_name);
      if($prepare){
        $prepare->bindParam(":mail",$this->mail);
        $prepare->bindParam(":name",$this->name);
        if($prepare->execute()){
           $row =$prepare->fetch(PDO::FETCH_ASSOC);
           extract($row);
           if(($name==$this->name )and( $mail==$this->mail)){
             return ["name"=>$name,"mail"=>$mail,"id"=>$id,"user_image"=>$user_image];
           }else return -4;
        }else return -5;
      }else return -6;
    }

    public function list_users()
    {
        $list_users=[];
        $prepare=$this->conn->prepare($this->utils->query_get_all);
        if($prepare){
          if($prepare->execute()){
            while ($row=$prepare->fetch(PDO::FETCH_ASSOC)) {
              extract($row);
               $data=[
                "ctr"=>$ctr,
                "id"=>$id,
                "name"=>$name,
                "lang"=>$lang,
                "prov"=>$prov,
                "mail"=>$mail,
                "lastname"=>$lastname,
                "user_image"=>$user_image
              ];
              array_push($list_users,$data);
            }
            return $list_users;
          }else return 0;


        }else  return 0;
    }



   }






















 }











?>