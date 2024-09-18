<?php
session_start();
define("URI", "http://localhost/laptop-modif/");
define("RACINE", str_replace("index.php", "", $_SERVER["SCRIPT_FILENAME"]));
require_once RACINE . "autoload.php";

$params = explode("/", $_GET['p']);
if (!empty($params[0]))
{
    $controller = ucfirst($params[0]);
    if (file_exists(RACINE . "controllers/$controller.php"))
     {
        $controller = new $controller();

        $action = (isset($params[1])) ? $params[1] : 'index';
        if (method_exists($controller, $action)) 
        {
            // [controller,action,id_laptop]
            array_shift($params);
            // [action,id_laptop]
            array_shift($params);
            // [id_laptop]
            call_user_func_array([$controller, $action], $params);
        } else {
            header("Location: " . URI . "laptops/index");
            return;
        }
    } else {
        header("Location: " . URI . "laptops/index");
        return;
           }

} else {
    header("Location: " . URI . "laptops/index");
    return;
       }