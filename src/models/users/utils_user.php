<?php

namespace  UserManager {

  use Firebase\JWT\JWT as JWT;

  class Utils
  {

    protected $query_post;
    protected $query_get_all;
    protected $query_put;


    public function __construct($table)
    {
      $this->query_post = "INSERT INTO  $table(name,lastname, ctr,lang,prov,mail,password,user_image)  VALUES(:name, :lastname, :ctr,  :lang,  :prov,  :mail,  :password,  :user_image)";
     
    }
    public function query_get ($table,$mail,$password){return "SELECT * FROM $table WHERE mail= $mail and  password= $password";}
    public function query_get_with_name($table,$mail,$name){return  "SELECT *  FROM $table WHERE mail= $mail and  name= $name";}
    public function query_get_all($table){return "SELECT *  FROM $table";}

    protected function genToken(array $user)
    {
      $data_time_out =
        [
          "exp" => time() + 10000,
          "iat" => time()
        ];
      $data_time_out += $user;
      $token = JWT::encode($data_time_out, "example_key", 'HS256', null, null);
      return $token;
    }

    protected function decoder(string $token)
    {
      $data = $token = JWT::decode($token, "example_key", array('HS256'));
      return $data;
    }

    protected function validateToken(string $token)
    {
      $data = $this->decoder($token);
      if (!$data) return ["valid" => 0, "data" => $data];
      if ($data->exp - time() < 0) {
        return ["valid" => 0, "data" => $data];
      } else return ["valid" => 1, "data" => $data];
    }
  }
}
