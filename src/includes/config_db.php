<?php

class DBconfig
{
  
   protected $dsn;
   public $connection;
   public function __construct()
   { 
      $user =getenv()["DB_USER"];//getenv("DB_USER");
      $password = getenv()["DB_PASS"];//getenv("DB_PASS");
      $db_host = getenv()["DB_HOST"] ;//getenv("DB_HOST");
      $db_name =getenv()["DB_NAME"];// getenv("DB_NAME");
      $dbtype=getenv()["DB_TYPE"];
      $this->dsn = "$dbtype:host=$db_host;dbname=$db_name;";
      if (!$this->connection) $this->connection = new PDO($this->dsn,$user,"");
   }

   public function get()
   {
      return $this->connection;
   }
}


$DB = new DBconfig();
$connection = $DB->get();
