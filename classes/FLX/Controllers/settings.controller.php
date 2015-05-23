<?php

/**
 * FILELOGIX SETTINGS CLASS
 *  
 * @author Andrew Stonecipher
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */

namespace FLX\Controllers;

class settings
{
    
    private $view = "<div class='well'>Settings View</div>";
    
    public function __construct()
    {}
    
    public function view()
    {
        return $this->view;
    }
    
}