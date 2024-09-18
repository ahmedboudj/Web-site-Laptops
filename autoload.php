<?php

function autoload($classe)
{
    $chemins = ['./controllers/', './models/','./app/'];
    foreach ($chemins as $chemin) {
        if (file_exists($chemin . $classe . ".php")) {
            require_once $chemin . $classe . ".php";
        }
    }
}

spl_autoload_register("autoload");
