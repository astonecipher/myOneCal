<?php

/**
 * FILELOGIX EVENT CLASS
 *  
 * @author Andrew Stonecipher
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

class event 
{
    
    // Will store database connection here
    private $db;
    private $connID;
    private $sessionID;
    private $userID;
    private $view = "EVENTS";
    private $auth;
    private $vars = array();
    private $lists;
    private $calendar;
    private $registration;
    private $transfer = false;
    
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
        $this->calendar = new \CAL\calendar($this->db);
        $this->lists = new \lists($this->db);
        error_log("CAL/Event controller built\n\n");
        $this->add($params);
    }
    
    
    public function home($params) {
        $this->add($params);
    }
    
	public function add($params) {

	  $this->vars["formAction"]="/event/add/new";
	  
	  $calendar = new \CAL\calendar($this->db);

	  if ($this->auth->validate($this->userID)) {
	  
	  	$this->vars["canSubmit"] = TRUE;
	  	$this->vars["canCopy"] = TRUE;
	  	$this->vars["copyDisabled"] = TRUE;
	  	
	  	$this->vars["calendars"] = $calendar->getCalendarsByUserID($this->userID);
	  	$this->vars["calendarID"] = $calendar->getDefaultCalendarByUserID($this->userID);

		if (($_POST["submit"] == "Create") or ($_POST["submit"] == "Submit") or ($_POST["submit"] == "Submit Event")) {

			error_log("Submit Event");
			
			$eventParams = array();
			$repeatParams = array();

			$eventParams["sTitle"] = $_POST["eventTitle"];
			$categories = $_POST["eventCategories"];
			$category = $_POST["category"];
			
			$startDate = $_POST["startDate"];
			$startHour = $_POST["startHour"];
			$startMinute = $_POST["startMinute"];
			$startMeridian = $_POST["startMeridian"];
			
			$endDate = $_POST["endDate"];
			$endHour = $_POST["endHour"];
			$endMinute = $_POST["endMinute"];
			$endMeridian = $_POST["endMeridian"];	
					
			$startDateTime = $_POST["startDateTime"];
			$endDateTime = $_POST["endDateTime"];
			
			$repeatParams["repeatFreq"] = $_POST["repeatFrequency"];
			$repeatParams["every"] = $_POST["repeatEvery"];
			$repeatParams["repeatDaysBinary"] = $_POST["repeatDaysBinary"];
			$repeatParams["repeatDaysBinaryStr"] = $_POST["repeatDaysBinaryStr"];
			$repeatParams["repeatMonthly"] = $_POST["repeatMonth"];
			$repeatParams["repeatAnnually"] = $_POST["repeatAnnual"];
			$repeatParams["repeatMonthDayNumber"] = $_POST["repeatMonthDayNumber"];
			$repeatParams["repeatMonthWeek"] = $_POST["repeatMonthWeek"];
			$repeatParams["repeatMonthDaysBinary"] = $_POST["repeatMonthDaysBinary"];
			$repeatParams["repeatMonthDaysBinaryStr"] = $_POST["repeatMonthDaysBinaryStr"];
			$repeatParams["repeatMonth"] = $_POST["repeatMonth"];
			$repeatParams["repeatAnnualMonth1"] = $_POST["repeatAnnualMonth1"];
			$repeatParams["repeatAnnualMonth2"] = $_POST["repeatAnnualMonth2"];
			$repeatParams["repeatAnnualDayNumber"] = $_POST["repeatAnnualDayNumber"];
			$repeatParams["repeatAnnualWeek"] = $_POST["repeatAnnualWeek"];
			$repeatParams["repeatAnnualDayOfWeek"] = $_POST["repeatAnnualDayOfWeek"];
			$repeatParams["excludeDates"] = $_POST["repeatSkipDates"];
			$repeatParams["customDates"] = $_POST["repeatCustomDates"];
			$repeatParams["repeatWhen"] = $_POST["repeatWhen"];
			$repeatParams["repeatDay"] = $_POST["repeatDay"];
			$repeatParams["endDate"] = $_POST["repeatEndDate"];
			
			$locationParams["eventLocation"] = $_POST["eventLocation"];
			$locationParams["newLocationName"] = $_POST["locationName"];
			$locationParams["newAddress"] = $_POST["newAddress"];
			$locationParams["newCity"] = $_POST["newCity"];
			$locationParams["newCountry"] = $_POST["newCountry"];
			$locationParams["newState"] = $_POST["newState"];
			$locationParams["newPostalCode"] = $_POST["newPostalCode"];
			$locationParams["newPhone"] = $_POST["newPhone"];
			$locationParams["newLatitude"] = $_POST["newLatitude"];
			$locationParams["newLongitude"] = $_POST["newLongitude"];

			$eventParams["kOrganizerID"] = $_POST["organizerID"];
			$eventParams["sContactName"] = $_POST["organizerName"];
			$eventParams["sContactPhone"] = $_POST["organizerPhone"];
			$eventParams["uContactWebsite"] = $_POST["organizerWebsite"];
			$eventParams["sContactEmail"] = $_POST["organizerEmail"];

			$eventParams["bShared"] = $_POST["sharing"];
			$eventParams["bSponsored"] = $_POST["sponsored"];
			$eventParams["fCost"] = $_POST["eventCost"];
			$eventParams["sTicketURL"] = $_POST["ticketURL"];
			$eventParams["sDescription"] = $_POST["eventDescription"];
//			$eventParams["sDetails"] = $_POST["eventDetails"];
			$eventParams["sDetails"] = $_POST["eventDescription"];
			$eventParams["sURL"] = $_POST["eventURL"];
			$eventParams["uFacebook"] = $_POST["eventFacebookURL"];
			$eventParams["uFoursquare"] = $_POST["eventFoursquareURL"];
			$eventParams["bTicketed"] = $_POST["eventTicketed"];
			$eventParams["zKeywords"] = $_POST["tags"];
			$eventParams["bAllDay"] = $_POST["eventAllDay"];


			if ($startDateTime != "") {
				$eventParams["tStart"] = date("Y-m-d H:i", strtotime($startDateTime));
			}
			else {
				$eventParams["tStart"] = date("Y-m-d H:i", strtotime($startDate . " " . $startHour . ":" . $startMinute . " " . $startMeridian));

			}
			if ($endDateTime != "") {
				$eventParams["tEnd"] = date("Y-m-d H:i", strtotime($endDateTime));
			}
			else {
				$eventParams["tEnd"] = date("Y-m-d H:i", strtotime($endDate . " " . $endHour . ":" . $endMinute . " " . $endMeridian));
			}
			
			if ($eventParams["bAllDay"]) {
				$eventParams["tStart"] = date("Y-m-d", strtotime($startDate));
				$eventParams["tEnd"] = date("Y-m-d", strtotime($endDate));
			}	
						
			foreach ($_POST as $postkey => $postvalue) {
				if (is_array($postvalue)) {
	    			$this->vars[$postkey]=json_encode($postvalue);
				}
				else {
	    			$this->vars[$postkey]=$postvalue;
				}
			}
						
			if ($category == "") {
				if (count($categories)<1) {
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="Please select an Event Category.";				
				}
				else {
					error_log("Categories: Multiple Categories Selected");
					$category = $categories;
				}
			}
			else {
				$category = $category;
			}			
			
			if ($eventParams["sTitle"] == "") {
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="Please enter an Event Title.";				
			}

			else if ($eventParams["tStart"] == "") {
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="Please choose an Starting Date & Time.";				
			}

			else if ($eventParams["tEnd"] == "") {
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="Please choose an Ending Date & Time.";				
			}	
			
/*
			else if ($eventParams["sDetails"] == "") {
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="Please provide details about the event.";				
			}	
*/
			
