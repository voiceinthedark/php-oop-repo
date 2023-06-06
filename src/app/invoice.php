<?php

namespace App;

class Invoice {
    public function __construct(public int $id, public int $amount, public string $credit_card){

    }

    public function index() : void {
        echo 'Invoice Home';
    }

    public function __serialize() : array {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'credit_card' => base64_encode($this->credit_card),
        ];
    }

    public function __unserialize(array $data) : void {
        $this->id = $data['id'];
        $this->amount = $data['amount'];
        $this->credit_card = base64_decode($data['credit_card']);
    }

}