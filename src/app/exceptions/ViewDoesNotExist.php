<?php

namespace app\exceptions;

class ViewDoesNotExist extends \Exception
{

    public function __construct()
    {
        parent::__construct('View does not exist');
    }
}
