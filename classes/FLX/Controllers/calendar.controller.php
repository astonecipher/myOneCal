<?php

/**
 * FILELOGIX CALENDAR CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace FLX\Controllers;

require_once('/mnt/stor9-wc1-dfw1/649984/www.onecal.co/web/content/lib/recaptcha/recaptchalib.php');

class calendar
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
	  
	  $this->search();

	  	 
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

		$this->vars["loginUsername"]="wbenwick@filelogix.net";


		$this->vars["dropdowns"] = $this->lists->retrieveByID("1");
		
	}
	
	public function addEventFromURL($params) {

	  $calendar = new \CAL\calendar($this->db);

	  error_log("AddEventFromURL: Add Event From URL.");

	  if ($this->auth->validate($this->userID)) {
// single sign on event adding
	  }
	  else {
	  
		  if (($_GET["submit"] == "Create") or ($_GET["submit"] == "Submit") or ($_GET["submit"] == "Submit Event") ) {

			    error_log("AddEventFromURL: Adding Event: " . $_GET["sTitle"]);

				$eventTitle = $_GET["sTitle"];
				$category = $_GET["kCategoryID"];
				$startDateTime = date('Y-m-d H:i', strtotime($_GET["dStartDate"] . ' ' . $_GET["tStartTime"]));
				$endDateTime = date('Y-m-d H:i', strtotime($_GET["dEndDate"] . ' ' . $_GET["tEndTime"]));
				$repeatFreq = $_GET["eFrequency"];
	//			$repeatWhen = $_GET["repeatWhen"];
	//			$repeatDay = $_GET["repeatDay"];
				$stopRepeating = date('Y-m-d',strtotime($_GET["dStopDate"]));
				$eventLocation = $_GET["kLocationName"];
				$newLocation = $_GET["kLocationName"];
				$description = $_GET["zDescription"];
				$eventCost = $_GET["fCost"];
				$ticketURL = $_GET["uTickets"];
				$eventDescription = $_GET["zDescription"];
				$eventDetails = $_GET["zDetail"];
				$eventLink = $_GET["uWebsite"];
				$eventTicketed = $_GET["bTicketed"];
				$eventRepeats = $_GET["bRepeats"];
					
				$startDateTimeStr = date("Y-m-d H:i", strtotime($startDateTime));
				$endDateTimeStr = date("Y-m-d H:i", strtotime($endDateTime));
							
				if ($category == "") {
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="Please select an Event Category.";				
				}
				
				else if ($eventTitle == "") {
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="Please enter an Event Title.";				
				}
	
				else if ($startDateTimeStr == "") {
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="Please choose an Starting Date & Time.";				
				}
	
				else if ($endDateTimeStr == "") {
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="Please choose an Ending Date & Time.";				
				}	
				
/*
				else if ($eventDetails == "") {
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="Please provide details about the event.";				
				}	
*/
				
