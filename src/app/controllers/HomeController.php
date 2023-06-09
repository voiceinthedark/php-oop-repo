<?php

namespace app\controllers;

use app\View;
use PDO;
use Dotenv;

require __DIR__ . '/../../vendor/autoload.php';



class HomeController
{
    
    public function index(): string
    {       
        try {

            // open pdo connection to my_db database that runs on a docker container
            $db = new PDO(
                'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'],
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        $name = 'Marcus Cracius';
        $email = 'MarcusCrasius@example.com';
        $isactive = 1;
        $createdat = date('Y-m-d H:i:s');
        $amount = 33.15;


        try {
            $db->beginTransaction();

            $insert_user_statement = 'INSERT INTO users (email, full_name, is_active, created_at) VALUES (:email, :full_name, :is_active, :created_at)';

            $statment = $db->prepare($insert_user_statement);
            $statment->execute(['email' => $email, 'full_name' => $name, 'is_active' => $isactive, 'created_at' => $createdat]);

            $user_id = (int)$db->lastInsertId();

            $insert_invoice_statement = 'INSERT INTO invoices (amount, user_id) VALUES (:amount, :user_id)';
            $invoice_statement = $db->prepare($insert_invoice_statement);
            $invoice_statement->execute(['user_id' => $user_id, 'amount' => $amount]);

            $fetchStatement = $db->prepare('SELECT invoices.id AS invoice_id, amount, user_id, full_name FROM invoices
            INNER JOIN users ON invoices.user_id = users.id
            WHERE email = :email');
            $fetchStatement->execute(['email' => $email]);

            $db->commit();
        } catch (\PDOException $e) {
            echo $e->getMessage();
            if ($db->inTransaction()) {
                $db->rollBack();
            }
        }

        foreach ($fetchStatement->fetch(PDO::FETCH_ASSOC) as $row) {
            echo "<pre>";
            var_dump($row);
            echo "</pre>";
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
