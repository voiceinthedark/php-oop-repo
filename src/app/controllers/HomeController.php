<?php

namespace app\controllers;

use app\View;

class HomeController
{

    public function index() : string
    {
        return View::make('index');
    }



    public function upload() : void
    {
        echo "<pre>";
        var_dump($_FILES['file']);
        echo "</pre>";

        var_dump(pathinfo($_FILES['file']['tmp_name']));

        move_uploaded_file($_FILES['file']['tmp_name'], STORAGE_PATH . '/' . $_FILES['file']['name']);
    }
}
