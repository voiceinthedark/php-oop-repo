<?php

namespace app\classes;

class Home{

    public function index() : void
    {
        echo 'Home' . '<br>';
        echo $_COOKIE['username'] . '<br>';
    }

}