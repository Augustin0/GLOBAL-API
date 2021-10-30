<?php
//C:\xampp\htdocs\APIS\what_new_api\core
  
  defined("DS")?NULL:define("DS",DIRECTORY_SEPARATOR);
  defined("ROOT_DIR")?NULL:define("ROOT_DIR",DS."xampp".DS."htdocs".DS."APIS".DS."what_new_api".DS);
  defined("INC")?NULL:define("INC",ROOT_DIR."src".DS."includes".DS); 
  defined("COR")?NULL:define("COR",ROOT_DIR."src".DS."core".DS);
  defined("MODELS")?NULL:define("MODELS",ROOT_DIR."src".DS."models".DS);
  defined("PACK")?NULL:define("PACK",ROOT_DIR."vendor".DS);
  

  include_once(PACK."autoload.php");
  include_once(COR."initialize.php");
  include_once(INC."config_headers.php");
  include_once(INC."config_db.php");
  include_once(INC."fetch_api_config.php");
  include_once(MODELS.DS."users".DS."utils_user.php");
  include_once(MODELS.DS."users".DS."user.php");
  include_once(MODELS."utils_article.php");
  include_once(MODELS."new.php");




?>