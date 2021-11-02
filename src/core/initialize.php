<?php
//local :C:\xampp\htdocs\APIS\what_new_api\core
//REMOTE :
/*defined("DS") ? NULL : define("DS", DIRECTORY_SEPARATOR);

if(getenv()["Local"]=="false") define("ROOT_DIR","https://news-api-global.herokuapp.com".DS);
else defined("ROOT_DIR") ? NULL : define("ROOT_DIR",/* DS . "xampp" . DS . "htdocs" . DS . "APIS" . DS . "what_new_api" *///"https://news-api-global.herokuapp.com". DS);
/*defined("INC") ? NULL : define("INC", ROOT_DIR . "src" . DS . "includes" . DS);
defined("COR") ? NULL : define("COR", ROOT_DIR . "src" . DS . "core" . DS);
defined("MODELS") ? NULL : define("MODELS", ROOT_DIR . "src" . DS . "models" . DS);
defined("PACK") ? NULL : define("PACK", ROOT_DIR . "vendor" . DS);*/
//print(dirname(__FILE__));

include_once(dirname(__DIR__)."/../vendor/autoload.php");
include_once(dirname(__FILE__) . "/initialize.php");
include_once(dirname(__DIR__)."/includes/config_db.php");
include_once(dirname(__DIR__)."/includes/config_headers.php");
include_once(dirname(__DIR__)."/includes/fetch_api_config.php");
include_once(dirname(__DIR__)."/models/users/utils_user.php");
include_once(dirname(__DIR__)."/models/users/user.php");
include_once(dirname(__DIR__)."/models/utils_article.php");
include_once(dirname(__DIR__)."/models/new.php");
