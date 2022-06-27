<?php

    spl_autoload_register('MyAutoLoader');
    spl_autoload_register('MyAutoLoaderContr');

//ModelsPath
    function MyAutoLoader($className){

        $extensions = ".class.php";
        $path= "../models/";
        $fullPath = $path . $className . $extensions; 
 
        if(!file_exists($fullPath)){
            return false;
        }

        include $fullPath;

    }
    function MyAutoLoaderContr($className){

        $extensions = ".class.php";
        $path= "../controllers/";
        $fullPath = $path . $className . $extensions; 
 
        if(!file_exists($fullPath)){
            return false;
        }

        include $fullPath;

    }