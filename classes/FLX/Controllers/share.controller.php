<?php

/**
 * FILELOGIX SHARE CLASS
 *  
 * @author Andrew Stonecipher
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */

namespace FLX\Controllers;

class share
{
    // Will store database connection here
	private $db;
	private $connID;
	private $sessionID;
	private $userID;
	private $view = "CAL_LARGE_WRAPPER";
	private $auth;
	private $vars = array();
	private $lists;
	private $registration;
	private $transfer = false;
	private $calendar;
	private $isAdmin;

	/**
  	 * Create instance, load current info based on session info
  	 *
  	 * @return bool
  	 */
	
	public function __construct($db, $sessionID, $userID) {
	  $this->db = $db;
	  $this->sessionID = $sessionID;
	  $this->auth = new \auth($db);
	  $this->userID = $this->auth->getUserID();

	  $this->lists = new \lists($this->db);
	  	
	  $this->calendar = new \CAL\calendar($this->db);	 
	  	 
  	  $this->vars["categories"]=$this->calendar->getAllCategories();
  	  $this->vars["areas"]=$this->calendar->getAllAreas(1);

	  $this->vars["events"] = $this->calendar->getTopEvents(1, "2014-04-01", "2014-07-01", 3);

	  if ($this->auth->validate($this->userID)) {

		  $this->isAdmin = $this->auth->getAccessByUserID($this->userID, "Administrator");
		  
		  error_log("IsAdmin: " . $this->isAdmin);
		  
		  if ($this->isAdmin[0]["view"]) {
		 	 $this->vars["navAdminEnabled"]=true;
		  }

	  }
	  else {
		  	$this->vars["navAdminEnabled"]=false;		  
	  }
	  
	  $this->dflt();

	  	 
	}
    
	
	public function dflt($params) {
	
	    if ($this->auth->validate($this->userID)) {
	
	        $this->view="CAL_SHARE";
	        $this->vars["navShareActive"]=true;
	
	        return true;
	    }
	     
	    else {
	
	        $this->view="CAL_LOGIN";
	        $this->vars["navShareActive"]=false;
	
	        return true;
	
	    }
	
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