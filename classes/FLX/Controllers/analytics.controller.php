<?php

/**
 * FILELOGIX ANALYTICS CLASS
 *  
 * @author Andrew Stonecipher
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */

namespace FLX\Controllers;

class analytics
{
    private $db;
    private $sessionID;
    private $userID;
    private $auth;
    private $vars = array();
    private $view;
    
    public function __construct()
    {
        $this->vars['controller'] = "Analytics";
        $this->vars["navCreateActive"]=true;
        $this->view = "SAMPLE_VIEW";
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