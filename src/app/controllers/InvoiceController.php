<?php

namespace app\controllers;

use app\View;

class InvoiceController {
    public function __construct(){

    }

    public function index() : string   {
        return View::make('invoices/index');
    }

    public function create() : string  {
        return View::make('invoices/create');
    }

    public function store() : void {
        echo 'amount ' . $_POST['amount'];
    }

    

}