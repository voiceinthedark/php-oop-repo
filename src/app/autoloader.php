<?php


class Autoloader
{
    public static function ClassLoader(string $className)
    {
        $class_path = str_replace('\\', '/', $className);

        $filePath = dirname(__DIR__, 1) . "/$class_path.php";
            

        // var_dump($filePath);

        
            if (file_exists($filePath)) {
                // echo $filePath . '<br>';
                require $filePath;
            }
        
    }
}

spl_autoload_register('Autoloader::ClassLoader');
