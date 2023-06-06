<?php

namespace app\classes;

class Invoice {
    public function __construct(){

    }

    public function index() : void {
        echo 'Invoice Home';
    }

    public function create() : void {
        echo "<form method='post' action='/invoice/create'>Amount<input name='amount' type='input'/><button>Submit</button></form>";
    }

    public function store() : void {
        echo 'amount ' . $_POST['amount'];
    }

    

}