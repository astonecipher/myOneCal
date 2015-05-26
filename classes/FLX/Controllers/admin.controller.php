<?php

/**
 * FILELOGIX HOME CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

class admin
{  
    // Will store database connection here
	private $db;
	private $connID;
	private $sessionID;
	private $userID;
	private $view = "admin";
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

	 // $this->dflt($params);
	  		
//	  $this->db->insert("FLX_CONNECTIONS", array("type"=>$this->type, "sessionID"=>$this->sessionID, "httpHost"=>$this->httpHost, "ipAddress"=>$this->ipAddress, "userAgent"=>$this->userAgent, "fingerprint"=>$this->fingerprint, "requestURI"=>$this->requestURI, "_server"=>print_r($_SERVER,1), "_get"=>print_r($_GET,1), "_post"=>print_r($_POST,1)));	

//	  error_log($this->db->lastQuery());
	}
	
	/**
  	 * Opens the controller - responsible for authentication and loading defaults
  	 *
  	 * @return bool true if success, false if failure
  	 */
	
	public function open() {
/*
	  $this->users=$this->db->query("select * from connections");
	  foreach ($this->users as $row) {
		  $this->userID = $row['userID'];
		  $this->username = $row['username'];
		  $this->emailAddress = $row['emailAddress'];
      }
      
    
*/	

		$this->vars["active"] = "admin";
	
	}
	
	
	/**
  	 * Loads the controller, handles any templating and pre-display logic for the requested view
  	 *
  	 * @return bool
  	 */
	
	public function load($view) {
/*
	  $this->users=$this->db->query("select * from connections");
	  foreach ($this->users as $row) {
		  $this->userID = $row['userID'];
		  $this->username = $row['username'];
		  $this->emailAddress = $row['emailAddress'];
      }
      
*/
//        $this->vars["loginAlert"]="<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" style=\"text-indent: 0px; height: 100%;\" data-dismiss=\"alert\">&times;</button> <strong>Warning!</strong> Invalid username or password.</div>";
		if (!$this->auth->validate()) {
			$this->vars["showLogin"]="true";
		}
		else {
			$this->vars["showLogin"]="false";
		}
		$this->vars["loginUsername"]="wbenwick@filelogix.net";


		$this->vars["dropdowns"] = $this->lists->retrieveByID("1");

		$this->vars["clipboard"] = "<br><br><br><br>";
		$this->vars["briefcase"] = "<br><br><br><br>";
		
		$template = new template($this->db, "globalSearch");
		$this->vars["globalSearchStr"] = $template->fetch(null);
		
		$template = new template($this->db, "support");
		$this->vars["supportStr"] = $template->fetch(null);
/*		
		$notes=array( "note4"=>"", "note1"=>"<div class='links'><a href='#/invoices/open'><center><h6>View Open Invoices</h6></center></a></div>", "note2"=>"<div class='links'><a href='#/cabinet/claims/pending'><center><h6>View Pending Claims</h6></center></a></div>", "note3"=>"<div class='links'><a href='#/messages/new'><center><h4>New Messages Waiting (10)</h4></center></a></div>", "note5"=>"");

*/
		$notes = $this->lists->retrieveByID("2");	
		$papers = $this->lists->retrieveByID("3");
		
		$this->vars["stickyNotes"]=$notes;	
		$this->vars["papers"]=$papers;
		
		if (!$this->vars["players"]) {
					$players = $this->registration->getRecentPlayers();
		
					$this->vars["players"] = $players;
				
		}

	}

	public function admin($params) {

	  if ($this->auth->validate($this->userID)) {
		if ($this->isAdmin[0]["view"]) {
			$this->view="CAL_ADMIN";
			$this->vars["navAdminActive"]=true;
			$users = new \users($this->db);
			$this->vars["pendingUsers"] = $users->getUsersWithStatus("pending");
		}
		else {
			$this->view="CAL_ERROR";
			$this->vars["errorMsg"] = "You do not have permission to view this page.";
			$this->vars["navAdminActive"]=false;
		}
		return true;
	  }
	  
	  else {

		$this->view="CAL_LOGIN";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }

	}
	
	public function players() {
		
	if ($this->auth->validate($this->userID)) {
	
		$players = $this->registration->getAllPlayers();
		
		$this->vars["players"] = $players;
	
		$this->vars["active"] = "players";
		
		$this->view = "players";
		
		return true;
	 }
	 else {
		 return false;
	 }
	}

	
	public function data() {
		
		return $this->vars;
	}


	public function view() {
	
		if ($_GET["mobile"] == "yes") {
			return "admin";
		}
		else {			
			return $this->view;
		}
	}
	
	public function transfer() {
		
		return false;
	}

}
?>
