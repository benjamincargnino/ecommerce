<?php

    define ('ROOT', realpath(dirname(__FILE__) . '/../') . '/');

    function autoloadItemsClass($sClassName)
    {
        $sFilePath = ROOT . 'src/' . $sClassName . '.class.php';

        $sFilePath  =  str_replace('\\', '/', $sFilePath );
       // $sFilePath = strtoupper($sFilePath);

        if (is_file($sFilePath)) {
            require_once $sFilePath;
        }
    }

    spl_autoload_register('autoloadItemsClass');