<?php

/**
 * FILELOGIX Search CLASS
 *  
 * @author Andrew Stonecipher
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */

namespace FLX\Controllers;

class search
{
    
    private $view = "<div class='well'>Search View</div>";
    
    public function __construct()
    {}
    
    public function view()
    {
        return $this->view;
    }
    
}