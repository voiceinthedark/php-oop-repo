<?php

class InvoiceCollection implements Iterator{

    private int $pointer;
    public function __construct(public array $lst){
        $this->pointer = 0;
    }
    // Implements abstract methods of Iterator
    public function current() : mixed {
        return $this->lst[$this->pointer];
    }

    public function next() : void {
        $this->pointer++;
    }

    public function valid(): bool {
        return isset($this->lst[$this->pointer]);        
    }

    public function key(): int {
        return $this->pointer;
    }

    public function rewind(): void {
        $this->pointer = 0;
    }



    
}
