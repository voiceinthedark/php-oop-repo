<?php

declare(strict_types=1);

namespace app;

use app\exceptions\ViewDoesNotExist;

class View {

    public function __construct(protected string $view, 
        protected array $data = []) {

    }

    public static function make(string $view, array $data = []) : string {
        return (new static($view, $data))->render();
    }

/**
 * Render function that includes the corresponding PHP file specified by $this->view.
 *
 * @throws ViewDoesNotExist if the view file specified by $this->view does not exist
 * 
 * @return string
 */
public function render() : string {
    // Construct the path to the view file
    $viewpath = VIEWS_PATH . '/' . $this->view . '.php';
    
    // If the view file does not exist, throw an exception
    if(!file_exists($viewpath)){
        throw new ViewDoesNotExist();
    }

    // Include the view file
    include $viewpath;
    
    // Return an empty string, yes cause it's printing a 1 (true) on every page otherwise :confused:  
    return '';
}

}