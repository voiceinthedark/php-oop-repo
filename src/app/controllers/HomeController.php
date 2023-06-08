<?php

namespace app\controllers;

use app\View;

class HomeController
{

    public function index() : string
    {
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
