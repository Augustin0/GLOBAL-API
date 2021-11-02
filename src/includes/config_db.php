<?php

class DBconfig
{
   protected $db_user = "root";
   protected $db_pass = "";
   protected $db_host = "localhost:3308";
   protected $db_name = "api_what_new";
   protected $dsn;
   public $connection;
   public function __construct()
   {
      $this->dsn = "mysql:host=" . $this->db_host . ";dbname=" . $this->db_name . ";";
      if (!$this->connection) $this->connection = new PDO($this->dsn, $this->db_user, $this->db_pass);
   }

   public function get()
   {
      return $this->connection;
   }
}


$DB = new DBconfig();
$connection = $DB->get();
