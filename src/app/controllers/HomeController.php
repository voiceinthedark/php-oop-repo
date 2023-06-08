<?php

namespace app\controllers;

use app\View;
use PDO;

class HomeController
{

    public function index(): string
    {
        try {

            $id = 15;
            // open pdo connection to my_db database that runs on a docker container
            $db = new PDO('mysql:host=db;dbname=my_db', 'root', 'root', [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
            $query = 'SELECT * FROM users where id = ?';
            $statment = $db->prepare($query);
            $statment->execute([$id]);


            foreach ($statment->fetchAll() as $row) {
                echo "<pre>";
                var_dump($row);
                echo "</pre>";
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return View::make('index', ['title' => 'Home']);
    }



    public function upload(): void
    {
        move_uploaded_file($_FILES['file']['tmp_name'], STORAGE_PATH . '/' . $_FILES['file']['name']);
    }

    public function download(): void
    {
        header('Content-Type: application/pdf');
        header('Disposition: attachment; filename="invoice.pdf"');

        readfile(STORAGE_PATH . '/' . 'docker.pdf');
    }
}
