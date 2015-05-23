<?php

/**
 * FILELOGIX PROFILE CLASS
 *  
 * @author Andrew Stonecipher
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */

namespace FLX\Controllers;

class profile
{
    
    private $view = "<div class='well'>Profile View</div>";
    
    public function __construct()
    {
        $this->view();
    }
    
    public function data()
    {
        return $this->vars;
    }

    public function view()
    {
        if ($_GET["mobile"] == "yes") {
            return "mobile";
        } else {
            return $this->view;
        }
    }

    public function transfer()
    {
        return $this->transfer;
    }
    
}