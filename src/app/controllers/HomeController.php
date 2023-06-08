<?php

namespace app\controllers;

use app\View;
use PDO;

class HomeController
{

    public function index() : string
    {
        // open pdo connection to my_db database that runs on a docker container
        $db = new PDO('mysql:host=db;dbname=my_db', 'root', 'root', []);

        return View::make('index', ['title' => 'Home']);
    }



    public function upload() : void
    {
        move_uploaded_file($_FILES['file']['tmp_name'], STORAGE_PATH . '/' . $_FILES['file']['name']);
    }

    public function download() : void{
        header('Content-Type: application/pdf');
        header('Disposition: attachment; filename="invoice.pdf"');

        readfile(STORAGE_PATH . '/' . 'docker.pdf');
    }
}