/*
				else if ($eventDescription == "") {
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="Please provide a description about this event.";				
				}
*/	
				else if (strtotime($startDateTimeStr) > strtotime($endDateTimeStr)) {
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="Please correct your Start and Ending times.";					
				}
		
				$locationID = $calendar->createLocation($eventLocation,$_GET["sStreet"],$_GET["sCity"],$_GET["sState"],$_GET["sZipcode"],$_GET["sContactName"], $_GET["uWebsite"], $_GET["kAreaID"], 1, $_GET["kAreaID"], 1, 0, 0);		
				$eventLocation = $locationID;
				$locationName = $eventLocation;
		
				if ($locationID) {
				
				$categoryName = $calendar->getCategoryByID($category);
					
				if (!$categoryName){
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="Please select a category.";								

				}

				$locationName = $calendar->getLocationByID($eventLocation);
				
				if ($eventLocation == 0) {
						$locationID = $calendar->createLocation($name,$address,$city,$state,$zip, "", "", "", "", "", "", "", "",false);									
						$locationName = $name;
				}	
					
				if (!$locationName){
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="Please select a location. (404)";								

				}
				
				else {

					$repeats = array();	  

					$repeats["frequency"] = $_GET["eFrequency"];
					$repeats["startDate"] = date('Y-m-d', strtotime($startDateTimeStr));
					$repeats["endDate"] = date('Y-m-d',strtotime($_GET["dStopDate"]));

					$repeats["weekDays"] = date('w', strtotime($startDateTimeStr));
					$repeats["monthDays"] = date('d', strtotime($startDateTimeStr));
						
					if ($repeats["endDate"] == "0000-00-00") {
						//$repeats["endDate"] = date('Y-m-d', strtotime("+1 week", strtotime($oldEvent["date"])));
					}
					if ($repeats["endDate"] == "") {
						$repeats["endDate"] = date('Y-m-d', strtotime("+1 week", strtotime($oldEvent["date"])));
					}			

					if (($repeats["frequency"]=="Daily") or ($repeats["frequency"]=="Every Other Day")) {
						$repeats["weekDays"] = "127";
						$repeats["monthDays"] = "";
					}
					else if (($repeats["frequency"]=="Weekly") or ($repeats["frequency"]=="Every Other Week")) {
						$repeats["weekDays"] = date('w', strtotime($startDateTimeStr));
						$repeats["monthDays"] = "";
					}
					else if (($repeats["frequency"]=="Monthly")) {
						$repeats["weekDays"] = "";
						$repeats["monthDays"] = date('d', strtotime($startDateTimeStr));						
					}
					
					$repeats["excludeDays"] = "";
					$repeats["excludeDates"] = "";
						      				
					$params = array();
					
					$params["kCalendarID"] = 1;
					
					$params["sTitle"] = $eventTitle;
					$params["sDescription"] = $eventDescription;
					$params["sDetails"] = $eventDetails;
					$params["kCategoryID"] = $category;
					$params["tStart"] = $startDateTimeStr;
					$params["fDuration"] = date("H:i", strtotime($endDateTimeStr)-strtotime($startDateTimeStr)); 
					$params["tEnd"] = $endDateTimeStr; 
					$params["kLocationID"] = $locationID; 
					$params["sURL"] = $eventLink; 
					$params["sFriendlyURL"] = "";
					$params["sRefKey"] = "WEB"; 
					$params["kRefID"] = $this->sessionID;
					$params["sRefType"] = "addEventFromURL"; 
					$params["tModified"] = strtotime("now"); 
					$params["sContactName"] = $_GET["sContactName"];
					$params["sContactEmail"] = $_GET["sContactEmail"];
					if (floatval($eventCost)==0) {
						$params["bFree"] = 1;
					}
					else {
						$params["bFree"] = 0;						
					}
					$params["bConfirmed"] = "0";
					$params["iViews"] = "0";
					$params["bAllDay"] = $_GET["bAllDay"];
					$params["zKeywords"] = implode(",", $_GET["zTags"]);
					
					$eventID = $calendar->newEvent("1", $eventRepeats, $_GET["sTitle"], 0, $params, $repeats);		

				
//					$eventID = $calendar->createEvent("1", $eventTitle, $eventDescription, $eventDetails, $category, $startDateTimeStr, $endDateTimeStr,$eventLocation, $eventLink, $eventRepeats);
					$this->vars["successMsg"]="Your new event was successfully added to the calendar.";	
						
					error_log("Event Saved: "  . $eventID);
	
					if ($eventID>0) {
						
						$this->vars["alertSuccess"]=true;
								
						return $eventID;
					}
					
					else {
						$this->vars["alertError"]=true;
						$this->vars["errorMsg"]="An error occurred while saving this event.  Please try again. error: 1002";							
					}
				}
			}
				else {
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="Please correct your Start and Ending times.";					
				}
			}
	
	  }
		
	  return false;
	}
	
	public function add($params) {

	  $this->vars["formAction"]="/calendar/add/new";
	  
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
						if ($calendar->checkCalendarByUserID($this->userID, $calendarID)) {
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
		
			$this->view="CAL_MANAGE_EVENT";
			$this->vars["navCreateActive"]=true;
//			$this->vars["alertInfo"]=true;
//			$this->vars["infoMsg"]="The event was not saved, please try again.";
			
		}
		
  	    $this->vars["returnURL"] = "calendar/add/event/";
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

	public function event($params) {

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
	

	public function update($params) {
		
		return $this->add($params);
	}


	public function create($params) {

	  if ($this->auth->validate($this->userID)) {
		
		if ($_POST["submit"] == "Create") {
		
			return $this->add($params);
		
		}
		
		else {
		
			$this->view="CAL_NEW_EVENT_V2";
			$this->vars["navCreateActive"]=true;
			$this->vars["alertWarning"]=true;
			$this->vars["warningMsg"]="The event was not saved, please try again.";
			
		}

		return true;
	  }
	  
	  else {

		$this->view="CAL_LOGIN";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }

	}


	public function results($params) {

		$calendar = new \CAL\calendar($this->db);

		$categoryID = $_POST["category"];

		if (($_POST["fromDate"] == "") or ($_POST["toDate"] == "")) {
			
			$fromDate = date("Y/m/d", strtotime("now"));
			$toDate = date("Y/m/d", strtotime("+1 week"));			
			
		}
		
		else {	
		
			$fromDate = date("Y/m/d", strtotime($_POST["fromDate"]));
			$toDate = date("Y/m/d", strtotime($_POST["toDate"]));

		}

		$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
		$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);

		$this->vars["calDays"]=$days; 		
		$this->vars["events"]=$events; 		

		error_log("Dates: " . $fromDate . " " . $toDate);
			
//		$fromDateStr = new DateTime($fromDate);
//		$toDateStr = new DateTime($toDate);

		$this->vars["fromDate"]=date("m/d/y", strtotime($fromDate));
		$this->vars["toDate"]=date("m/d/y", strtotime($toDate));
		$this->vars["categoryID"]=$categoryID; 		
		
		$this->view="CAL_RESULTS";
		
		return true;		  
		  
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
		}
		
		else if ($params[3] == "next-week") {
			
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


	public function results2($params) {

		$calendar = new \CAL\calendar($this->db);

		$days = $calendar->getAllDaysByDateRange(1, "2013-08-30", "2013-10-04");
		$events = $calendar->getAllEventsByDateRange(1, "2013-09-30", "2014-10-04", $categoryID, $keywords, $areaID);

		$this->vars["events"]=$events; 		

		$this->view="CAL_RESULTS_NEW";
		
		return true;		  
		  
	}


	public function js($params) {

		$calendar = new \CAL\calendar($this->db);

#		$days = $calendar->getAllDaysByDateRange(1, "2013-08-30", "2013-10-04");
#		$events = $calendar->getAllEventsByDateRange(1, "2013-09-30", "2014-10-04", $categoryID);

#		$this->vars["events"]=$events; 		

		$this->vars["calendarView"]=$params[4]; 		

		if ($params[4] == '') {
			$this->vars["calendarView"]='large'; 					
		}
		
		if ($params[3] == "widget") {
			if ($params[4] == "add") {
				$this->view="CAL_JS_WIDGET_ADD_EVENT";
			}
			else {
				$this->view="CAL_JS_WIDGET";				
			}
		}
		else if ($params[3] == "popup") {
			$this->view="CAL_JS_POPUP";				

		}
		else {
			$this->view="CAL_JS_WIDGET";				

		}
		$dates = $calendar->repeatingDates("0", "", array("15"), "12", "", "2013-12-15", "2014-12-31");		

//		$dates = $calendar->repeatingDates("", "", array("1","15"), "2", "", "2013-10-30", "2014-12-31");		

		sort($dates, SORT_STRING);
	
		foreach($dates as $date) {
			error_log("Repeating Dates: $date " . date('D d M Y',strtotime($date)));
		}
	

		return true;		  
		  
	}


	public function js2($params) {

		$calendar = new \CAL\calendar($this->db);

#		$days = $calendar->getAllDaysByDateRange(1, "2013-08-30", "2013-10-04");
#		$events = $calendar->getAllEventsByDateRange(1, "2013-09-30", "2014-10-04", $categoryID);

#		$this->vars["events"]=$events; 		

		$this->vars["calendarView"]=$params[4]; 		

		if ($params[4] == '') {
			$this->vars["calendarView"]='large'; 					
		}
		
		if ($params[3] == "widget") {
			$this->view="CAL_JS_WIDGET2";				
		}
		else if ($params[3] == "popup") {
			$this->view="CAL_JS_POPUP";				

		}
		else {
			$this->view="CAL_JS_WIDGET2";				

		}
		$dates = $calendar->repeatingDates("0", "", array("15"), "12", "", "2013-12-15", "2014-12-31");		

//		$dates = $calendar->repeatingDates("", "", array("1","15"), "2", "", "2013-10-30", "2014-12-31");		

		sort($dates, SORT_STRING);
	
		foreach($dates as $date) {
			error_log("Repeating Dates: $date " . date('D d M Y',strtotime($date)));
		}
	

		return true;		  
		  
	}

	public function jsMAA($params) {

		$calendar = new \CAL\calendar($this->db);

#		$days = $calendar->getAllDaysByDateRange(1, "2013-08-30", "2013-10-04");
#		$events = $calendar->getAllEventsByDateRange(1, "2013-09-30", "2014-10-04", $categoryID);

#		$this->vars["events"]=$events; 		

		$this->vars["calendarView"]=$params[4]; 		

		if ($params[4] == '') {
			$this->vars["calendarView"]='large'; 					
		}
		
		if ($params[3] == "widget") {
			$this->view="CAL_JS_MAA_WIDGET2";				
		}
		else if ($params[3] == "popup") {
			$this->view="CAL_JS_MAA_POPUP";				

		}
		else {
			$this->view="CAL_JS_MAA_WIDGET2";				

		}
		$dates = $calendar->repeatingDates("0", "", array("15"), "12", "", "2013-12-15", "2014-12-31");		

//		$dates = $calendar->repeatingDates("", "", array("1","15"), "2", "", "2013-10-30", "2014-12-31");		

		sort($dates, SORT_STRING);
	
		foreach($dates as $date) {
			error_log("Repeating Dates: $date " . date('D d M Y',strtotime($date)));
		}
	

		return true;		  
		  
	}


	public function standard($params) {

		$calendar = new \CAL\calendar($this->db);

#		$days = $calendar->getAllDaysByDateRange(1, "2013-08-30", "2013-10-04");
#		$events = $calendar->getAllEventsByDateRange(1, "2013-09-30", "2014-10-04", $categoryID);

#		$this->vars["events"]=$events; 		

		$this->vars["calendarView"]=$params[4]; 		

		if ($params[4] == '') {
			$this->vars["calendarView"]='large'; 					
		}
		
		if ($params[3] == "widget") {
			$this->view="CAL_JS_WIDGET_STD";				
		}
		else if ($params[3] == "popup") {
			$this->view="CAL_JS_WIDGET_STD";				

		}
		else {
			$this->view="CAL_JS_WIDGET_STD";				

		}
//		$dates = $calendar->repeatingDates("0", "", array("15"), "12", "", "2013-12-15", "2014-12-31");		

//		$dates = $calendar->repeatingDates("", "", array("1","15"), "2", "", "2013-10-30", "2014-12-31");		

		sort($dates, SORT_STRING);
	
		foreach($dates as $date) {
			error_log("Repeating Dates: $date " . date('D d M Y',strtotime($date)));
		}
	

		return true;		  
		  
	}

	public function widget($params) {

		$calendar = new \CAL\calendar($this->db);

#		$days = $calendar->getAllDaysByDateRange(1, "2013-08-30", "2013-10-04");
#		$events = $calendar->getAllEventsByDateRange(1, "2013-09-30", "2014-10-04", $categoryID);

#		$this->vars["events"]=$events; 		

		if ($params[3] == "add") {

		$calendar = new \CAL\calendar($this->db);

	  			$this->vars["canSubmit"] = TRUE;
	  			$this->vars["canCopy"] = FALSE;
			  	$this->vars["copyDisabled"] = TRUE;

				if (($_POST["submit"] == "Create") or ($_POST["submit"] == "Submit") or ($_POST["submit"] == "Submit Event")) {
				
					$this->submitEvent($params,$calendar);
				}

    			$this->vars["categories"]=$this->calendar->getCategoriesNotAll();
				$this->vars["locations"]=$calendar->getGeocodedLocations();
				$this->vars["formAction"]="/calendar/submit/new";
		
				$this->view="CAL_SUBMIT_EVENT";
				
				return true;
		}
		
		else {

			error_log("From Date: " . $_GET["from"]);
	
	
			if($_GET["from"]) {
				$fromDate = date("Y/m/d", strtotime(urldecode($_GET["from"])));		
			}
			else {
				$fromDate = date("Y/m/d", strtotime("now"));
			}
			
			if($_GET["to"]) {
				$toDate = date("Y/m/d", strtotime(urldecode($_GET["to"])));		
			}
			else {
				$toDate = date("Y/m/d", strtotime("+2 week"));	
			}	
			
			if ($_GET["category"]) {
				$categoryID=urldecode($_GET["category"]);
				if ($categoryID==99) {
					$categoryID="";
				}
			}	
			else {
				$categoryID="";
			}
			
			if ($_GET["area"]) {
				$areaID=urldecode($_GET["area"]);
	
			}	
			else {
				$areaID="";
			}
					
			if ($_GET["keywords"]) {
				$keywords=urldecode($_GET["keywords"]);
			}	
			else {
				$keywords="";
			}
	
			error_log("Search: " . $fromDate . " " . $toDate);
			
			$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
			$events = $calendar->getTopEvents(1, $fromDate, $toDate);
	
		
			$this->vars["fromDate"]=date("m/d/y", strtotime($fromDate));
			$this->vars["toDate"]=date("m/d/y", strtotime($toDate));
			$this->vars["categoryID"]=$categoryID; 		
	
		
			$this->vars["calDays"]=$days; 		
			$this->vars["events"]=$events; 
	
			if($params[3]=="small") { 		
	
				$this->view="CAL_SMALL_BODY";				
				if ($params[4]=="event") {
					if ($params[5]=="id") {
						error_log("Show Event ID: " . $params[6]);
						$this->vars["eventID"] = $params[6]; 
						$this->vars["event"] = 	$calendar->getEventByID($params[6]);	
						$this->view="CAL_WIDGET_SMALL_DETAILS";									
					}
					else {
						$this->view="CAL_SMALL_BODY";								
					}
				}
				else if ($params[4]=="go") {
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				
					
	//				$this->view="CAL_WIDGET_SMALL_EVENT_LIST";													
					$this->view="CAL_WIDGET_SMALL_RESULT_LIST";													
				}
				else if ($params[4]=="day") {
					$fromDate = urldecode($params[5]);
					$toDate = urldecode($params[5]);
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events;  
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
									
					$this->view="CAL_WIDGET_SMALL_RESULT_LIST";													
				}
	
				else if ($params[4]=="days") {
					$fromDate = urldecode($params[5]);
					$toDate = urldecode($params[6]);
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events;  
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
									
					$this->view="CAL_WIDGET_SMALL_RESULT_LIST";													
				}
	
				else if ($params[4]=="next") {
					$fromDate = urldecode($params[5]);
					$toDate = urldecode($params[6]);
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events;  
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
	
					$this->view="CAL_WIDGET_SMALL_RESULT_LIST";													
				}
				
				else if ($params[4]=="previous") {
					$fromDate = urldecode($params[5]);
					$toDate = urldecode($params[6]);
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events;  
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
													
					$this->view="CAL_WIDGET_SMALL_RESULT_LIST";													
				}
							
				else if ($params[4]=="nextWeek") {
		
					$fromDate = date("Y/m/d", strtotime("+7 days"));
					$toDate = date("Y/m/d", strtotime("+14 days"));
	
	//				error_log("Next Week: " . $fromDate . " " . $toDate);
	
					$_POST["fromDate"] = $fromDate;
					$_POST["toDate"] = $toDate;
		
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("last day of last week"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("first day of last week"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("last day of next week"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("first day of next week"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
												
					$this->view="CAL_WIDGET_SMALL_RESULT_LIST";													
				}	
	
				else if ($params[4]=="nextMonth") {
		
					$fromDate = date("Y/m/d", strtotime("first day of next month"));
					$toDate = date("Y/m/d", strtotime("last day of next month"));
	
	//				error_log("Next Week: " . $fromDate . " " . $toDate);
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
	
					$_POST["fromDate"] = $fromDate;
					$_POST["toDate"] = $toDate;
		
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$toDate - 1 month"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 month"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 month"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$fromDate + 1 month"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
												
					$this->view="CAL_WIDGET_SMALL_RESULT_LIST";													
				}	
	
				else if ($params[4]=="thisMonth") {
		
					$fromDate = date("Y/m/d", strtotime("first day of this month"));
					$toDate = date("Y/m/d", strtotime("last day of this month"));
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
					
	//				error_log("Next Week: " . $fromDate . " " . $toDate);
	
					$_POST["fromDate"] = $fromDate;
					$_POST["toDate"] = $toDate;
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("last day of last month"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("first day of last month"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("last day of next month"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("first day of next month"));
		
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
								
					$this->view="CAL_WIDGET_SMALL_RESULT_LIST";													
				}
				else {
					$this->vars["previousTo"]=date("Y/m/d", strtotime("yesterday"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("yesterday"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("tomorrow"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("tomorrow"));
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
					$this->view="CAL_SMALL_BODY";				
				}
	
			}
	
			else if($params[3]=="medium") { 		
	
				$this->view="CAL_MEDIUM_BODY";				
				if ($params[4]=="event") {
					if ($params[5]=="id") {
						error_log("Show Event ID: " . $params[6]);
						$this->vars["eventID"] = $params[6]; 
						$this->vars["event"] = 	$calendar->getEventByID($params[6]);	
						$this->view="CAL_WIDGET_MEDIUM_DETAILS";									
					}
					else {
						$this->view="CAL_MEDIUM_BODY";								
					}
				}
				else if ($params[4]=="go") {
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				
					
	//				$this->view="CAL_WIDGET_SMALL_EVENT_LIST";													
					$this->view="CAL_WIDGET_MEDIUM_RESULT_LIST";													
				}
	
				else if ($params[4]=="add") {
													
					$this->view="CAL_WIDGET_MEDIUM_ADDEVENT_BODY";													
				}
				
				else if ($params[4]=="day") {
					$fromDate = urldecode($params[5]);
					$toDate = urldecode($params[5]);
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events;  
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
									
					$this->view="CAL_WIDGET_MEDIUM_RESULT_LIST";													
				}
	
				else if ($params[4]=="days") {
					$fromDate = urldecode($params[5]);
					$toDate = urldecode($params[6]);
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events;  
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
									
					$this->view="CAL_WIDGET_MEDIUM_RESULT_LIST";													
				}
	
				else if ($params[4]=="next") {
					$fromDate = urldecode($params[5]);
					$toDate = urldecode($params[6]);
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events;  
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
	
					$this->view="CAL_WIDGET_MEDIUM_RESULT_LIST";													
				}
				
				else if ($params[4]=="previous") {
					$fromDate = urldecode($params[5]);
					$toDate = urldecode($params[6]);
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events;  
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
													
					$this->view="CAL_WIDGET_MEDIUM_RESULT_LIST";													
				}
							
				else if ($params[4]=="nextWeek") {
		
					$fromDate = date("Y/m/d", strtotime("+7 days"));
					$toDate = date("Y/m/d", strtotime("+14 days"));
	
	//				error_log("Next Week: " . $fromDate . " " . $toDate);
	
					$_POST["fromDate"] = $fromDate;
					$_POST["toDate"] = $toDate;
		
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("last day of last week"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("first day of last week"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("last day of next week"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("first day of next week"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
												
					$this->view="CAL_WIDGET_MEDIUM_RESULT_LIST";													
				}	
	
				else if ($params[4]=="nextMonth") {
		
					$fromDate = date("Y/m/d", strtotime("first day of next month"));
					$toDate = date("Y/m/d", strtotime("last day of next month"));
	
	//				error_log("Next Week: " . $fromDate . " " . $toDate);
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
	
					$_POST["fromDate"] = $fromDate;
					$_POST["toDate"] = $toDate;
		
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$toDate - 1 month"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 month"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 month"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$fromDate + 1 month"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
												
					$this->view="CAL_WIDGET_MEDIUM_RESULT_LIST";													
				}	
	
				else if ($params[4]=="thisMonth") {
		
					$fromDate = date("Y/m/d", strtotime("first day of this month"));
					$toDate = date("Y/m/d", strtotime("last day of this month"));
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
					
	//				error_log("Next Week: " . $fromDate . " " . $toDate);
	
					$_POST["fromDate"] = $fromDate;
					$_POST["toDate"] = $toDate;
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("last day of last month"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("first day of last month"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("last day of next month"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("first day of next month"));
		
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
								
					$this->view="CAL_WIDGET_MEDIUM_RESULT_LIST";													
				}
				else {
					$this->vars["previousTo"]=date("Y/m/d", strtotime("yesterday"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("yesterday"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("tomorrow"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("tomorrow"));
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
					$this->view="CAL_MEDIUM_BODY";				
				}
	
			}
	
	
			else if($params[3]=="large") { 		
				if ($params[4]=="event") {
					if ($params[5]=="id") {
						error_log("Show Event ID: " . $params[6]);
						$this->vars["eventID"] = $params[6]; 
						$this->vars["event"] = 	$calendar->getEventByID($params[6]);	
						$this->view="CAL_WIDGET_LARGE_DETAILS";									
			
						$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
						$this->vars["calDays"]=$days; 
						
						$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
						$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
						$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
						$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
	
	//					$this->vars["address"] = urlencode($this->vars["event"]["locationName"] . " " . $this->vars["event"]["zAddress"] . " " . $this->vars["event"]["zipcode"]);
						$this->vars["address"] = urlencode($this->vars["event"]["zAddress"] . " " . $this->vars["event"]["sCity"] . "," . $this->vars["event"]["sState"] . "  " .$this->vars["event"]["zipcode"]);
						
						$this->vars["bGeocoded"] = $this->vars["event"]["bGeocoded"];
						$this->vars["sLat"] = $this->vars["event"]["sLat"];
						$this->vars["sLon"] = $this->vars["event"]["sLon"];
						
						$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
						$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
										
					}
					else {
						$this->view="CAL_LARGE_BODY";								
					}
				}
				else if ($params[4]=="add") {
					if ($params[5]=="event") {
						$_GET["submit"] = "Submit Event";
						$newEventID = $this->addEventFromURL($params);
						if ($newEventID) {
							error_log("Show Event ID: " . $newEventID);
							$this->vars["eventID"] = $newEventID; 
							$this->vars["event"] = 	$calendar->getEventByID($newEventID);	
							$this->vars["address"] = urlencode($this->vars["event"]["zAddress"] . " " . $this->vars["event"]["sCity"] . "," . $this->vars["event"]["sState"] . "  " .$this->vars["event"]["zipcode"]);
							$this->vars["bGeocoded"] = $this->vars["event"]["bGeocoded"];
							$this->vars["sLat"] = $this->vars["event"]["sLat"];
							$this->vars["sLon"] = $this->vars["event"]["sLon"];
							$this->view="CAL_LARGE_DETAILS_BODY";		
						}
						else {
							error_log("Event Not Added.");
							foreach ($_GET as $getkey => $getvalue) {
				    			$this->vars[$getkey]=$getvalue;
							}
							$this->view="CAL_LARGE_ADDEVENT_BODY";										
	
						}
					}
					else {
						$this->view="CAL_LARGE_ADDEVENT_BODY";										
					}
				}
				else if ($params[4]=="tell-a-friend") {
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				
					
					$this->view="CAL_WIDGET_LARGE_TELL_A_FRIEND";													
				}			
				else if ($params[4]=="newsletter") {
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				
					
					$this->view="CAL_WIDGET_LARGE_NEWSLETTER_SIGNUP";													
				}			
				else if ($params[4]=="go") {
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				
					
					$this->view="CAL_WIDGET_LARGE_EVENT_LIST";													
				}
				else if ($params[4]=="day") {
					$fromDate = urldecode($params[5]);
					$toDate = urldecode($params[5]);
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events;  
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
									
					$this->view="CAL_WIDGET_LARGE_EVENT_LIST";													
				}
	
				else if ($params[4]=="days") {
					$fromDate = urldecode($params[5]);
					$toDate = urldecode($params[6]);
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events;  
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
									
					$this->view="CAL_WIDGET_LARGE_EVENT_LIST";													
				}
	
				else if ($params[4]=="next") {
					if ($params[5]=="event") {
						error_log("Show Event ID: " . $params[6]);
						$this->vars["eventID"] = $params[6]; 
						$this->vars["event"] = 	$calendar->getNextEventByID(1, $fromDate, $toDate, $categoryID, $keywords, $areaID,$params[6]);	
						$this->vars["address"] = urlencode($this->vars["event"]["zAddress"] . " " . $this->vars["event"]["sCity"] . "," . $this->vars["event"]["sState"] . "  " .$this->vars["event"]["zipcode"]);
						$this->vars["bGeocoded"] = $this->vars["event"]["bGeocoded"];
						$this->vars["sLat"] = $this->vars["event"]["sLat"];
						$this->vars["sLon"] = $this->vars["event"]["sLon"];
						$this->view="CAL_LARGE_DETAILS_BODY";						
					}
					else {
						$fromDate = urldecode($params[5]);
						$toDate = urldecode($params[6]);
						$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
						$this->vars["events"]=$events;  
		
						$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
						$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
						$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
						$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
		
						$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
						$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
		
						$this->view="CAL_WIDGET_LARGE_EVENT_LIST";									
					}				
				}
				
				else if ($params[4]=="previous") {
					if ($params[5]=="event") {
						error_log("Show Event ID: " . $params[6]);
						$this->vars["eventID"] = $params[6]; 
						$this->vars["event"] = 	$calendar->getPreviousEventByID(1, $fromDate, $toDate, $categoryID, $keywords, $areaID, $params[6]);	
						$this->vars["address"] = urlencode($this->vars["event"]["zAddress"] . " " . $this->vars["event"]["sCity"] . "," . $this->vars["event"]["sState"] . "  " .$this->vars["event"]["zipcode"]);
						$this->vars["bGeocoded"] = $this->vars["event"]["bGeocoded"];
						$this->vars["sLat"] = $this->vars["event"]["sLat"];
						$this->vars["sLon"] = $this->vars["event"]["sLon"];
						$this->view="CAL_LARGE_DETAILS_BODY";						
					}
					else {
						$fromDate = urldecode($params[5]);
						$toDate = urldecode($params[6]);
						$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
						$this->vars["events"]=$events;  
		
						$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
						$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
						$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
						$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
		
						$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
						$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
														
						$this->view="CAL_WIDGET_LARGE_EVENT_LIST";	
					}												
				}
							
				else if ($params[4]=="nextWeek") {
		
					$fromDate = date("Y/m/d", strtotime("+7 days"));
					$toDate = date("Y/m/d", strtotime("+14 days"));
	
	//				error_log("Next Week: " . $fromDate . " " . $toDate);
	
					$_POST["fromDate"] = $fromDate;
					$_POST["toDate"] = $toDate;
		
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("last day of last week"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("first day of last week"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("last day of next week"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("first day of next week"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
												
					$this->view="CAL_WIDGET_LARGE_EVENT_LIST";					
				}	
	
				else if ($params[4]=="nextMonth") {
		
					$fromDate = date("Y/m/d", strtotime("first day of next month"));
					$toDate = date("Y/m/d", strtotime("last day of next month"));
	
	//				error_log("Next Week: " . $fromDate . " " . $toDate);
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
	
					$_POST["fromDate"] = $fromDate;
					$_POST["toDate"] = $toDate;
		
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$toDate - 1 month"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 month"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 month"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$fromDate + 1 month"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
												
					$this->view="CAL_WIDGET_LARGE_EVENT_LIST";					
				}	
	
				else if ($params[4]=="thisMonth") {
		
					$fromDate = date("Y/m/d", strtotime("first day of this month"));
					$toDate = date("Y/m/d", strtotime("last day of this month"));
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
					
	//				error_log("Next Week: " . $fromDate . " " . $toDate);
	
					$_POST["fromDate"] = $fromDate;
					$_POST["toDate"] = $toDate;
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("last day of last month"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("first day of last month"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("last day of next month"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("first day of next month"));
		
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
								
					$this->view="CAL_WIDGET_LARGE_EVENT_LIST";					
				}
				else {
					$this->vars["previousTo"]=date("Y/m/d", strtotime("yesterday"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("yesterday"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("tomorrow"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("tomorrow"));
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
					$this->view="CAL_LARGE_BODY";				
				}
			}
			else if($params[3]=="zebra") {
				$this->view="CAL_WIDGET_ZEBRA_DATEPICKER";
		    }		
	
			else if($params[3]=="standard") {
				if($_GET["start"]) {
					if (is_numeric(urldecode($_GET["start"]))) {
						$fromDate = date("Y-m-d", urldecode($_GET["start"]));		
					}
					else {
						$fromDate = date("Y-m-d", strtotime(urldecode($_GET["start"])));						
					}
				}
				else {
					$fromDate = date("Y-m-d", strtotime("now"));
				}
				
				if($_GET["end"]) {
					if (is_numeric(urldecode($_GET["end"]))) {
						$toDate = date("Y-m-d", urldecode($_GET["end"]));		
					}
					else {				
						$toDate = date("Y-m-d", strtotime(urldecode($_GET["end"])));		
					}
				}
				else {
					$toDate = date("Y-m-d", strtotime("+6 weeks"));	
				}	
				
				if ($_GET["category"]) {
					$categoryID=urldecode($_GET["category"]);
					if ($categoryID==99) {
						$categoryID="";
					}
				}	
				else {
					$categoryID="";
				}
				
				if ($_GET["area"]) {
					$areaID=urldecode($_GET["area"]);
		
				}	
				else {
					$areaID="";
				}
						
				if ($_GET["keywords"]) {
					$keywords=urldecode($_GET["keywords"]);
				}	
				else {
					$keywords="";
				}
				
				$calendar = new \CAL\calendar($this->db);
		
				$events = $calendar->getRatedEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID,10);
				$this->vars["events"]=$events; 
				$this->vars["categories"]=$calendar->getAllCategories();
				$this->vars["areas"]=$calendar->getAllAreas(1);	
		
				$this->view="CAL_WIDGET_STD_CALENDAR";
			}
			
			else if ($params[3]=="event") {
				if ($params[4]=="add") {
					$this->view="CAL_LARGE_ADDEVENT_BODY";					
				}
				else if ($params[4]=="details") {
						error_log("Show Event ID: " . $params[5]);
						$this->vars["eventID"] = $params[5]; 
						$this->vars["event"] = 	$calendar->getEventByID($params[5]);	
						$this->vars["address"] = urlencode($this->vars["event"]["zAddress"] . " " . $this->vars["event"]["sCity"] . "," . $this->vars["event"]["sState"] . "  " .$this->vars["event"]["zipcode"]);
						$this->vars["bGeocoded"] = $this->vars["event"]["bGeocoded"];
						$this->vars["sLat"] = $this->vars["event"]["sLat"];
						$this->vars["sLon"] = $this->vars["event"]["sLon"];
						$this->view="CAL_LARGE_DETAILS_BODY";					
				}
			}
			else if ($params[3]=="addEvent") {
				$this->view="CAL_LARGE_ADDEVENT_BODY";					
			}
			else if ($params[3]=="nextWeek") {
	
				$fromDate = date("Y/m/d", strtotime("next Monday"));
				$toDate = date("Y/m/d", strtotime("next Monday +7 days"));
	
				error_log("Next Week: " . $fromDate . " " . $toDate);
	
				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;			
				
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
	
	#			$this->vars["calDays"]=$days; 		
				$this->vars["events"]=$events; 
			
				$this->view="CAL_WIDGET_LARGE_EVENT_LIST";					
			}
			else if ($params[3]=="add") {
				if ($params[4]=="event") {
					$_GET["submit"] = "Submit Event";
					$newEventID = $this->addEventFromURL($params);
					if ($newEventID) {
						error_log("Show Event ID: " . $newEventID);
						$this->vars["eventID"] = $newEventID; 
						$this->vars["event"] = 	$calendar->getEventByID($newEventID);	
						$this->vars["address"] = urlencode($this->vars["event"]["zAddress"] . " " . $this->vars["event"]["sCity"] . "," . $this->vars["event"]["sState"] . "  " .$this->vars["event"]["zipcode"]);
						$this->vars["bGeocoded"] = $this->vars["event"]["bGeocoded"];
						$this->vars["sLat"] = $this->vars["event"]["sLat"];
						$this->vars["sLon"] = $this->vars["event"]["sLon"];
						$this->view="CAL_LARGE_DETAILS_BODY";		
					}
					else {
						error_log("Event Not Added.");
						foreach ($_GET as $getkey => $getvalue) {
			    			$this->vars[$getkey]=$getvalue;
						}
						$this->view="CAL_LARGE_ADDEVENT_BODY";										
	
					}
				}
				else {
					$this->view="CAL_LARGE_ADDEVENT_BODY";										
				}
			}
			else if($params[3]=="full") { 		
				if ($params[4]=="event") {
					if ($params[5]=="id") {
						error_log("Show Event ID: " . $params[6]);
						$this->vars["eventID"] = $params[6]; 
						$this->vars["event"] = 	$calendar->getEventByID($params[6]);	
						$this->view="CAL_FULL_DETAILS_BODY";									
			
						$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
						$this->vars["calDays"]=$days; 
						
						$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
						$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
						$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
						$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
	
	//					$this->vars["address"] = urlencode($this->vars["event"]["locationName"] . " " . $this->vars["event"]["zAddress"] . " " . $this->vars["event"]["zipcode"]);
						$this->vars["address"] = urlencode($this->vars["event"]["zAddress"] . " " . $this->vars["event"]["sCity"] . "," . $this->vars["event"]["sState"] . "  " .$this->vars["event"]["zipcode"]);
						
						$this->vars["bGeocoded"] = $this->vars["event"]["bGeocoded"];
						$this->vars["sLat"] = $this->vars["event"]["sLat"];
						$this->vars["sLon"] = $this->vars["event"]["sLon"];
						
						$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
						$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
										
					}
					else {
						$this->view="CAL_FULL_BODY";								
					}
				}
				else if ($params[4]=="add") {
					if ($params[5]=="event") {
						$_GET["submit"] = "Submit Event";
						$newEventID = $this->addEventFromURL($params);
						if ($newEventID) {
							error_log("Show Event ID: " . $newEventID);
							$this->vars["eventID"] = $newEventID; 
							$this->vars["event"] = 	$calendar->getEventByID($newEventID);	
							$this->vars["address"] = urlencode($this->vars["event"]["zAddress"] . " " . $this->vars["event"]["sCity"] . "," . $this->vars["event"]["sState"] . "  " .$this->vars["event"]["zipcode"]);
							$this->vars["bGeocoded"] = $this->vars["event"]["bGeocoded"];
							$this->vars["sLat"] = $this->vars["event"]["sLat"];
							$this->vars["sLon"] = $this->vars["event"]["sLon"];
							$this->view="CAL_FULL_DETAILS_BODY";		
						}
						else {
							error_log("Event Not Added.");
							foreach ($_GET as $getkey => $getvalue) {
				    			$this->vars[$getkey]=$getvalue;
							}
							$this->view="CAL_FULL_ADDEVENT_BODY";										
	
						}
					}
					else {
						$this->view="CAL_FULL_ADDEVENT_BODY";										
					}
				}
				else if ($params[4]=="tell-a-friend") {
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				
					
					$this->view="CAL_WIDGET_FULL_TELL_A_FRIEND";													
				}			
				else if ($params[4]=="newsletter") {
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				
					
					$this->view="CAL_WIDGET_FULL_NEWSLETTER_SIGNUP";													
				}			
				else if ($params[4]=="go") {
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
				
					
					$this->view="CAL_WIDGET_FULL_EVENT_LIST";													
				}
				else if ($params[4]=="day") {
					$fromDate = urldecode($params[5]);
					$toDate = urldecode($params[5]);
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events;  
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
									
					$this->view="CAL_WIDGET_FULL_EVENT_LIST";													
				}
	
				else if ($params[4]=="days") {
					$fromDate = urldecode($params[5]);
					$toDate = urldecode($params[6]);
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events;  
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
									
					$this->view="CAL_WIDGET_FULL_EVENT_LIST";													
				}
	
				else if ($params[4]=="next") {
					if ($params[5]=="event") {
						error_log("Show Event ID: " . $params[6]);
						$this->vars["eventID"] = $params[6]; 
						$this->vars["event"] = 	$calendar->getNextEventByID(1, $fromDate, $toDate, $categoryID, $keywords, $areaID,$params[6]);	
						$this->vars["address"] = urlencode($this->vars["event"]["zAddress"] . " " . $this->vars["event"]["sCity"] . "," . $this->vars["event"]["sState"] . "  " .$this->vars["event"]["zipcode"]);
						$this->vars["bGeocoded"] = $this->vars["event"]["bGeocoded"];
						$this->vars["sLat"] = $this->vars["event"]["sLat"];
						$this->vars["sLon"] = $this->vars["event"]["sLon"];
						$this->view="CAL_FULL_DETAILS_BODY";						
					}
					else {
						$fromDate = urldecode($params[5]);
						$toDate = urldecode($params[6]);
						$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
						$this->vars["events"]=$events;  
		
						$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
						$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
						$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
						$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
		
						$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
						$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
		
						$this->view="CAL_WIDGET_FULL_EVENT_LIST";									
					}				
				}
				
				else if ($params[4]=="previous") {
					if ($params[5]=="event") {
						error_log("Show Event ID: " . $params[6]);
						$this->vars["eventID"] = $params[6]; 
						$this->vars["event"] = 	$calendar->getPreviousEventByID(1, $fromDate, $toDate, $categoryID, $keywords, $areaID, $params[6]);	
						$this->vars["address"] = urlencode($this->vars["event"]["zAddress"] . " " . $this->vars["event"]["sCity"] . "," . $this->vars["event"]["sState"] . "  " .$this->vars["event"]["zipcode"]);
						$this->vars["bGeocoded"] = $this->vars["event"]["bGeocoded"];
						$this->vars["sLat"] = $this->vars["event"]["sLat"];
						$this->vars["sLon"] = $this->vars["event"]["sLon"];
						$this->view="CAL_FULL_DETAILS_BODY";						
					}
					else {
						$fromDate = urldecode($params[5]);
						$toDate = urldecode($params[6]);
						$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
						$this->vars["events"]=$events;  
		
						$this->vars["previousTo"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
						$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 day"));
						$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 day"));
						$this->vars["nextFrom"]=date("Y/m/d", strtotime("$toDate + 1 day"));
		
						$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
						$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));
														
						$this->view="CAL_WIDGET_FULL_EVENT_LIST";	
					}												
				}
							
				else if ($params[4]=="nextWeek") {
		
					$fromDate = date("Y/m/d", strtotime("+7 days"));
					$toDate = date("Y/m/d", strtotime("+14 days"));
	
	//				error_log("Next Week: " . $fromDate . " " . $toDate);
	
					$_POST["fromDate"] = $fromDate;
					$_POST["toDate"] = $toDate;
		
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("last day of last week"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("first day of last week"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("last day of next week"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("first day of next week"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
												
					$this->view="CAL_WIDGET_FULL_EVENT_LIST";					
				}	
	
				else if ($params[4]=="nextMonth") {
		
					$fromDate = date("Y/m/d", strtotime("first day of next month"));
					$toDate = date("Y/m/d", strtotime("last day of next month"));
	
	//				error_log("Next Week: " . $fromDate . " " . $toDate);
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
	
					$_POST["fromDate"] = $fromDate;
					$_POST["toDate"] = $toDate;
		
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("$toDate - 1 month"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("$fromDate - 1 month"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("$toDate + 1 month"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("$fromDate + 1 month"));
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
												
					$this->view="CAL_WIDGET_FULL_EVENT_LIST";					
				}	
	
				else if ($params[4]=="thisMonth") {
		
					$fromDate = date("Y/m/d", strtotime("first day of this month"));
					$toDate = date("Y/m/d", strtotime("last day of this month"));
	
					$days = $calendar->getAllDaysByDateRange(1, $fromDate, $toDate);
					$this->vars["calDays"]=$days; 
					
	//				error_log("Next Week: " . $fromDate . " " . $toDate);
	
					$_POST["fromDate"] = $fromDate;
					$_POST["toDate"] = $toDate;
	
					$this->vars["previousTo"]=date("Y/m/d", strtotime("last day of last month"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("first day of last month"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("last day of next month"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("first day of next month"));
		
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
	
					$this->vars["fromDate"]=date("m/d/Y",strtotime($fromDate));
					$this->vars["toDate"]=date("m/d/Y",strtotime($toDate));	
								
					$this->view="CAL_WIDGET_FULL_EVENT_LIST";					
				}
				else {
					$this->vars["previousTo"]=date("Y/m/d", strtotime("yesterday"));
					$this->vars["previousFrom"]=date("Y/m/d", strtotime("yesterday"));
					$this->vars["nextTo"]=date("Y/m/d", strtotime("tomorrow"));
					$this->vars["nextFrom"]=date("Y/m/d", strtotime("tomorrow"));
					$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
					$this->vars["events"]=$events; 
					$this->view="CAL_FULL_BODY";				
				}
			}
			
			else if ($params[3]=="event") {
				if ($params[4]=="add") {
					$this->view="CAL_LARGE_ADDEVENT_BODY";					
				}
				else if ($params[4]=="details") {
						error_log("Show Event ID: " . $params[5]);
						$this->vars["eventID"] = $params[5]; 
						$this->vars["event"] = 	$calendar->getEventByID($params[5]);	
						$this->vars["address"] = urlencode($this->vars["event"]["zAddress"] . " " . $this->vars["event"]["sCity"] . "," . $this->vars["event"]["sState"] . "  " .$this->vars["event"]["zipcode"]);
						$this->vars["bGeocoded"] = $this->vars["event"]["bGeocoded"];
						$this->vars["sLat"] = $this->vars["event"]["sLat"];
						$this->vars["sLon"] = $this->vars["event"]["sLon"];
						$this->view="CAL_FULL_DETAILS_BODY";					
				}
			}
			else if ($params[3]=="addEvent") {
				$this->view="CAL_LARGE_ADDEVENT_BODY";					
			}
			else if ($params[3]=="nextWeek") {
	
				$fromDate = date("Y/m/d", strtotime("next Monday"));
				$toDate = date("Y/m/d", strtotime("next Monday +7 days"));
	
				error_log("Next Week: " . $fromDate . " " . $toDate);
	
				$_POST["fromDate"] = $fromDate;
				$_POST["toDate"] = $toDate;			
				
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
	
	#			$this->vars["calDays"]=$days; 		
				$this->vars["events"]=$events; 
			
				$this->view="CAL_WIDGET_LARGE_EVENT_LIST";					
			}
			else if ($params[3]=="add") {
				if ($params[4]=="event") {
					$_GET["submit"] = "Submit Event";
					$newEventID = $this->addEventFromURL($params);
					if ($newEventID) {
						error_log("Show Event ID: " . $newEventID);
						$this->vars["eventID"] = $newEventID; 
						$this->vars["event"] = 	$calendar->getEventByID($newEventID);	
						$this->vars["address"] = urlencode($this->vars["event"]["zAddress"] . " " . $this->vars["event"]["sCity"] . "," . $this->vars["event"]["sState"] . "  " .$this->vars["event"]["zipcode"]);
						$this->vars["bGeocoded"] = $this->vars["event"]["bGeocoded"];
						$this->vars["sLat"] = $this->vars["event"]["sLat"];
						$this->vars["sLon"] = $this->vars["event"]["sLon"];
						$this->view="CAL_LARGE_DETAILS_BODY";		
					}
					else {
						error_log("Event Not Added.");
						foreach ($_GET as $getkey => $getvalue) {
			    			$this->vars[$getkey]=$getvalue;
						}
						$this->view="CAL_LARGE_ADDEVENT_BODY";										
	
					}
				}
				else {
					$this->view="CAL_LARGE_ADDEVENT_BODY";										
				}
			}
	
			else {
				$events = $calendar->getAllEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID);
				$this->vars["events"]=$events; 
				$this->view="CAL_LARGE_BODY";					
			}
			
			return true;
		}		  
		  
	}

	public function search2($params) {

		$calendar = new \CAL\calendar($this->db);

		$events = $calendar->getSponsoredEventsByDateRange(1, "2013-09-30", "2013-10-04");

		$this->vars["events"]=$events; 		

		$this->view="CAL_SEARCH_NEW";
		
		return true;		  
		  
	}

	public function manage($params) {

	  if ($this->auth->validate($this->userID)) {
		
		$this->view="CAL_MANAGE";
		$this->vars["navManageActive"]=true;

		$calendar = new \CAL\calendar($this->db);

		if ($params[2]) {
			$this->calendar->setCalendarByUserID($this->userID, $this->calendar->getCalendarByShortName($params[2]));
		}

		$this->vars["calendars"] = $this->calendar->getCalendarsByUserID($_SESSION["userID"]);
		$this->vars["currentCalendar"] = $this->calendar->getCurrentCalendarNameByUserID($this->userID);
		$calendarID = $this->calendar->getCurrentCalendarByUserID($this->userID);

		$events = $calendar->getAllEventsByCalendarID($calendarID, date('Y-m-d',strtotime('now')));

		$this->vars["events"]=$events; 
		
		return true;
	  }
	  
	  else {

		$this->view="CAL_LOGIN";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }

	}

	
	public function feeds($params) {

	  if ($this->auth->validate($this->userID)) {
		
		$this->view="CAL_FEEDS";
		$this->vars["navFeedsActive"]=true;
		$this->vars["navFeedsEnabled"]=true;

		$calendar = new \CAL\calendar($this->db);

		if (($params[2] != "") or ($params[2] != "login")) {
			if (!$this->calendar->setCalendarByUserID($this->userID, $this->calendar->getCalendarByShortName($params[2]))) {
				$this->calendar->setCalendarByUserID($this->userID, $this->calendar->getDefaultCalendarByUserID($this->userID));
			}
		}

		if (($params[3] != "")) {
			if (!$this->calendar->setFeedByUserID($this->userID, $this->calendar->getCalendarByShortName($params[2]), $params[3])) {
				$this->calendar->setFeedByUserID($this->userID, $this->calendar->getCalendarByShortName($params[2]), $this->calendar->getCurrentFeedByUserID($this->userID));
			}
		}

		$calendarID = $this->calendar->getCurrentCalendarByUserID($this->userID);
		$feedID = $this->calendar->getCurrentFeedByUserID($this->userID, $calendarID);
		$this->vars["feeds"] = $this->calendar->getFeedsByCalendarIDAndUserID($_SESSION["userID"], $calendarID);
		$this->vars["calendars"] = $this->calendar->getCalendarsByUserID($_SESSION["userID"]);
		$this->vars["currentCalendar"] = $this->calendar->getCurrentCalendarNameByUserID($this->userID);
		$this->vars["currentFeed"] = $this->calendar->getCurrentFeedNameByUserID($this->userID, $calendarID);


		$events = $calendar->getEventsByFeedID($calendarID, $feedID);

		$this->vars["events"]=$events; 
		
		return true;
	  }
	  
	  else {

		$this->view="CAL_LOGIN";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }

	}
	
	public function inbox($params) {

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

	public function support($params) {

	  if ($this->auth->validate($this->userID)) {
		
		$this->view="CAL_SUPPORT";
		$this->vars["navSupportActive"]=true;
		
		return true;
	  }
	  
	  else {

		$this->view="CAL_LOGIN";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }

	}

	public function user($params) {

	  if ($this->auth->validate($this->userID)) {
		
		$this->view="CAL_USER";
		
		return true;
	  }
	  
	  else {

		$this->view="CAL_LOGIN";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
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

	public function share($params) {

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


	public function home($params) {

	  if ($this->auth->validate($this->userID)) {
		
		$this->view="CAL_HOME";
		$this->vars["navHomeActive"]=true;
		$this->vars["navInboxEnabled"]=true;	

		$this->isAdmin = $this->auth->getAccessByUserID($this->userID, "Administrator");

		error_log("HomeIsAdmin: " . $this->isAdmin);


		if ($this->isAdmin[0]["view"]) {
			  $this->vars["navAdminEnabled"]=true;
		}
		else {
			  $this->vars["navAdminEnabled"]=false;			
		}		
		
		if (($params[2] != "") or ($params[2] != "login")) {
			if (!$this->calendar->setCalendarByUserID($this->userID, $this->calendar->getCalendarByShortName($params[2]))) {
				$this->calendar->setCalendarByUserID($this->userID, $this->calendar->getDefaultCalendarByUserID($this->userID));
			}
		}

		$this->vars["calendars"] = $this->calendar->getCalendarsByUserID($_SESSION["userID"]);
		$this->vars["currentCalendar"] = $this->calendar->getCurrentCalendarNameByUserID($this->userID);
		$calendarID = $this->calendar->getCurrentCalendarByUserID($this->userID);
		
		$this->vars["events"] = $this->calendar->getAllEventsByAuthor($calendarID, $_SESSION["userID"]);
		$this->vars["chartLeft"] = $this->calendar->getEventsComingUp($calendarID);
		$this->vars["chartRight"] = $this->calendar->getRecentEvents($calendarID);

		return true;
	  }
	  
	  else {
		  
	    error_log("OneCal Calendar Home: Invalid Session");

		$this->view="CAL_LOGIN";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }
	}


	public function login($params) {

	  if ($this->auth->validate($this->userID)) {
		
		$this->view="CAL_HOME";
		$this->vars["navHomeActive"]=true;
		
		error_log("Logging Calendar Validated User In... " . $_POST["username"]);
		
		$this->isAdmin = $this->auth->getAccessByUserID($this->auth->getUserID(), "Administrator");

		if ($this->isAdmin[0]["view"]) {
			  $this->vars["navAdminEnabled"]=true;
		}
		else {
			  $this->vars["navAdminEnabled"]=false;			
		}		

/*
		$this->calendar->setCalendarByUserID($this->userID, $this->calendar->getDefaultCalendarByUserID($this->userID));

		$this->vars["calendars"] = $this->calendar->getCalendarsByUserID($_SESSION["userID"]);
		$this->vars["currentCalendar"] = $this->calendar->getCurrentCalendarNameByUserID($this->userID);
		
*/
		return $this->home($params);
	  }
	  
	  else {
	  
	  	error_log("Logging Calendar User In... " . $_POST["username"]);

		if (($_POST["username"] != "") and ($_POST["password"] != "")) {
			if ($this->auth->login($_POST["username"], $_POST["password"])) {

				$this->view="CAL_HOME";
				$this->vars["navHomeActive"]=true;
				
				$this->isAdmin = $this->auth->getAccessByUserID($this->userID, "Administrator");

				if ($this->isAdmin[0]["view"]) {
					  $this->vars["navAdminEnabled"]=true;
				}
				else {
					  $this->vars["navAdminEnabled"]=false;			
				}	
				
				return $this->home($params);
			}
			else {
				$this->view="CAL_LOGIN";
				$this->vars["alertError"]=true;
				return true;
			}
		}
		$this->view="CAL_LOGIN";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }
	}	

	public function verify($params) {
		
		  $privatekey = "6LeEtusSAAAAAKqDZmCMQ0-aVWL_F2SqA4jo-xGD";
		  $resp = recaptcha_check_answer ($privatekey,
		                                  $_SERVER["REMOTE_ADDR"],
		                                  $_POST["recaptcha_challenge_field"],
		                                  $_POST["recaptcha_response_field"]);
		
		  if (!$resp->is_valid) {
		  	  $this->vars["response"] = $resp;
			  $this->view="CAL_CAPTCHA_ERRROR";

		  } else {
		  	  $this->vars["response"] = $resp;
	  		  $this->view="CAL_CAPTCHA_SUCCESS";

		  }
		  
		  return true;
		  
	}


	public function logout($params) {

		$this->auth->logout();
			
		$this->view="CAL_LOGIN";
		$this->vars["navHomeActive"]=false;
		$this->vars["navAdminEnabled"]=false;
		
		return true;		  
		  
	}	
	
	public function zebra($params) {

//		$this->vars["customCSS"] = "buzz.css";
		$this->view="CAL_JS_WIDGET_ZEBRA";

		return true;	
		

	}
	
	public function lookup($params) {
	  if ($this->auth->validate($this->userID)) {
//	    $this->vars["username"] = "@" . $this->auth->getShortName($this->userID);

	    $access["payments"] = $this->auth->getAccessByUserID($_SESSION["userID"],"Payments");
		$access["player"] = $this->auth->getAccessByUserID($_SESSION["userID"],"Player");	
		$access["confcode"] = $this->auth->getAccessByUserID($_SESSION["userID"],"Conf Code");	
						
		if ($access["payments"][0]["create"]) {
			$this->vars["acceptPayments"]=true;
		}

		if ($access["confcode"][0]["view"]) {
			$this->vars["confCode"]=true;
		}
		else {
			$this->vars["confCode"]=false;			
		}
		
		if ($access["player"][0]["delete"]) {
			$this->vars["deletePlayer"]=true;
		}
		else {
			$this->vars["deletePlayer"]=false;
		}
		if ($this->registration->isPlayerActive($params[1])) {
			$this->vars["playerIsActive"]=true;
		}
		else {
			$this->vars["playerIsActive"]=false;			
		}

		$player = $this->registration->getPlayer($params[1]);
		$payments = $this->registration->getPaymentHistory($params[1]);
		$invoices = $this->registration->getInvoicesByPlayer($params[1]);
		$parents = $this->registration->getParents();
		$sport = $this->registration->getSport($player["id"]);
		$sports =  $this->registration->getSports();
		$divisions =  $this->registration->getDivisions($sport["sportID"],$player["childID"]);
		$team = $this->registration->getTeam($player["teamID"]);
		
		
		
		$this->vars["parents"] = array();
		foreach ($parents as $parent) {
			array_push($this->vars["parents"], $this->registration->getParent($parent));
			

		}
		
//		error_log("Player: " . print_r($player));
		
		$this->vars["player"] = $player;
		$this->vars["payments"] = $payments;
		$this->vars["invoices"] = $invoices;
		$this->vars["sport"] = $sport;
		$this->vars["team"] = $team;
		$this->vars["sports"] = $sports;
		$this->vars["divisions"] = $divisions;
		$this->vars["userID"] = $_SESSION["userID"];
	
		$this->vars["playersActive"] = "class=active";
		
		$this->view = "player";
				
		$this->vars["editPlayer"] = $access["player"][0];
		
		return true;
	  }
	  else {
		  return false;
	  }
	}


	public function pay($params) {
	  if ($this->auth->validate($this->userID)) {

		  $access["payments"] = $this->auth->getAccessByUserID($_SESSION["userID"],"Payments");
		
			  if (($this->auth->validate($this->userID)) and ($access["payments"][0]["create"])) {

				  if ($_POST["action"]=="Save") {
				  		$this->registration->paymentByPlayer($_POST["source"], $_POST["invoice"], $_POST["refnum"], $_POST["amount"], 0, $this->userID);
				  		
				  		$this->view = "";
				  		$this->transfer = "/portal/player/lookup/" . $params[1];
				  		return true;
					  
				  }

				  else if ($_POST["action"]=="Cancel") {
				  		
				  		$this->view = "";
				  		$this->transfer = "/portal/player/lookup/" . $params[1];
				  		return true;
					  
				  }
				  
				  else {
				  
			
				    $this->vars["username"] = "@" . $this->auth->getShortName($this->userID);
							
					$player = $this->registration->getPlayer($params[1]);
					$payments = $this->registration->getPaymentHistory($params[1]);
					$invoices = $this->registration->getInvoicesByPlayer($params[1]);
					$openInvoices = $this->registration->getOpenInvoicesByPlayer($params[1]);
					$parents = $this->registration->getParents();
					$sport = $this->registration->getSport($player["id"]);
					$sports =  $this->registration->getSports();
					$divisions =  $this->registration->getDivisions($sport["sportID"],$player["childID"]);
					$team = $this->registration->getTeam($player["teamID"]);
							
					$invoiceNames = array();
					$invoiceIDs = array();
					


					foreach ($openInvoices as $invoice) {
						array_push($invoiceNames, $invoice["id"] . " - " . $invoice["title"] . " (" . $invoice["balance"] .")");
						array_push($invoiceIDs, $invoice["id"]);
					}
						
					if (count($invoiceIDs)<1) {
						$this->vars["acceptPaymentError"] = "There are no open invoices to pay at this time.";
					}

					$this->vars["parents"] = array();
					foreach ($parents as $parent) {
						array_push($this->vars["parents"], $this->registration->getParent($parent));
			
					}
					
			//		error_log("Player: " . print_r($player));
					
					$this->vars["player"] = $player;
					$this->vars["payments"] = $payments;
					$this->vars["invoices"] = $invoices;
					$this->vars["invoiceIDs"] = $invoiceIDs;
					$this->vars["invoiceNames"] = $invoiceNames;
					$this->vars["sport"] = $sport;
					$this->vars["team"] = $team;
					$this->vars["sports"] = $sports;
					$this->vars["divisions"] = $divisions;
					$this->vars["userID"] = $_SESSION["userID"];
				
					$this->vars["playersActive"] = "class=active";
					
					$this->view = "player-payment";
					
					$access["player"] = $this->auth->getAccessByUserID($_SESSION["userID"],"Player");
					
//					$this->vars["editPlayer"] = $access["editPlayer"][0];
					$this->vars["editPlayer"] = false;
					
					return true;
				}
			}
	  }
	  else {
		  return false;
	  }
	}
	
	public function forgot($params) {

	  if ($this->auth->validate($this->userID)) {

		return $this->home($params);
		  
	  }
	  
	  else {
	  
			if ($_POST["username"] != "") {
				$this->view="CAL_FORGOT";
				$this->vars["alertError"]=true;
				$this->vars["alertMsg"]="Password has been reset, please check your email.";
				$random = new \random(6,6);
				$randomStr = $random->token(6);
				$users = new \users($this->db);
				if ($users->resetPasswordByEmailAddress($_POST["username"],$randomStr)) {
										$email = new \FLX\mail($this->db);
								  		$email->from("toddr@cfmedia.net");
								  		$email->to($_POST["username"]);
								  		$email->bcc("wbenwick@filelogix.net");
								  		$email->subject("Password reset for BUZZ Calendar Platform");
								  		//$email->text("This message was generated by FileLogix");
								  		//$email->html("<html><head></head><body>This message was generated by FileLogix</body></html>");
								  		
								  		$data = array();
								  		$data["resetCode"] = $randomStr;
								  		$data["username"] = $_POST["username"];
								  		$data["id"] = md5($randomStr);
								  		
								  		$email->htmlByTemplate("MAIL_FORGOT", array("email" => $data));
								  		//$email->addFileByURL("http://bsf.filelogix.net/test.pdf","test.pdf");
								  		$email->send();				
				}
				return true;
			}

//	    require_once('/var/www/html/lib/recaptchalib.php');
	    $publickey = "6Lc6tecSAAAAALevgROIwALgd4yT01iTrEDfqEuy"; 
	    $this->vars["captcha"] = recaptcha_get_html($publickey);

		$this->view="CAL_FORGOT";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }
	}	

	public function reset($params) {

	  if ($this->auth->validate($this->userID)) {

		return $this->home($params);
		  
	  }
	  
	  else {

	  	$users = new \users($this->db);

		$this->vars["emailAddress"] = $_POST["emailAddress"];
		
		if ($params[2]) {
			$this->vars["resetCode"] = $params[2];
		}
		else {
			$this->vars["resetCode"] = $_POST["resetCode"];
		}
				
		if ($_POST["emailAddress"] != "") {
			$this->auth->logout();
			
			if ($_POST["password"] == $_POST["confirm"]) {
			
				$username = $users->resetWithActivationCode($_POST["emailAddress"], $_POST["password"], $_POST["resetCode"]);
				if ($username) {
	
					$_POST["username"] = $username;
	
					error_log("User Reset.  Logging In Automatically...");
	
					return $this->login($params);
		
					return true;
				}
				else {
					$this->view="CAL_RESET";
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="An error occurred. Please Try Again.";
					if (($_POST["emailAddress"] != "") and (strlen($_POST["password"]) < 6)) {
						$this->vars["errorMsg"]="Your password is too short.";				
					}
					
					return true;
				}
			}
			else {
					$this->view="CAL_RESET";
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="The passwords do not match.";
			}
		}

		$this->view="CAL_RESET";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
		  
	  }
	}
	
	public function change($params) {

	  if ($this->auth->validate($this->userID)) {

		return $this->home($params);
		  
	  }
	  
	  else {
	  
/*	  	error_log("Logging Calendar User In... " . $_POST["username"]);

		if (($_POST["username"] != "") and ($_POST["password"] != "")) {
			if ($this->auth->login($_POST["username"], $_POST["password"])) {

				return $this->home($params);

			}
			else {
				$this->view="CAL_LOGIN";
				$this->vars["alertError"]=true;
				return true;
			}
		}
*/

//	    require_once('/var/www/html/lib/recaptchalib.php');
	    $publickey = "6Lc6tecSAAAAALevgROIwALgd4yT01iTrEDfqEuy"; 
	    $this->vars["captcha"] = recaptcha_get_html($publickey);

		$this->view="CAL_CHANGE";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }
	}

	public function password($params) {

	  if ($this->auth->validate($this->userID)) {

		return $this->home($params);
		  
	  }
	  
	  else {
	  
/*	  	error_log("Logging Calendar User In... " . $_POST["username"]);

		if (($_POST["username"] != "") and ($_POST["password"] != "")) {
			if ($this->auth->login($_POST["username"], $_POST["password"])) {

				return $this->home($params);

			}
			else {
				$this->view="CAL_LOGIN";
				$this->vars["alertError"]=true;
				return true;
			}
		}
*/

//	    require_once('/var/www/html/lib/recaptchalib.php');
	    $publickey = "6Lc6tecSAAAAALevgROIwALgd4yT01iTrEDfqEuy"; 
	    $this->vars["captcha"] = recaptcha_get_html($publickey);

		$this->view="CAL_CHANGE";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }
	}
	
	public function signup($params) {

	  if ($this->auth->validate($this->userID)) {

		return $this->home($params);
		  
	  }
	  
	  else {
	  

	  	error_log("Signing up new user... " . $_POST["username"]);

	  	$users = new \users($this->db);
	  	
	  	$this->vars["emailAddress"] = $_POST["emailAddress"];
	  	$this->vars["firstName"] = $_POST["firstName"];
	  	$this->vars["lastName"] = $_POST["lastName"];
	  	$this->vars["organization"] = $_POST["organization"];
	  	$this->vars["phoneNumber"] = $_POST["phoneNumber"];

		if (($_POST["emailAddress"] != "") and ($_POST["firstName"] != "") and ($_POST["lastName"] != "")) {

			$this->auth->logout();

			if ($users->emailExists($_POST["emailAddress"])) {
				
				$this->view="CAL_SIGNUP";
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="That email address has already been used.";
				$this->vars["signUpHide"]="";
			}
			else {
				if ($_POST["organization"] == "") {
					$this->view="CAL_SIGNUP";
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="Please let us know which organization you represent.";
					$this->vars["signUpHide"]="";					
				}
				else if ($_POST["phoneNumber"] == "") {
					$this->view="CAL_SIGNUP";
					$this->vars["alertError"]=true;
					$this->vars["errorMsg"]="Please share a phone number we can use to contact you.";
					$this->vars["signUpHide"]="";										
				}
				else {
					$users->signup($_POST["emailAddress"], $_POST["firstName"], $_POST["lastName"], $_POST["organization"], $_POST["phoneNumber"]);
					$this->view="CAL_SIGNUP";
					$this->vars["alertSuccess"]=true;
					$this->vars["successMsg"]="Thank You! Your request is being reviewed.";
					$this->vars["signUpHide"]="hide";
				}
				return true;
			}
		}
		
		else {
			if ($_POST["submit"]) {
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="Please answer all of the fields.";
			}							
		}

		$this->view="CAL_SIGNUP";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }
	}	

	public function activate($params) {

	  if ($this->auth->validate($this->userID)) {

		return $this->home($params);
		  
	  }
	  
	  else {
	  
	  	error_log("Activating new user... " . $_POST["emailAddress"]);

	  	$users = new \users($this->db);

		$this->vars["emailAddress"] = $_POST["emailAddress"];
		
		if ($params[2]) {
			$this->vars["activationCode"] = $params[2];
		}
		else {
			$this->vars["activationCode"] = $_POST["activationCode"];
		}
				
		if ($_POST["emailAddress"] != "") {
			$this->auth->logout();
			
			$username = $users->activateWithActivationCode($_POST["emailAddress"], $_POST["password"], $_POST["activationCode"]);
			if ($username) {

				$_POST["username"] = $username;

				error_log("User Activated.  Logging In Automatically...");

				return $this->login($params);
	
				return true;
			}
			else {
				$this->view="CAL_ACTIVATE";
				$this->vars["alertError"]=true;
				$this->vars["errorMsg"]="An error occurred. Please Try Again.";
				if (($_POST["emailAddress"] != "") and (strlen($_POST["password"]) < 6)) {
					$this->vars["errorMsg"]="Your password is too short.";				
				}
				
				return true;
			}
		}

		$this->view="CAL_ACTIVATE";
		$this->vars["navHomeActive"]=false;
		
		return true;		  
		  
	  }
	}		

	public function data() {
		
		return $this->vars;
	}

	public function submit($params) {

		$calendar = new \CAL\calendar($this->db);

	  	$this->vars["canSubmit"] = TRUE;
	  	$this->vars["canCopy"] = FALSE;
	  	$this->vars["copyDisabled"] = TRUE;

		if (($_POST["submit"] == "Create") or ($_POST["submit"] == "Submit") or ($_POST["submit"] == "Submit Event")) {
			
			$this->submitEvent($params,$calendar);
		}
		
    	$this->vars["categories"]=$this->calendar->getCategoriesNotAll();
		$this->vars["locations"]=$calendar->getGeocodedLocations();
		$this->vars["formAction"]="/calendar/submit/new";
		
		$this->view="CAL_SUBMIT_EVENT_WRAPPER";
		
		return true;		
	}

	public function feed($params) {

		if ($params[3]=="event") {
			
			$eventID = $params[4];
			$calendar = new \CAL\calendar($this->db);

			
			if ($eventID == "all") {
				$events = $calendar->getAllEventsByFeedID($params[2]);
				$responses = array();	
					
				foreach ($events as $event) {
					
					$response = array();
					$response["id"] = $event["id"];
					$response["parentID"] = $event["kEventID"];
					$response["calendarID"] = $event["kCalendarID"];
					$response["isRepeating"] = $event["eRepeat"];
					$response["title"] = $event["sTitle"];
					$response["description"] = $event["sDescription"];
					$response["details"] = $event["sDetails"];
					$response["start"] = $event["tStart"];
					$response["end"] = $event["tEnd"];
					$response["categoryID"] = $event["kCategoryID"];
					$response["category"] = $event["categoryName"];
					$response["locationID"] = $event["kLocationID"];
					$response["location"] = $event["locationName"];
					$response["isGeocoded"] = $event["bGeocoded"];
					$response["latitude"] = $event["sLat"];
					$response["longitude"] = $event["sLon"];
					$response["longitude"] = $event["sLon"];
					$response["duration"] = $event["fDuration"];
					$response["isAllDay"] = $event["bAllDay"];
					$response["isSponsored"] = $event["bSponsored"];
					$response["isFree"] = $event["bFree"];
					$response["isTicketed"] = $event["bTicketed"];
					$response["cost"] = $event["fCost"];
					$response["ticketURL"] = $event["sTicketURL"];
					$response["areaID"] = $event["kAreaID"];
					$response["area"] = $event["areaNamen"];
					$response["organizerID"] = $event["kOrganizerID"];
					$response["organizer"] = $event["sContactName"];
					$response["phoneNumber"] = $event["sContactPhone"];
					$response["emailAddress"] = $event["sContactEmail"];
					$response["URL"] = $event["sURL"];
					$response["foursquareURL"] = $event["uFoursquare"];
					$response["facebookURL"] = $event["uFacebook"];
					$response["rating"] = $event["iRating"];
					$response["isShared"] = $event["bShared"];
					$response["isModified"] = $event["bModified"];
					$response["isDeleted"] = $event["bDeleted"];
					$response["isConfirmed"] = $event["bConfirmed"];
					$response["keywords"] = $event["zKeywords"];
					$response["source"] = $event["sRef"];
					$response["address"] = $event["zAddress"];
					$response["city"] = $event["sCity"];
					$response["state"] = $event["sState"];
					$response["postalCode"] = $event["sZipcode"];
					
					array_push($responses, $response);
				}

				$this->vars["response"] = json_encode($responses);
				$this->view="CAL_AJAX_RESPONSE";
				
//				$this->vars["events"]=$events; 				
//				$this->view="CAL_EVENTS_JSON";
			}
			
			else {
				$event = $calendar->getEventByID($eventID);

				$response["id"] = $event["id"];
				$response["parentID"] = $event["kEventID"];
				$response["calendarID"] = $event["kCalendarID"];
				$response["isRepeating"] = $event["eRepeat"];
				$response["title"] = $event["sTitle"];
				$response["description"] = $event["sDescription"];
				$response["details"] = $event["sDetails"];
				$response["start"] = $event["tStart"];
				$response["end"] = $event["tEnd"];
				$response["categoryID"] = $event["kCategoryID"];
				$response["category"] = $event["categoryName"];
				$response["locationID"] = $event["kLocationID"];
				$response["location"] = $event["locationName"];
				$response["isGeocoded"] = $event["bGeocoded"];
				$response["latitude"] = $event["sLat"];
				$response["longitude"] = $event["sLon"];
				$response["longitude"] = $event["sLon"];
				$response["duration"] = $event["fDuration"];
				$response["isAllDay"] = $event["bAllDay"];
				$response["isSponsored"] = $event["bSponsored"];
				$response["isFree"] = $event["bFree"];
				$response["isTicketed"] = $event["bTicketed"];
				$response["cost"] = $event["fCost"];
				$response["ticketURL"] = $event["sTicketURL"];
				$response["areaID"] = $event["kAreaID"];
				$response["area"] = $event["areaNamen"];
				$response["organizerID"] = $event["kOrganizerID"];
				$response["organizer"] = $event["sContactName"];
				$response["phoneNumber"] = $event["sContactPhone"];
				$response["emailAddress"] = $event["sContactEmail"];
				$response["URL"] = $event["sURL"];
				$response["foursquareURL"] = $event["uFoursquare"];
				$response["facebookURL"] = $event["uFacebook"];
				$response["rating"] = $event["iRating"];
				$response["isShared"] = $event["bShared"];
				$response["isModified"] = $event["bModified"];
				$response["isDeleted"] = $event["bDeleted"];
				$response["isConfirmed"] = $event["bConfirmed"];
				$response["keywords"] = $event["zKeywords"];
				$response["source"] = $event["sRef"];
				$response["address"] = $event["zAddress"];
				$response["city"] = $event["sCity"];
				$response["state"] = $event["sState"];
				$response["postalCode"] = $event["sZipcode"];
				
				$this->vars["response"] = json_encode($response);
				$this->view="CAL_AJAX_RESPONSE";
				
//				$this->vars["event"]=$event; 				
//				$this->view="CAL_EVENT_JSON";
			}
		
			return $this->vars;			
		}

		else if ($params[3]=="categories") {
			
			$feedID = $params[4];
			
			$calendar = new \CAL\calendar($this->db);
			$categories = $calendar->getCategoriesNotAll();
			$this->vars["categories"]=$categories; 
	
			$this->view="CAL_CATEGORIES_JSON";
		
			return $this->vars;			
		}

		else if ($params[3]=="areas") {
			
			$feedID = $params[4];
			
			$calendar = new \CAL\calendar($this->db);
			$areas = $calendar->getAllAreas(1);
			$this->vars["areas"]=$areas; 
	
			$this->view="CAL_AREAS_JSON";
		
			return $this->vars;			
		}

		else if ($params[3]=="locations") {
			
			$feedID = $params[4];
			
			$calendar = new \CAL\calendar($this->db);
			$locations = $calendar->getGeocodedLocations(1);
			$this->vars["locations"]=$locations; 
	
			$this->view="CAL_LOCATIONS_JSON";
		
			return $this->vars;			
		}
				
		else {

				if($_GET["start"]) {
					if (is_numeric(urldecode($_GET["start"]))) {
						$fromDate = date("Y-m-d", urldecode($_GET["start"]));		
					}
					else {
						$fromDate = date("Y-m-d", strtotime(urldecode($_GET["start"])));						
					}
				}
				else {
					$fromDate = date("Y-m-d", strtotime("yesterday"));
				}
				
				if($_GET["end"]) {
					if (is_numeric(urldecode($_GET["end"]))) {
						$toDate = date("Y-m-d", urldecode($_GET["end"]));		
					}
					else {				
						$toDate = date("Y-m-d", strtotime(urldecode($_GET["end"])));		
					}
				}
				else {
					$toDate = date("Y-m-d", strtotime("+52 weeks"));	
				}	
				
				if ($_GET["category"]) {
					$categoryID=urldecode($_GET["category"]);
					if ($categoryID==99) {
						$categoryID="";
					}
				}	
				else {
					$categoryID="";
				}
				
				if ($_GET["area"]) {
					$areaID=urldecode($_GET["area"]);
		
				}	
				else {
					$areaID="";
				}
						
				if ($_GET["keywords"]) {
					$keywords=urldecode($_GET["keywords"]);
				}	
				else {
					$keywords="";
				}
		
				$calendar = new \CAL\calendar($this->db);
		
//				$events = $calendar->getRatedEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID,-1);

				$feedKey = $params[2];

				$feedID = $calendar->getFeedIDByFeedKey($feedKey);

				$events = $calendar->getFeedEventsByDateRange($feedID, $fromDate, $toDate, $categoryID, $keywords, $areaID,-1);
				$this->vars["events"]=$events; 
		
				$this->view="CAL_FEED_JSON";
			
				return $this->vars;
		}
	}

	public function api($params) {

		if($params[2]=="search") {
			
			$fromDate = $params[4];
			$toDate = $params[6];
			$keywords = $params[8];
			$categoryID = '';
			$areaID = '';
		
			$calendar = new \CAL\calendar($this->db);

			$events = $calendar->getRatedEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID,-1);
			$this->vars["events"]=$events; 
			
			$this->view="CAL_FEED_JSON";
	
			return $this->vars;			
		}
		else {		
			$calendar = new \CAL\calendar($this->db);

			$events = $calendar->getRatedEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID,-1);
			$this->vars["events"]=$events; 
			
			$this->view="CAL_FEED_JSON";
	
			return $this->vars;
		}
	}

	public function full() {

		if($_GET["start"]) {
			if (is_numeric(urldecode($_GET["start"]))) {
				$fromDate = date("Y-m-d", urldecode($_GET["start"]));		
			}
			else {
				$fromDate = date("Y-m-d", strtotime(urldecode($_GET["start"])));						
			}
		}
		else {
			$fromDate = date("Y-m-d", strtotime("now"));
		}
		
		if($_GET["end"]) {
			if (is_numeric(urldecode($_GET["end"]))) {
				$toDate = date("Y-m-d", urldecode($_GET["end"]));		
			}
			else {				
				$toDate = date("Y-m-d", strtotime(urldecode($_GET["end"])));		
			}
		}
		else {
			$toDate = date("Y-m-d", strtotime("+6 weeks"));	
		}	
		
		if ($_GET["category"]) {
			$categoryID=urldecode($_GET["category"]);
			if ($categoryID==99) {
				$categoryID="";
			}
		}	
		else {
			$categoryID="";
		}
		
		if ($_GET["area"]) {
			$areaID=urldecode($_GET["area"]);

		}	
		else {
			$areaID="";
		}
				
		if ($_GET["keywords"]) {
			$keywords=urldecode($_GET["keywords"]);
		}	
		else {
			$keywords="";
		}
		
		$calendar = new \CAL\calendar($this->db);

		$events = $calendar->getRatedEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID,10);
		$this->vars["events"]=$events; 

		$this->view="CAL_FULL_CALENDAR";
	
		return $this->vars;
	}

	public function view() {
		
		return $this->view;
	}
	
	public function transfer() {
		
		return $this->transfer;
	}
	
	public function ajax($params) {
		
	  	  $this->view="CAL_AJAX_RESPONSE";
		  $this->vars["response"] = $params[3]; 

		  if ($this->auth->validate($this->userID)) {
		  	
		  	if ($params[2]=="event") {	

			  if ($params[3]=="confirm") {	
			  	 $eventID = intval($params[4]);	
			  	
			  	 if ($eventID>0) {		
				  	$calendar = new \CAL\calendar($this->db);	
				  	
				  	$isConfirmed = $calendar->confirmEvent($eventID);
				  	
				  	$this->vars["response"] = $isConfirmed; 
			
				  	return true;
				 }
			  }

			  else if ($params[3]=="delete") {	
			  	 $eventID = intval($params[4]);	
			  	
			  	 if ($eventID>0) {		
				  	$calendar = new \CAL\calendar($this->db);	
				  	
				  	$isDeleted = $calendar->deleteEvent($eventID);
				  	
				  	$this->vars["response"] = $isDeleted; 
			
				  	return true;
				 }
			  }


			}

		  	else if ($params[2]=="feeds") {	

				$this->view="CAL_FEEDS_JSON";
		
				$calendar = new \CAL\calendar($this->db);
		
				$feedID = 1;
				$calendarID = 2;
		
				$events = $calendar->getEventsByFeedID($calendarID, $feedID);
		
				$this->vars["events"]=$events; 
				
				return true;
			}

		  	else if ($params[2]=="feed") {	
			  
			  if ($params[3]=="check") {	
			  	 $eventID = intval($params[4]);	
			  	
			  	 if ($eventID>0) {		
				  	$calendar = new \CAL\calendar($this->db);	
				  	
				  	$isConfirmed = $calendar->checkEventFromFeed($feedKey, $eventID);
				  	
				  	$this->vars["response"] = $isConfirmed; 
			
				  	return true;
				 }
			  }
			  else if ($params[3]=="uncheck") {	
			  	 $eventID = intval($params[4]);	
			  	
			  	 if ($eventID>0) {		
				  	$calendar = new \CAL\calendar($this->db);	
				  	
				  	$isConfirmed = $calendar->uncheckEventFromFeed($feedKey, $eventID);
				  	
				  	$this->vars["response"] = $isConfirmed; 
			
				  	return true;
				 }
			  }
			  
			  else if ($params[3]=="delete") {	
			  			  
			  	 $eventID = intval($params[4]);	
			  	
			  	 if ($eventID>0) {		
				  	$calendar = new \CAL\calendar($this->db);	
				  	
				  	$isDeleted = $calendar->deleteEventFromFeed($feedKey, $eventID);
				  	
				  	$this->vars["response"] = $isDeleted; 
			
				  	return true;
				 }
			  }

			  else if ($params[3]=="clear") {	
			  			  
			  	 $calendarID = intval($params[4]);	
			  	
			  	 if ($calendarID>0) {		
				  	$calendar = new \CAL\calendar($this->db);	
				  	
				  	$isCleared = $calendar->clearNewEventsFromFeedByCalendarID($calendarID);
				  	
				  	$this->vars["response"] = $isCleared; 
			
				  	return true;
				 }
			  }

			}
			
			else if ($params[2]=="admin") {
				if ($this->isAdmin[0]["view"]) {
					if ($params[3]=="user") {
						if ($params[4]=="activate") {
							$users = new \users($this->db);
							if (intval($params[5]>0)) {		
								$random = new \random(6,6);
								$randomStr = $random->token(6);
								$result = $users->activateByUserID($params[5],$randomStr);	
								if (strlen($result)>1) {
									error_log("ActivateUserResult: " . $result);
									$this->vars["response"] = true;
									$md5Str = md5($result . $randomStr . time());
									
								  		$email = new \FLX\mail($this->db);
								  		$email->from("mike@cfmedia.net");
								  		$email->to($result);
								  		$email->bcc("wbenwick@filelogix.net");
								  		$email->subject("Welcome to The OneCal.co Calendar Platform");
								  		//$email->text("This message was generated by FileLogix");
								  		//$email->html("<html><head></head><body>This message was generated by FileLogix</body></html>");
								  		
								  		$data = array();
								  		$data["activationCode"] = $randomStr;
								  		$data["username"] = $result;
								  		$data["id"] = $md5Str;
								  		
								  		$email->htmlByTemplate("MAIL_INTRO", array("email" => $data));
								  		//$email->addFileByURL("http://bsf.filelogix.net/test.pdf","test.pdf");
								  		$email->send();									
									 
									return true;
								}
								else {
									$this->vars["response"] = false; 
									return true;
								}
							}
							else {
								return false;
							}
						}
						else if ($params[4]=="delete") {
							
						}
						else { // show user
							
						}
					}
				}
				else {
					return false;
				}
			}
		  }
		  
		  else {
			
		  	if ($params[2]=="feeds") {	

				$this->view="CAL_FEEDS_JSON";
		
				$calendar = new \CAL\calendar($this->db);
		
				$feedID = 1;
				$calendarID = 2;
		
				$events = $calendar->getEventsByFeedID($calendarID, $feedID);
		
				$this->vars["events"]=$events; 
				
				return true;
			}
			
			return true;		  
			  
		  }
	
		  return true;		
	}

}
?>
