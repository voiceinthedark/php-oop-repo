<?php

namespace app\controllers;

class HomeController
{



    public function index(): string
    {
        $title = '<h1>Home Page</h1>';
        $form = <<<HTML
        <form action="/upload" method="post" enctype="multipart/form-data">
            Upload File: <input type="file" name="file">
            <input type="submit" value="Upload">
        </form>
    HTML;

        return $title . $form;
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
