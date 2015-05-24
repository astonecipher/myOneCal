<?php

/**
 * FILELOGIX INBOX CLASS
 *  
 * @author Andrew Stonecipher
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */

namespace FLX\Controllers;

class inbox
{
	private $db;
	private $connID;
	private $sessionID;
	private $userID;
	private $view = "SAMPLE_VIEW";
	private $auth;
	private $vars = array();
	private $lists;
	private $registration;
	private $transfer = false;
	private $calendar;
	private $isAdmin;
    
    
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
    
    public function search($params) {
    
        $calendar = new \CAL\calendar($this->db);
    
        $categoryID = $_POST["category"];
    
        if ($params[3] == "day") {
            	
            $fromDate = date("Y/m/d", strtotime($params[4] . " -3 days"));
            $beginDate = date("Y/m/d", strtotime($params[4]));
            $endDate = date("Y/m/d", strtotime($params[4] . " +23:59 hours"));
            $toDate = date("Y/m/d", strtotime($params[4] . " +3 days"));
    
            $endDate = $beginDate . " 23:59";
    
    
            $days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
            $events = $calendar->getAllEventsByDateRange(1, $beginDate, $endDate, $categoryID, $keywords, $areaID);
    
            $this->vars["calDays"]=$days;
            $this->vars["events"]=$events;
    
            $_POST["fromDate"] = $fromDate;
            $_POST["toDate"] = $toDate;
    
            $this->vars["fromDate"]=date("m/d/y", strtotime($beginDate));
            $this->vars["toDate"]=date("m/d/y", strtotime($beginDate));
            $this->vars["categoryID"]=$categoryID;
    
            $this->view="CAL_RESULTS";
    
            return true;
        }	else if ($params[3] == "next-week") {
			
				$fromDate = date("Y/m/d", strtotime("+7 days"));
				$toDate = date("Y/m/d", strtotime("+14 days"));

				error_log("Next Week: " . $fromDate . " " . $toDate);

				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;

				return $this->results($params);
		}

		else if ($params[3] == "next-month") {
			
				$fromDate = date("Y/m/d", strtotime("first day of next month"));
				$toDate = date("Y/m/d", strtotime("last day of next month"));

				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;

				return $this->results($params);
		}

		else if ($params[3] == "this-month") {
			
				$fromDate = date("Y/m/d", strtotime("first day of this month"));
				$toDate = date("Y/m/d", strtotime("last day of this month"));

				error_log("This Month: " . $fromDate . " " . $toDate);

				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;

				return $this->results($params);
		}
		
		else if ($params[3] == "upcoming") {
			
				$fromDate = date("Y/m/d", strtotime("now"));
				$toDate = date("Y/m/d", strtotime("+14 days"));

				error_log("Upcoming: " . $fromDate . " " . $toDate);

				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;

				return $this->results($params);
		}
				
		else {

			if (($_POST["fromDate"] == "") or ($_POST["toDate"] == "")) {
				
				$fromDate = date("Y/m/d", strtotime("now"));
				$toDate = date("Y/m/d", strtotime("+1 week"));			
				
			}
			
			else {	
			
//				$fromDate = date("Y/m/d", strtotime($_POST["fromDate"]));
//				$toDate = date("Y/m/d", strtotime($_POST["toDate"]));
	
			}

			error_log("Search: " . $fromDate . " " . $toDate);

			$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
			$events = $calendar->getTopEvents(1, $fromDate, $toDate);
	
			$this->vars["fromDate"]=date("m/d/y", strtotime($fromDate));
			$this->vars["toDate"]=date("m/d/y", strtotime($toDate));
			$this->vars["categoryID"]=$categoryID; 		

	
			$this->vars["calDays"]=$days; 		
			$this->vars["events"]=$events; 		
	
			$this->view="CAL_LARGE_WRAPPER";

			return true;

		}
				  
	}
    
    public function dflt($params) {
    
        if ($this->auth->validate($this->userID)) {
    
            $this->view="CAL_INBOX";
            $this->vars["navInboxActive"]=true;
            $this->vars["navInboxEnabled"]=true;
    
            $calendar = new \CAL\calendar($this->db);
    
            if (isset($params[3])) {
                $this->calendar->setCalendarByUserID($this->userID, $this->calendar->getCalendarByShortName($params[3]));
    
                $this->vars["inboxType"] = $params[2];
                	
                $this->vars["calendars"] = $this->calendar->getCalendarsByUserID($_SESSION["userID"]);
                $this->vars["currentCalendar"] = $this->calendar->getCurrentCalendarNameByUserID($this->userID);
                $this->vars["currentCalendarShortName"] =  $this->calendar->getCurrentCalendarShortNameByUserID($this->userID);
                $calendarID = $this->calendar->getCurrentCalendarByUserID($this->userID);
    
                $this->vars["calendarID"] = $calendarID;
    
                if ($params[2] == "events") {
                    $events = $calendar->getPendingEventsByCalendarID($calendarID, date('Y-m-d',strtotime('now')));
    
                    $this->vars["events"]=$events;
                }
                	
                else if ($params[2] == "feeds") {
                    $events = $calendar->getNewFeedEventsByCalendarID($calendarID);
    
                    $this->vars["events"]=$events;
                }
                	
                return true;
            }
    
            else if (isset($params[2])) {
                $this->calendar->setCalendarByUserID($this->userID, $this->calendar->getCalendarByShortName($params[2]));
    
                $this->vars["inboxType"] = "events";
                $this->vars["calendars"] = $this->calendar->getCalendarsByUserID($_SESSION["userID"]);
                $this->vars["currentCalendar"] = $this->calendar->getCurrentCalendarNameByUserID($this->userID);
                $this->vars["currentCalendarShortName"] =  $this->calendar->getCurrentCalendarShortNameByUserID($this->userID);
                $calendarID = $this->calendar->getCurrentCalendarByUserID($this->userID);
    
                $this->vars["calendarID"] = $calendarID;
    
                $events = $calendar->getPendingEventsByCalendarID($calendarID, date('Y-m-d',strtotime('now')));
    
                $this->vars["events"]=$events;
    
                return true;
    
            }
    
            else {
    
                $this->vars["inboxType"] = "events";
                $this->vars["calendars"] = $this->calendar->getCalendarsByUserID($_SESSION["userID"]);
                $this->vars["currentCalendar"] = $this->calendar->getCurrentCalendarNameByUserID($this->userID);
                $this->vars["currentCalendarShortName"] =  $this->calendar->getCurrentCalendarShortNameByUserID($this->userID);
                $calendarID = $this->calendar->getCurrentCalendarByUserID($this->userID);
    
                $this->vars["calendarID"] = $calendarID;
    
                $events = $calendar->getPendingEventsByCalendarID($calendarID, date('Y-m-d',strtotime('now')));
    
                $this->vars["events"]=$events;
                	
                return true;
            }
    
        }
         
        else {
    
            $this->view="CAL_LOGIN";
            $this->vars["navHomeActive"]=false;
    
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