/*
			else if ($eventParams["sDescription"] == "") {
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="Please provide a description about this event.";				
			}
*/	
			else if (strtotime($eventParams["tStart"]) > strtotime($eventParams["tEnd"])) {
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="Please correct your Start and Ending times.";					
			}
			else {
			
//				$eventParams["fDuration"] = strtotime($eventParams["tEnd"]) - strtotime($eventParams["tStart"];

				if ($locationParams["eventLocation"] == "new") {
					if ($locationParams["newLocationName"] == "") {
						$this->vars["alertError"]=true;
						$this->vars["errorMsg"]="Please enter an Event Location.";								
					}
					else {
						$city = $locationParams["newCity"];
						$state = $locationParams["newState"];
						$zip = $locationParams["newPostalCode"];
						$address = $locationParams["newAddress"];
						$name = $locationParams["newLocationName"];
						$locationID = $calendar->createLocation($name,$address,$city,$state,$zip, "", "", "", "", "", "", "", "",false);		
						$eventLocation = $locationID;
						$locationParams["eventLocation"] = $eventLocation;
						$locationParams["locationID"] = $eventLocation;
						$locationParams["locationName"] = $name;
						$eventParams["kLocationID"] = $locationID;
						$this->vars["eventLocation"] = $locationID;
					}
				}
				else {
					$locationID = $locationParams["eventLocation"];
					$eventParams["kLocationID"] = $locationID;
					$this->vars["eventLocation"] = $locationID;
				}	
				
//				$categoryName = $calendar->getCategoryByID($category);
					
//				if (!$categoryName){
//					$this->vars["alertError"]=true;
//					$this->vars["errorMsg"]="Please select a category.";								
//
//				}

				if ($repeatParams["repeatFreq"] != "") {
						$eventRepeats = 1;
						
				}
				else {
						$eventRepeats = 0;
				}

				$locationParams["locationName"] = $calendar->getLocationByID($eventParams["kLocationID"]);

//error_log("kLocationName:" . $locationParams["locationName"]);

				if ($_POST["eventLocation"] == 0) {
						$locationID = $calendar->createLocation($name,$address,$city,$state,$zip, "", "", "", "", "", "", "", "",false);									
						$locationParams["locationName"] = $name;
				}
	
				if (strlen($locationParams["locationName"])<1){
//error_log("kLocationNameErr:" . $locationParams["locationName"]);
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="Please select a location.";								

				}
		
				
				else {

					if (($_POST["submit"] == "Create") or ($_POST["submit"] == "Submit Event")) {
					    error_log("Event Submitted\n\n");
// 						$eventID = $calendar->createEvent("1", $eventTitle, $eventDescription, $eventDetails, $category, $startDateTimeStr, $endDateTimeStr, $eventLocation, $eventLink, $eventRepeats);  // TESTING
						$calendarID = $_POST["calendarID"];
						if ($calendar->checkCalendarByUserID($this->userID, $calendarID)) { // start here
						    error_log("CalendarByUser verified.\n");
							$eventID = $calendar->addEvent($calendarID, $eventParams["sTitle"], $category, $eventRepeats, $eventParams, $repeatParams);
							$this->vars["successMsg"]="Your new event was successfully added to the calendar. (ID: $eventID)";	
						}
						else {
						    error_log("CalendarByUser NOT verified.\n");
							$this->vars["alertError"]=true;
							$this->vars["errorMsg"]="An error occurred while saving this event.  The calendar selected is not available for your account.";
						}
					}
					else if ($_POST["submit"] == "Save") {
						$eventID = $_POST["eventID"];
						$calendarID = $_POST["calendarID"];
						if ($calendar->checkCalendarByUserID($this->userID, $calendarID)) {
						    error_log("CalendarByUser verified. If statement 2\n");
							$eventID = $calendar->updateEvent($eventID, $calendarID, $eventTitle, $eventDescription, $eventDetails, $category, $startDateTimeStr, $endDateTimeStr, $eventLocation, $eventLink, $eventRepeats);						
							$this->vars["successMsg"]="Your new event was saved and the calendar has been updated.";	
						}
						else {
						    error_log("CalendarByUser NOT verified. If statement 2\n");
							$this->vars["alertError"]=true;
							$this->vars["errorMsg"]="An error occurred while saving this event.  The calendar selected is not available for your account.";
						}
					}
						
					error_log("Event Saved: "  . $eventID);
	
					if ($eventID>0) {
						
						$this->vars["alertSuccess"]=true;
								
//						return $this->manage($params);

					}
					
					else {
						$this->vars["alertError"]=true;
						$this->vars["errorMsg"]="An error occurred while saving this event.  Please try again. 1001";							
					}
				}
			}
		}
		
		else {
		
			$this->view="CAL_NEW_EVENT";
			$this->vars["navCreateActive"]=true;
//			$this->vars["alertInfo"]=true;
//			$this->vars["infoMsg"]="The event was not saved, please try again.";
			
		}
		
  	    $this->vars["returnURL"] = "event/add";
		$this->vars["action"] = "Create";
		$this->vars["lastLocationID"]=$calendar->getLastLocationID($this->userID, $calendar->getCurrentCalendarByUserID($this->userID));
		$this->vars["locations"]=$calendar->getApprovedLocations();
		$this->vars["categories"]=$calendar->getCategoriesNotAll();
   	    $this->vars["areas"]=$this->calendar->getAllAreas(1);
		$this->view = "CAL_MANAGE_EVENT";
		$this->vars["navCreateActive"]=true;
		
		return true;
	  }
	  
	  else {

		$this->view="CAL_LOGIN";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }

	}
    
    
    
    public function getAll($params) {
    
        if ($this->auth->validate($this->userID)) {
             
            $this->vars["canSubmit"] = FALSE;
            $this->vars["canCopy"] = TRUE;
            $this->vars["copyDisabled"] = FALSE;
            $this->vars["canUpdateThis"] = TRUE;
            $this->vars["canUpdateAll"] = TRUE;
             
            $calendar = new \CAL\calendar($this->db);
    
            $this->vars["locations"]=$calendar->getApprovedLocations();
            $this->vars["categories"]=$calendar->getAllCategories();
            $this->vars["areas"]=$this->calendar->getAllAreas(1);
    
            $this->view="CAL_MANAGE_EVENT";
            $this->vars["navManageActive"]=true;
    
            $event = $calendar->getEventByParentID($params[2]);
            	
            $this->vars["eventTitle"] = $event["sTitle"];
            $this->vars["eventCategories"] = json_encode($calendar->getEventCategoriesByParentID($event["kParentID"]));
            $this->vars["category"] = json_encode($event["kCategoryID"]);
            	
            $this->vars["startDate"] = date("Y-m-d",strtotime($event["tStart"]));
            $this->vars["startHour"] = date("h", strtotime($event["tStart"]));
            $this->vars["startMinute"] = date("i", strtotime($event["tStart"]));
            $this->vars["startMeridian"] = date("a", strtotime($event["tStart"]));
    
            $this->vars["endDate"] = date("Y-m-d",strtotime($event["tEnd"]));
            $this->vars["endHour"] = date("h", strtotime($event["tEnd"]));
            $this->vars["endMinute"] = date("i", strtotime($event["tEnd"]));
            $this->vars["endMeridian"] = date("a", strtotime($event["tEnd"]));
    
            if ($event["eRepeat"]) {
    
                $repeat = $calendar->getRepeatingEventInfoByParentID($event["kEventID"]);
    
                $this->vars["repeat"] = json_encode($repeat);
                $this->vars["repeatFrequency"] = $repeat["eFrequency"];
                $this->vars["repeatEvery"] = $repeat["iDaily"] + $repeat["iWeekly"] + $repeat["iMonthly"] + $repeat["iAnnually"];
                $this->vars["repeatDaysBinary"] = $repeat["iWeekDays"];
                $this->vars["repeatMonth"] = $repeat["iMonthly"];
                $this->vars["repeatAnnual"] = $repeat["iAnnually"];
                $this->vars["repeatMonthDayNumber"] = $repeat["iMonthDays"];
                $this->vars["repeatMonthWeek"] = $repeat["iMonthWeek"];
                $this->vars["repeatMonthDaysBinary"] = $repeat["iWeekDays"];
                $this->vars["repeatMonth"] = $repeat["iMonths"];
                $this->vars["repeatAnnualMonth1"] = $repeat["iMonths"];
                $this->vars["repeatAnnualMonth2"] = $repeat["iMonths"];
                $this->vars["repeatAnnualDayNumber"] = $repeat["iMonthDays"];
                $this->vars["repeatAnnualWeek"] = $repeat["iMonthWeek"];
                $this->vars["repeatAnnualDayOfWeek"] = $repeat["iWeekDays"];
                $this->vars["repeatSkipDates"] = $repeat["zExclude"];
                $this->vars["repeatCustomDates"] = $repeat["zCustom"];
                $this->vars["repeatWhen"] = "";
                $this->vars["repeatDay"] = "";
                $this->vars["repeatEndDate"] = $repeat["dEndDate"];
            }
            	
            $this->vars["eventLocation"] = $event["kLocationID"];
    
            $this->vars["locationName"] = $event["sName"];
            $this->vars["newAddress"] = $event["zAddress"];
    
            $this->vars["newCity"] = $event["sCity"];
            $this->vars["newCountry"] = $event["sCountry"];
            $this->vars["newState"] = $event["sState"];
            $this->vars["newPostalCode"] = $event["sZipcode"];
            $this->vars["newPhone"] = $event["sPhoneNumber"];
            $this->vars["newLatitude"] = $event["sLat"];
            $this->vars["newLongitude"] = $event["sLon"];
    
            $this->vars["organizerID"] = $event["kContactID"];
            $this->vars["organizerName"] = $event["sContactName"];
            $this->vars["organizerPhone"] = $event["sContactPhone"];
            $this->vars["organizerWebsite"] = $event["uContactWebsite"];
            $this->vars["organizerEmail"] = $event["sContactEmail"];
    
            $this->vars["sharing"] = $event["bShared"];
            $this->vars["sponsored"] = $event["bSponsored"];
            $this->vars["eventCost"] = $event["fCost"];
            $this->vars["ticketURL"] = $event["sTicketURL"];
            $this->vars["eventDescription"] = $event["sDescription"];
            $this->vars["eventDetails"] = $event["sDetails"];
            $this->vars["eventURL"] = $event["sURL"];
            $this->vars["eventFacebookURL"] = $event["uFacebook"];
            $this->vars["eventFoursquareURL"] = $event["uFoursquare"];
            $this->vars["eventTicketed"] = $event["bTicketed"];
            $this->vars["tags"] = $event["zKeywords"];
            if ($event["bAllDay"]==1) {
                $this->vars["eventAllDay"] = $event["bAllDay"];
            }
            return true;
             
        }
         
        else {
    
            $this->view="CAL_LOGIN";
            $this->vars["navHomeActive"]=false;
    
    
    
            return true;
    
        }
    
    
    
    }
    
    public function submitEvent($params, $calendar) {
    
        error_log("Submit Event");
        	
        $eventParams = array();
        $repeatParams = array();
        	
        $this->vars["calendars"] = $calendar->getCalendarsByUserID($this->userID);
        $this->vars["calendarID"] = $calendar->getDefaultCalendarByUserID($this->userID);
    
        $eventParams["sTitle"] = $_POST["eventTitle"];
        $categories = $_POST["eventCategories"];
        $category = $_POST["category"];
        	
        $startDate = $_POST["startDate"];
        $startHour = $_POST["startHour"];
        $startMinute = $_POST["startMinute"];
        $startMeridian = $_POST["startMeridian"];
        	
        $endDate = $_POST["endDate"];
        $endHour = $_POST["endHour"];
        $endMinute = $_POST["endMinute"];
        $endMeridian = $_POST["endMeridian"];
        	
        $startDateTime = $_POST["startDateTime"];
        $endDateTime = $_POST["endDateTime"];
        	
        $repeatParams["repeatFreq"] = $_POST["repeatFrequency"];
        $repeatParams["every"] = $_POST["repeatEvery"];
        $repeatParams["repeatDaysBinary"] = $_POST["repeatDaysBinary"];
        $repeatParams["repeatDaysBinaryStr"] = $_POST["repeatDaysBinaryStr"];
        $repeatParams["repeatMonthly"] = $_POST["repeatMonth"];
        $repeatParams["repeatAnnually"] = $_POST["repeatAnnual"];
        $repeatParams["repeatMonthDayNumber"] = $_POST["repeatMonthDayNumber"];
        $repeatParams["repeatMonthWeek"] = $_POST["repeatMonthWeek"];
        $repeatParams["repeatMonthDaysBinary"] = $_POST["repeatMonthDaysBinary"];
        $repeatParams["repeatMonthDaysBinaryStr"] = $_POST["repeatMonthDaysBinaryStr"];
        $repeatParams["repeatMonth"] = $_POST["repeatMonth"];
        $repeatParams["repeatAnnualMonth1"] = $_POST["repeatAnnualMonth1"];
        $repeatParams["repeatAnnualMonth2"] = $_POST["repeatAnnualMonth2"];
        $repeatParams["repeatAnnualDayNumber"] = $_POST["repeatAnnualDayNumber"];
        $repeatParams["repeatAnnualWeek"] = $_POST["repeatAnnualWeek"];
        $repeatParams["repeatAnnualDayOfWeek"] = $_POST["repeatAnnualDayOfWeek"];
        $repeatParams["excludeDates"] = $_POST["repeatSkipDates"];
        $repeatParams["customDates"] = $_POST["repeatCustomDates"];
        $repeatParams["repeatWhen"] = $_POST["repeatWhen"];
        $repeatParams["repeatDay"] = $_POST["repeatDay"];
        $repeatParams["endDate"] = $_POST["repeatEndDate"];
        	
    
        $locationParams["eventLocation"] = $_POST["eventLocation"];
        $locationParams["newLocationName"] = $_POST["locationName"];
        $locationParams["newAddress"] = $_POST["newAddress"];
        $locationParams["newCity"] = $_POST["newCity"];
        $locationParams["newCountry"] = $_POST["newCountry"];
        $locationParams["newState"] = $_POST["newState"];
        $locationParams["newPostalCode"] = $_POST["newPostalCode"];
        $locationParams["newPhone"] = $_POST["newPhone"];
        $locationParams["newLatitude"] = $_POST["newLatitude"];
        $locationParams["newLongitude"] = $_POST["newLongitude"];
    
        $eventParams["kOrganizerID"] = $_POST["organizerID"];
        $eventParams["sContactName"] = $_POST["organizerName"];
        $eventParams["sContactPhone"] = $_POST["organizerPhone"];
        $eventParams["uContactWebsite"] = $_POST["organizerWebsite"];
        $eventParams["sContactEmail"] = $_POST["organizerEmail"];
    
        $eventParams["kLocationID"] = $_POST["eventLocation"];
        $eventParams["bShared"] = $_POST["sharing"];
        $eventParams["bSponsored"] = $_POST["sponsored"];
        $eventParams["fCost"] = $_POST["eventCost"];
        $eventParams["sTicketURL"] = $_POST["ticketURL"];
        $eventParams["sDescription"] = $_POST["eventDescription"];
        //			$eventParams["sDetails"] = $_POST["eventDetails"];
        $eventParams["sDetails"] = $_POST["eventDescription"];
        $eventParams["sURL"] = $_POST["eventURL"];
        $eventParams["uFacebook"] = $_POST["eventFacebookURL"];
        $eventParams["uFoursquare"] = $_POST["eventFoursquareURL"];
        $eventParams["bTicketed"] = $_POST["eventTicketed"];
        $eventParams["zKeywords"] = $_POST["tags"];
        $eventParams["bAllDay"] = $_POST["eventAllDay"];
    
    
        if ($startDateTime != "") {
            $eventParams["tStart"] = date("Y-m-d H:i", strtotime($startDateTime));
        }
        else {
            $eventParams["tStart"] = date("Y-m-d H:i", strtotime($startDate . " " . $startHour . ":" . $startMinute . " " . $startMeridian));
    
        }
        if ($endDateTime != "") {
            $eventParams["tEnd"] = date("Y-m-d H:i", strtotime($endDateTime));
        }
        else {
            $eventParams["tEnd"] = date("Y-m-d H:i", strtotime($endDate . " " . $endHour . ":" . $endMinute . " " . $endMeridian));
        }
        	
        if ($eventParams["bAllDay"]) {
            $eventParams["tStart"] = date("Y-m-d", strtotime($startDate));
            $eventParams["tEnd"] = date("Y-m-d", strtotime($endDate));
        }
    
        foreach ($_POST as $postkey => $postvalue) {
            if (is_array($postvalue)) {
                $this->vars[$postkey]=json_encode($postvalue);
            }
            else {
                $this->vars[$postkey]=$postvalue;
            }
        }
    
        if ($category == "") {
            if (count($categories)<1) {
                $this->vars["alertError"]=true;
                $this->vars["errorMsg"]="Please select an Event Category.";
                return false;
            }
            else {
                error_log("Categories: Multiple Categories Selected");
                $category = $categories;
            }
        }
        else {
            $category = $category;
        }
        	
        if ($eventParams["sTitle"] == "") {
            $this->vars["alertError"]=true;
            $this->vars["errorMsg"]="Please enter an Event Title.";
            return false;
        }
    
        else if ($eventParams["tStart"] == "") {
            $this->vars["alertError"]=true;
            $this->vars["errorMsg"]="Please choose an Starting Date & Time.";
            return false;
        }
    
        else if ($eventParams["tEnd"] == "") {
            $this->vars["alertError"]=true;
            $this->vars["errorMsg"]="Please choose an Ending Date & Time.";
            return false;
        }
        	
        /*
         else if ($eventParams["sDetails"] == "") {
         $this->vars["alertError"]=true;
         $this->vars["errorMsg"]="Please provide details about the event.";
         }
         */
        	
        /*
         else if ($eventParams["sDescription"] == "") {
         $this->vars["alertError"]=true;
         $this->vars["errorMsg"]="Please provide a description about this event.";
         }
         */
        else if (strtotime($eventParams["tStart"]) > strtotime($eventParams["tEnd"])) {
            $this->vars["alertError"]=true;
            $this->vars["errorMsg"]="Please correct your Start and Ending times.";
            return false;
        }
        else {
            	
            //				$eventParams["fDuration"] = strtotime($eventParams["tEnd"]) - strtotime($eventParams["tStart"];
    
            if ($locationParams["eventLocation"] == "new") {
                if ($locationParams["newLocationName"] == "") {
                    $this->vars["alertError"]=true;
                    $this->vars["errorMsg"]="Please enter an Event Location Name.";
                    return false;
                }
                else {
                    $city = $locationParams["newCity"];
                    $state = $locationParams["newState"];
                    $zip = $locationParams["newPostalCode"];
                    $address = $locationParams["newAddress"];
                    $name = $locationParams["newLocationName"];
                    $locationID = $calendar->createLocation($name,$address,$city,$state,$zip, "", "", "", "", "", "", "", "",false);
                    $eventLocation = $locationID;
                    $locationParams["eventLocation"] = $eventLocation;
                    $locationParams["locationID"] = $eventLocation;
                    $locationParams["locationName"] = $name;
                    $eventParams["kLocationID"] = $locationID;
    
                    error_log("New Location Created: $locationID");
                }
            }
            else {
                $locationID = $locationParams["eventLocation"];
                $eventParams["kLocationID"] = $locationID;
            }
    
            //				$categoryName = $calendar->getCategoryByID($category);
            	
            //				if (!$categoryName){
            //					$this->vars["alertError"]=true;
            //					$this->vars["errorMsg"]="Please select a category.";
            //
            //				}
    
            if ($repeatParams["repeatFreq"] != "") {
                $eventRepeats = 1;
    
            }
            else {
                $eventRepeats = 0;
            }
    
            $location = $calendar->getLocationByID($eventParams["kLocationID"]);
    
            $locationParams["locationName"] = $location;
    
            if (($locationParams["eventLocation"] != "new") and ($locationParams["locationName"] == "")) {
                $this->vars["alertError"]=true;
                error_log("Bad Location: $location ". $locationParams["locationName"]);
                $this->vars["errorMsg"]="Please select a location.";
                return false;
            }
    
            else if ($eventParams["kLocationID"]<1) {
                $this->vars["alertError"]=true;
                error_log("Invalid Location: ". $eventParams["kLocationID"]);
                $this->vars["errorMsg"]="The location selected is not valid.";
                return false;
            }
    
            else {
    
                if (($_POST["submit"] == "Create") or ($_POST["submit"] == "Submit Event")) {
                    //						$eventID = $calendar->createEvent("1", $eventTitle, $eventDescription, $eventDetails, $category, $startDateTimeStr, $endDateTimeStr, $eventLocation, $eventLink, $eventRepeats);
                    $calendarID = $_POST["calendarID"];
                    if ($calendar->checkCalendarByUserID($this->userID, $calendarID)) {
                        $eventID = $calendar->addEvent($calendarID, $eventParams["sTitle"], $category, $eventRepeats, $eventParams, $repeatParams);
                        $this->vars["successMsg"]="Your new event was successfully added to the calendar. (ID: $eventID)";
                    }
                    else {
                        $eventID = $calendar->addEvent($calendarID, $eventParams["sTitle"], $category, $eventRepeats, $eventParams, $repeatParams);
                        $this->vars["successMsg"]="Your new event was successfully added to the calendar. (ID: $eventID)";
                        //							$this->vars["alertError"]=true;
                        //							$this->vars["errorMsg"]="An error occurred while saving this event.  The calendar selected is not available for your account.";
                    }
                }
                else if ($_POST["submit"] == "Save") {
                    $eventID = $_POST["eventID"];
                    $calendarID = $_POST["calendarID"];
                    if ($calendar->checkCalendarByUserID($this->userID, $calendarID)) {
                        $eventID = $calendar->updateEvent($eventID, $calendarID, $eventTitle, $eventDescription, $eventDetails, $category, $startDateTimeStr, $endDateTimeStr, $eventLocation, $eventLink, $eventRepeats);
                        $this->vars["successMsg"]="Your new event was saved and the calendar has been updated.";
                    }
                    else {
                        $this->vars["alertError"]=true;
                        $this->vars["errorMsg"]="An error occurred while saving this event.  The calendar selected is not available for your account.";
                    }
                }
    
                error_log("Event Saved: "  . $eventID);
    
                if ($eventID>0) {
    
                    $this->vars["alertSuccess"]=true;
    
                    //						return $this->manage($params);
    
                }
                	
                else {
                    $this->vars["alertError"]=true;
                    $this->vars["errorMsg"]="An error occurred while saving this event.  Please try again.";
                    return false;
                }
            }
        }
        	
    
    }
    
    
    public function view() {
    
        return $this->view;
    }
    
    public function transfer() {
    
        return $this->transfer;
    }
    
    public function data() {
    
        return $this->vars;
    }
    
    
    
    
    
    
    
    
    
    
}