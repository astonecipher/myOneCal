<?php

/**
 * FILELOGIX USERS CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
class users
{  
    // Will store database connection here
	private $db;
	private $user;

	
	public function __construct($db) {
	  $this->db = $db;
	}
 	
	public function getUsername() {
			return $this->user->getUsername();
    }

	public function getEmailAddress() {
			return $this->emailAddress;
    }
    
    public function getUserID() {
			return $this->userID;
    }    
   
    public function lookupByEmail($emailAddress) {
	  
	  	$r = $this->db->query("select * from FLX_USERS where emailAddress='$emailAddress' and `isActive` is TRUE");
        $results = $r->fetch(\PDO::FETCH_ASSOC);
        $username = $results['username'];
	  
	    if ($username != "") {	
		  	$this->user = new \user($this->db, $username);
		  	return $this->user;
	  	}
	  	
	  	else {
		  	return false;
	  	}
    }
 
    public function lookupByEmailWithActivationCode($emailAddress, $activationCode) {
	  
     	$emailAddressStr = $this->db->quote($emailAddress);
    	$activationCodeStr = $this->db->quote($activationCode);

	  	$r = $this->db->query("select * from FLX_USERS where emailAddress=$emailAddressStr and activationCode=$activationCodeStr and `isActive` is TRUE");
        $results = $r->fetch(\PDO::FETCH_ASSOC);
        $username = $results['username'];
	  
	    if ($username != "") {	
		  	$this->user = new \user($this->db, $username);
		  	return $this->user;
	  	}
	  	
	  	else {
		  	return false;
	  	}
    }
        
    public function lookupByUserID($userID) {
    
    	$userIDStr = $this->db->quote($userID);
	  
	  	$r = $this->db->query("select * from FLX_USERS where userID=$userIDStr");
        $results = $r->fetch(\PDO::FETCH_ASSOC);
        $username = $results['username'];

   		  error_log("ActivateByUserID: " . $userID . " " . $username . " qry: " . $this->db->lastQuery());
	  
	    if ($username != "") {	
		  	$this->user = new \user($this->db, $username);
		  	return $this->user;
	  	}
	  	
	  	else {
		  	return false;
	  	}
    }    

    public function userExists($username) {


		$usernameStr = $this->db->quote($username);
	  	$r = $this->db->query("select * from FLX_USERS where username=$usernameStr and `isActive` is TRUE");  
	    $results = $r->fetch(\PDO::FETCH_ASSOC);
        $username = $results['username'];
	  
	    if ($username != "") {	
			return true;
	  	}
	  	
	  	else {
		  	return false;
	  	}
	  		    
	    return false;
    }

    public function isPending($username) {

		$usernameStr = $this->db->quote($username);
	  	$r = $this->db->query("select * from FLX_USERS where username=$usernameStr and `isPending` is TRUE");  
	    $results = $r->fetch(\PDO::FETCH_ASSOC);
        $username = $results['username'];
	  
	    if ($username != "") {	
			return true;
	  	}
	  	
	  	else {
		  	return false;
	  	}
	  		    
	    return false;
    }

    public function getUserByID($userID) {

		$userIDStr = $this->db->quote($userID);
		
	  	$r = $this->db->query("select * from FLX_USERS where userID = $userIDStr");
      
        $results = $r->fetch(\PDO::FETCH_ASSOC);
      	  
		return $results;
    }
 
    public function emailExists($emailAddressStr) {

		$emailAddressStr = $this->db->quote($emailAddressStr);
		
	  	$r = $this->db->query("select * from FLX_USERS where emailAddress=$emailAddressStr");
      
        $results = $r->fetch(\PDO::FETCH_ASSOC);
      
        $username = $results['username'];
        $userID = $results['userID'];
        $isActive = $results['isActive'];
	  
	    if ($username != "") {	
			if ($isActive) {
				return $userID;
			}
			else {
				return intval("-" . $userID);
			}
	  	}
	  	
	  	else {
		  	return false;
	  	}
	  		    
	    return false;
    }
       
	public function signup($emailAddress, $firstName, $lastName, $organizationName = "", $phoneNumber = "") {

	    $userExists = $this->emailExists($emailAddress);
		
		if (!$userExists) {
		
			if ($userExists < 0) {

				return $userExists;
			}
			
			else {

				$random = new \random(6,6);
				$activationCode = $random->token(6);

				$random = new \random(8,8);
				$activationKey = $random->token(8);

				$name = $firstName . " " . $lastName;
				$shortName = strtolower($firstName[0] . $lastName);
			
				$newUserID = $this->db->insert("FLX_USERS", array("username"=>$emailAddress, "emailAddress"=>$emailAddress, "name"=>$name, "firstName"=>$firstName, "lastName"=>$lastName, "status"=>"pending", "organizationName"=>$organizationName, "phoneNumber"=>$phoneNumber, "shortName"=>$shortName, "userKey"=>md5($activationKey), "activationCode"=>$activationCode));
			
				return $newUserID;
			}
		}
		
		else {
			return 0;
		}
	}

	public function resignup($userID, $emailAddress, $firstName, $lastName, $organizationName = "", $phoneNumber = "") {

	    $userExists = $this->emailExists($emailAddress);
		
		if ($userExists) {

				$random = new \random(6,6);
				$activationCode = $random->token(6);

				$random = new \random(8,8);
				$activationKey = $random->token(8);

				$name = $firstName . " " . $lastName;
				$shortName = strtolower($firstName[0] . $lastName);
			
				$result = $this->db->update("FLX_USERS", "userID", $userID, array("username"=>$emailAddress, "emailAddress"=>$emailAddress, "name"=>$name, "firstName"=>$firstName, "lastName"=>$lastName, "status"=>"pending", "organizationName"=>$organizationName, "phoneNumber"=>$phoneNumber, "shortName"=>$shortName, "userKey"=>md5($activationKey), "activationCode"=>$activationCode));
			
				if ($result) {
					
					return $userID;
				}
				else {
					return intval("-" . $userID);
				}
		}
		
		else {
			return false;
		}
	}
   
    public function activate($emailAddress, $password) {
	  
	  $user = $this->lookupByEmail($emailAddress,$activationCode);
	  
	  if ($user) {
		  // if email exists and account is provisioned as new, set password and activate
		    
		  if ($this->user->activate($password)) {
		  	  return $this->user->getUsername();
		  }
		  
		  else {
			  return false;
		  }
	  }
	  
	  else {
	  
		  return false;
	  }
	
	  return -1;	    

	}    

    public function resetWithActivationCode($emailAddress, $password, $activationCode) {
	  
	  $user = $this->lookupByEmailWithActivationCode($emailAddress,$activationCode);
	  
	  if ($user) {
		  // if email exists and account is provisioned as new, set password and activate
		    
		  if ($this->user->setPassword($password)) {
		  	  $user->setActivationCode("");
		  	  $user->clearReset();
		  	  return $this->user->getUsername();
		  }
		  
		  else {
			  return false;
		  }
	  }
	  
	  else {
	  
		  return false;
	  }
	
	  return -1;	    

	}

    public function password($userID, $password) {
	  
	  $user = $this->lookupByUserID($userID);
	  
	  if ($user) {
		    
		  if ($this->user->activate($password)) {
		  	  return $this->user->getUsername();
		  }
		  
		  else {
			  return false;
		  }
	  }
	  
	  else {
	  
		  return false;
	  }
	
	  return -1;	    

	}
 
    public function activateByUserID($userID, $password) {
	  
	  $user = $this->lookupByUserID($userID);
	  
	  if ($user) {
		  // if email exists and account is provisioned as new, set password and activate
		    
		  if ($this->user->activate($password)) {
		  	  return $this->user->getUsername();
		  }
		  
		  else {
			  return false;
		  }
	  }
	  
	  else {
	  
		  return false;
	  }
	
	  return -1;	    

	} 
    
    public function forgotPassword($username) {
	    
	    return false;
    }
    
    public function resetPasswordByUserID($userID,$code) {
    	
	    $user = $this->lookupByUserID($userID);
	    
	    if ($user) {
		  // if email exists and account is provisioned as new, set password and activate
		    
		  if ($this->user->resetPassword($code)) {
		  	  return true;
		  }
		  
		  else {
			  return false;
		  }
	  }
	  
	  else {
	  
		  return false;
	  }
	
	  return -1;	    



    }
    
    public function resetPasswordByEmailAddress($emailAddress,$code) {
    	
	    $user = $this->lookupByEmail($emailAddress);
	    
	    if ($user) {
			
			return $this->resetPasswordByUserID($user->getUserID(), $code);
		}
		else {
		
			return false;
		}

    }
    
    public function getUsersWithStatus($status) {
    
  	  $statusStr = $this->db->quote($status);  	
   
   	  $r=$this->db->query("select * from FLX_USERS where status = $statusStr order by userID asc");    
      $results=$r->fetchAll();

	  error_log("UsersWithStatus: " . $this->db->lastQuery());

      return $results;

	    
    }

	public function isSubscribed($userID, $isSubscribed) {
	
		$userID = intval($userID);

		if (isset($isSubscribed)) {
			if ($isSubscribed) {
				$this->db->update("FLX_USERS", "userID", $userID, array("isSubscribed"=>true, "isPending"=>false, "isActive"=>true, "isCredit"=>false));
			}
			else {
				$this->db->update("FLX_USERS", "userID", $userID, array("isSubscribed"=>false, "isPending"=>true, "isActive"=>true, "isCredit"=>true));			
			}
		}

		$r = $this->db->query("select * from FLX_USERS where userID = $userID");
      
        $results = $r->fetch(\PDO::FETCH_ASSOC);
      	  
		return $results["isSubscribed"];
	}
}
?>