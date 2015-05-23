<?php
/**
 * FILELOGIX CALENDAR EVENT CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
 
namespace CAL;
  
class event
{  
    // Will store database connection here
	private $db;
	private $sessionID;

	
	public function __construct($db) {
	  $this->db = $db;
	  $this->sessionID = session_id();
		
	}
	
	public function openByID($id) {
	
	}
	
	// Create a new location in the CAL_LOCATIONS table, return the location ID
	
	public function create($params = array()) {
	
	}
	
	// Create a new record in the CAL_LOCATION table that is a many-to-one relationshiop with the CAL_LOCATIONS table
	
	public function add($id, $params = array() ) {
		
		
	}
	
	public function delete($id) {
		
	}
	
	public function update($id, $params = array()) {
		
	}
	
/**
 * 
 * @param int $calendarID
 * @param string $title
 * @param int $categoryID
 * @param unknown $isRecurring
 * @param array $eventParams
 * @param array $repeatParams
 * @return int
 */
	public function addEvent($calendarID, $title, $categoryID, $isRecurring, $eventParams, $repeatParams) {
	
	    $params = array();
	
	    $userID = $_SESSION["userID"];
	
	    error_log("OneCal addEvent Session: " . $userID . " = " . session_id());
	
	    if ($userID>0) {
	        $params["bConfirmed"] = 1;
	        $eventParams["bConfirmed"] = 1;
	    }
	    else {
	        $params["bConfirmed"] = 0;
	        $eventParams["bConfirmed"] = 0;
	    }
	
	    if ($calendarID == 0) {
	        $calendarID = 1;
	    }
	
	    if (!isset($calendarID)) {
	        $calendarID = 1;
	    }
	
	    $eventsID = $this->db->insert("CAL_EVENTS", array("kCalendarID"=>$calendarID, "bRepeat"=>$isRecurring, "sName"=>$title, "sTitle"=>$title, "kAuthorID"=>$userID, "bConfirmed"=>$params["bConfirmed"]));
	
	    error_log("Create Event: " . $this->db->lastQuery());
	
	    if (is_array($categoryID)) {
	
	        foreach ($categoryID as $category) {
	            $params["kCalendarID"] = 1;
	
	            $eventParams["kCategoryID"] = $category;
	            	
	            $eventID = $this->insertEvent($eventsID, $calendarID, $title, $isRecurring, $userID, $eventParams, $repeatParams);
	        }
	    }
	
	    else {
	        $eventParams["kCategoryID"] = $categoryID;
	        	
	        $eventID = $this->insertEvent($eventsID, $calendarID, $title, $isRecurring, $userID, $eventParams, $repeatParams);
	    }
	
	    return $eventsID;
	}
	

	public function getAllEvents() {
	     
	    $r=$this->db->query("select * from CAL_EVENT where bActive is TRUE");
	    $results=$r->fetchAll();
	
	    error_log($this->db->lastQuery());
	
	    return $results;
	
	
	}
	
	public function getAllEventsByAuthor($calendar, $authorID) {
	
	    $r=$this->db->query("select *, DATE_FORMAT(tStart,'%b %d %Y %h:%i %p') as tStartStr, DATE_FORMAT(tEnd,'%b %d %Y %h:%i %p') as tEndStr,CAL_EVENT.id as eventID, CAL_EVENT.kCategoryID as category, CAL_EVENT.kLocationID as location, left(CAL_EVENT.sTitle,50) as title, CAL_EVENT.tStart as startStr, CAL_EVENT.tEnd as endStr, CAL_LOCATION.sName as locationName, CAL_LOCATION.zAddress as zAddress, CAL_LOCATION.sState as sState, CAL_LOCATION.sCity as sCity, CAL_CATEGORIES.squareImg as squareImg, CAL_CATEGORIES.rectImg as rectImg, CAL_LOCATION.id as locationID, CAL_CATEGORIES.id as categoryID, CAL_CATEGORIES.sName as categoryName from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) left join CAL_LOCATION on (CAL_EVENT.kLocationID=CAL_LOCATION.id) left join CAL_CATEGORIES on (CAL_CATEGORIES.id=CAL_EVENT.kCategoryID) where CAL_EVENT.sStatus='' and CAL_EVENT.sTitle!='' and CAL_EVENTS.kCalendarID = '$calendar' and CAL_EVENT.tStart>now() order by tStart asc limit 200");
	    $results=$r->fetchAll();
	
	    error_log($this->db->lastQuery());
	
	    return $results;
	
	}
	
	public function getSponsoredEventsByDateRange($calendar, $fromDate, $toDate) {
	
	    $r=$this->db->query("select CAL_EVENT.id as eventID, CAL_EVENT.kCategoryID as categoryID,'All Categories' as category, CAL_EVENT.kLocationID as location, left(CAL_EVENT.sTitle,20) as title, CAL_EVENT.sDescription as description, CAL_EVENT.sURL as website, CAL_EVENT.sContactEmail as emailAddress, date(tStart) as date, '904-555-1212' as phone, CAL_EVENT.tStart as startStr, CAL_EVENT.tEnd as endStr from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) where CAL_EVENT.sStatus='' and CAL_EVENT.sTitle!='' and CAL_EVENT.tStart>='$fromDate' and CAL_EVENT.tEnd<='$toDate' order by date(tStart) asc,CAL_EVENT.bRepeating asc limit 3");
	    $results=$r->fetchAll();
	
	    error_log($this->db->lastQuery());
	
	    return $results;
	
	}
	
	
	public function newEvent($calendarID, $isRecurring, $title, $authorID, $params = array(), $repeat = array()) {
	
	    if ($calendarID == 0) {
	        $calendarID = 1;
	    }
	
	    if (!isset($calendarID)) {
	        $calendarID = 1;
	    }
	
	    $eventsID = $this->db->insert("CAL_EVENTS", array("kCalendarID"=>$calendarID, "bRepeat"=>$isRecurring, "sName"=>$title, "sTitle"=>$title, "kAuthorID"=>$authorID, "zKeywords"=>$params["keywords"], "bConfirmed"=>"1"));
	
	    $daysOfWeek = array('Sun'=>"1", 'Mon'=>"2", 'Tue'=>"3", 'Wed'=>"4", 'Thu'=>"5", 'Fri'=>"6", 'Sat'=>"7");
	
	    $params["kEventID"] = $eventsID;
	    $params["kParentID"] = $eventsID;
	
	    $eventID = $this->db->insert("CAL_EVENT", $params);
	
	    error_log("Create Event: " . $this->db->lastQuery());
	
	    if ($isRecurring) {
	
	        $maxDate = "2019-01-01";
	        $repeatWeekly = "";
	        $repeatWeekDays = "0";
	        $repeatMonthDays = array();
	        $repeatMonthly = "";
	        $repeatAnnually = "";
	        $repeatStart = $repeat["startDate"];
	        $repeatEnd = $repeat["endDate"];
	
	        $days=0;
	        	
	
	        if($repeat["weekDays"]) {
	            if (is_array($repeat["weekDays"])) {
	                foreach ($repeat["weekDays"] as $day) {
	                    if (is_numeric($day)) {
	                        $days += $day;
	                    }
	                    else {
	                        $day += $daysOfWeek[$day];
	                    }
	                }
	            }
	            else {
	                if (is_numeric($repeat["weekDays"])) {
	                    $days += $repeat["weekDays"];
	                }
	                else {
	                    $days = $daysOfWeek[$repeat["weekDays"]];
	                }
	            }
	            $repeatWeekDays = strval($days);
	        }
	        else {
	            $repeatWeekDays = "0";
	        }
	
	        if($repeat["monthDays"]) {
	            if (is_array($repeat["monthDays"])) {
	                foreach ($repeat["monthDays"] as $day) {
	                    if (is_numeric($day)) {
	                        array_push($repeatMonthDays, $day);
	                    }
	                    else {
	                        array_push($repeatMonthDays, $day);
	                    }
	                }
	            }
	            else {
	                array_push($repeatMonthDays, $repeat["monthDays"]);
	            }
	        }
	
	        if(($repeat["frequency"] == "Daily") or ($repeat["frequency"] == "Every Day")) {
	            $repeatWeekly="1";
	        }
	        else if($repeat["frequency"] == "Every Week") {
	            $repeatWeekly="1";
	        }
	        else if($repeat["frequency"] == "Every Other Week") {
	            $repeatWeekly="2";
	        }
	        else if($repeat["frequency"] == "Every Third Week") {
	            $repeatWeekly="3";
	        }
	        else if($repeat["frequency"] == "Every Fourth Week") {
	            $repeatWeekly="4";
	        }
	        else if($repeat["frequency"] == "Every Month") {
	            $repeatMonthly="1";
	        }
	        else if($repeat["frequency"] == "Every Other Month") {
	            $repeatMonthly="2";
	        }
	        else if(($repeat["frequency"] == "Every Third Month") or ($repeat["frequency"] == "Quarterly")) {
	            $repeatMonthly="3";
	        }
	        else if($repeat["frequency"] == "Every Fourth Month") {
	            $repeatMonthly="4";
	        }
	        else if(($repeat["frequency"] == "Semi-Annually") or ($repeat["frequency"] == "Twice Per Year")) {
	            $repeatMonthly="6";
	        }
	        else if($repeat["frequency"] == "Annually") {
	            $repeatMonthly="12";
	        }
	
	        $repeatParams = array();
	
	        $repeatParams["kEventID"] = $eventID;
	        $repeatParams["kTemplateID"] = $eventsID;
	        $repeatParams["bActive"] = TRUE;
	        $repeatParams["dStartDate"] = date('Y-m-d', strtotime($params["tStart"]));
	        $repeatParams["dEndDate"] = date('Y-m-d', strtotime($repeat["endDate"]));;
	        $repeatParams["eFrequency"] = $repeat["frequency"];
	        $repeatParams["iWeekly"] = $repeatWeekly;
	        $repeatParams["iMonthly"] = $repeatMonthly;
	        $repeatParams["iAnnually"] = $repeatAnnually;
	        $repeatParams["iWeekDays"] = $repeatWeekDays;
	        $repeatParams["iMonthDays"] = serialize($repeatMonthDays);
	
	        error_log("NewEventRepeat: $repeatWeekDays, $repeatWeekly, $repeatMonthDays, $repeatMonthly, $repeatAnnually, $repeatStart, $repeatEnd");
	
	        $this->db->insert("CAL_REPEAT", $repeatParams);
	
	
	        $repeatingDates = $this->repeatingDates($repeatWeekDays, $repeatWeekly, $repeatMonthDays, $repeatMonthly, $repeatAnnually, $repeatStart, $repeatEnd);
	
	        $parentStart = $params["tStart"];
	        $parentEnd = $params["tEnd"];
	
	        foreach ($repeatingDates as $repeatingDate) {
	
	            $params["kParentID"] = $eventsID;
	            $params["bRepeating"] = TRUE;
	
	            error_log("Repeat: $repeatingDate");
	
	            if ($params["fDuration"]>0) { // if we know duration, we can take repeating date and solve for repeat ending date stamp
	
	                $parentDuration = $params["fDuration"];
	
	                list($repeatHour,$repeatMinute) = explode(".", $parentDuration,2);
	
	                $repeatDurationStr = "+" . $repeatHour . " hours " . "+" . $repeatMinute . " minutes";
	                	
	                $parentTimeStart = date('H:i:s', strtotime($parentStart));
	
	                $params["tStart"] = $repeatingDate . " " . $parentTimeStart;
	
	                $params["tEnd"] = date('Y-m-d H:i:s', strtotime($repeatDurationStr, strtotime($params["tStart"])));
	            }
	            else { // if we don't know duration, we have to look at previous event difference between start and end time stamps
	
	                $parentTimeStart = date('H:i:s', strtotime($parentStart));
	                $parentTimeDiff = strtotime($parentEnd) - strtotime($parentStart);
	
	                $params["tStart"] = $repeatingDate . " " . $parentTimeStart;
	                	
	                $params["tEnd"] = date('Y-m-d H:i:s', strtotime($params["tStart"]) + $parentTimeDiff);
	
	            }
	
	            // check excluded dates
	            	
	            if ((!in_array($repeatingDate, $repeat["excludeDates"])) and (!in_array($daysOfWeek[date('D',strtotime($repeatingDate))], $repeat["excludeDays"]))){
	                $repeatingEventID = $this->db->insert("CAL_EVENT", $params);
	            }
	            error_log("Repeating Event: ($repeatingEventID) for $repeatingDate");
	
	        }
	    }
	    	
	    return $eventID;
	}
	
	public function insertEvent($eventsID, $calendarID, $isRecurring, $title, $authorID, $params = array(), $repeat = array()) {
	
	    $daysOfWeek = array('Sun'=>"1", 'Mon'=>"2", 'Tue'=>"3", 'Wed'=>"4", 'Thu'=>"5", 'Fri'=>"6", 'Sat'=>"7");
	
	    $params["kEventID"] = $eventsID;
	    $params["kParentID"] = $eventsID;
	    $params["kCalendarID"] = $calendarID;
	
	    $eventID = $this->db->insert("CAL_EVENT", $params);
	
	    error_log("Create Event: " . $this->db->lastQuery());
	
	    if ($isRecurring) {
	
	        $repeatParams = array();
	
	        $maxDate = "2019-12-31";
	        $repeatWeekly = "";
	        $repeatWeekDays = "0";
	        $repeatMonthDays = array();
	        $repeatMonthly = "";
	        $repeatAnnually = "";
	        $repeatStart =  date("Y-m-d", strtotime($params["tStart"]));
	        $repeatEnd = $repeat["endDate"];
	
	        $repeatParams["kEventID"] = $eventsID;
	        $repeatParams["bActive"] = 1;
	        $repeatParams["dStartDate"] = $repeatStart;
	        $repeatParams["dEndDate"] = $repeatEnd;
	        $repeatParams["eFrequency"] = $repeat["repeatFreq"];
	        $repeatParams["zExclude"] = $repeat["excludeDates"];
	
	        if ($repeatParams["eFrequency"] == "Hourly") {
	            $repeatParams["iHourly"] = $repeat["every"];
	        }
	        else if ($repeatParams["eFrequency"] == "Daily") {
	            $repeatParams["iDaily"] = $repeat["every"];
	        }
	        else if ($repeatParams["eFrequency"] == "Weekly") {
	            $repeatParams["iWeekly"] = $repeat["every"];
	            $repeatParams["iWeekDays"] = $repeat["repeatDaysBinary"];
	        }
	        else if ($repeatParams["eFrequency"] == "Monthly") {
	            $repeatParams["iMonthly"] = $repeat["every"];
	            if ($repeat["repeatMonthly"] == 1) {
	                $repeatParams["iMonthDays"] = $repeat["repeatMonthDayNumber"];
	                $repeatParams["iMonthWeek"] = 0;;
	            }
	            else if ($repeat["repeatMonthly"] == 2) {
	                $repeatParams["iMonthDays"] = $repeat["repeatMonthDaysBinary"];
	                $repeatParams["iMonthWeek"] = $repeat["repeatMonthWeek"];
	            }
	        }
	        else if ($repeatParams["eFrequency"] == "Annually") {
	            $repeatParams["iAnnually"] = $repeat["every"];
	            if ($repeat["repeatAnnually"] == 1) {
	                $repeatParams["iMonths"] = $repeat["repeatAnnualMonth1"];
	                $repeatParams["iMonthDays"] = $repeat["repeatAnnualDayNumber"];
	            }
	            else if ($repeat["repeatAnnually"] == 2) {
	                $repeatParams["iMonthDays"] = $repeat["repeatAnnualDayOfWeek"];
	                $repeatParams["iMonthly"] = $repeat["repeatAnnualWeek"];
	                $repeatParams["iMonths"] = $repeat["repeatAnnualMonth2"];
	            }
	        }
	        else if ($repeatParams["eFrequency"] == "Custom") {
	            $repeatParams["zCustom"] = $repeat["customDates"];
	        }
	        	
	        error_log("Repeat: $repeatWeekDays, $repeatWeekly, $repeatMonthDays, $repeatMonthly, $repeatAnnually, $repeatStart, $repeatEnd");
	
	        $this->db->insert("CAL_REPEAT", $repeatParams);
	
	        $repeatingDates = $this->createRepeatingDates($repeatParams,$maxDate);
	
	        $parentStart = $params["tStart"];
	        $parentEnd = $params["tEnd"];
	
	        foreach ($repeatingDates as $repeatingDate) {
	
	            $params["kParentID"] = $eventsID;
	            $params["bRepeating"] = TRUE;
	
	            error_log("Repeat: $repeatingDate");
	
	            if ($params["fDuration"]>0) { // if we know duration, we can take repeating date and solve for repeat ending date stamp
	
	                $parentDuration = $params["fDuration"];
	
	                list($repeatHour,$repeatMinute) = explode(".", $parentDuration,2);
	
	                $repeatDurationStr = "+" . $repeatHour . " hours " . "+" . $repeatMinute . " minutes";
	                	
	                $parentTimeStart = date('H:i:s', strtotime($parentStart));
	
	                $params["tStart"] = $repeatingDate . " " . $parentTimeStart;
	
	                $params["tEnd"] = date('Y-m-d H:i:s', strtotime($repeatDurationStr, strtotime($params["tStart"])));
	            }
	            else { // if we don't know duration, we have to look at previous event difference between start and end time stamps
	
	                $parentTimeStart = date('H:i:s', strtotime($parentStart));
	                $parentTimeDiff = strtotime($parentEnd) - strtotime($parentStart);
	
	                $params["tStart"] = $repeatingDate . " " . $parentTimeStart;
	                	
	                $params["tEnd"] = date('Y-m-d H:i:s', strtotime($params["tStart"]) + $parentTimeDiff);
	
	            }
	
	            // check excluded dates
	            	
	            if ((!in_array($repeatingDate, $repeat["excludeDates"])) and (!in_array($daysOfWeek[date('D',strtotime($repeatingDate))], $repeat["excludeDays"]))){
	                $repeatingEventID = $this->db->insert("CAL_EVENT", $params);
	            }
	            error_log("Repeating Event: ($repeatingEventID) for $repeatingDate");
	
	        }
	
	    }
	    	
	    return $eventID;
	}
	
	public function upsertEvent($calendarID, $isRecurring, $title, $authorID, $params = array(), $repeat = array()) {
	
	    if ($calendarID == 0) {
	        $calendarID = 1;
	    }
	
	    if (!isset($calendarID)) {
	        $calendarID = 1;
	    }
	
	    $eventsID = $this->db->upsert("CAL_EVENTS", array("kCalendarID"=>$calendarID, "bRepeat"=>$isRecurring, "sName"=>$title, "sTitle"=>$title, "kAuthorID"=>$authorID, "zKeywords"=>$params["keywords"], "bConfirmed"=>"1"));
	
	    $daysOfWeek = array('Sun'=>"1", 'Mon'=>"2", 'Tue'=>"3", 'Wed'=>"4", 'Thu'=>"5", 'Fri'=>"6", 'Sat'=>"7");
	
	    $params["kEventID"] = $eventsID;
	    $params["kParentID"] = $eventsID;
	
	    $eventID = $this->db->upsert("CAL_EVENT", $params);
	
	    //		error_log("Create Event: " . $this->db->lastQuery());
	
	    if ($isRecurring) {
	
	        $maxDate = "2019-01-01";
	        $repeatWeekly = "";
	        $repeatWeekDays = "0";
	        $repeatMonthDays = array();
	        $repeatMonthly = "";
	        $repeatAnnually = "";
	        $repeatStart = $repeat["startDate"];
	        $repeatEnd = $repeat["endDate"];
	
	        $days=0;
	        	
	
	        if($repeat["weekDays"]) {
	            if (is_array($repeat["weekDays"])) {
	                foreach ($repeat["weekDays"] as $day) {
	                    if (is_numeric($day)) {
	                        $days += $day;
	                    }
	                    else {
	                        $day += $daysOfWeek[$day];
	                    }
	                }
	            }
	            else {
	                if (is_numeric($repeat["weekDays"])) {
	                    $days += $repeat["weekDays"];
	                }
	                else {
	                    $days = $daysOfWeek[$repeat["weekDays"]];
	                }
	            }
	            $repeatWeekDays = strval($days);
	        }
	        else {
	            $repeatWeekDays = "0";
	        }
	
	        if($repeat["monthDays"]) {
	            if (is_array($repeat["monthDays"])) {
	                foreach ($repeat["monthDays"] as $day) {
	                    if (is_numeric($day)) {
	                        array_push($repeatMonthDays, $day);
	                    }
	                    else {
	                        array_push($repeatMonthDays, $day);
	                    }
	                }
	            }
	            else {
	                array_push($repeatMonthDays, $repeat["monthDays"]);
	            }
	        }
	
	        if(($repeat["frequency"] == "Daily") or ($repeat["frequency"] == "Every Day")) {
	            $repeatWeekly="1";
	        }
	        else if($repeat["frequency"] == "Every Week") {
	            $repeatWeekly="1";
	        }
	        else if($repeat["frequency"] == "Every Other Week") {
	            $repeatWeekly="2";
	        }
	        else if($repeat["frequency"] == "Every Third Week") {
	            $repeatWeekly="3";
	        }
	        else if($repeat["frequency"] == "Every Fourth Week") {
	            $repeatWeekly="4";
	        }
	        else if($repeat["frequency"] == "Every Month") {
	            $repeatMonthly="1";
	        }
	        else if($repeat["frequency"] == "Every Other Month") {
	            $repeatMonthly="2";
	        }
	        else if(($repeat["frequency"] == "Every Third Month") or ($repeat["frequency"] == "Quarterly")) {
	            $repeatMonthly="3";
	        }
	        else if($repeat["frequency"] == "Every Fourth Month") {
	            $repeatMonthly="4";
	        }
	        else if(($repeat["frequency"] == "Semi-Annually") or ($repeat["frequency"] == "Twice Per Year")) {
	            $repeatMonthly="6";
	        }
	        else if($repeat["frequency"] == "Annually") {
	            $repeatMonthly="12";
	        }
	
	        $repeatParams = array();
	
	        $repeatParams["kEventID"] = $eventID;
	        $repeatParams["kTemplateID"] = $eventsID;
	        $repeatParams["bActive"] = TRUE;
	        $repeatParams["dStartDate"] = date('Y-m-d', strtotime($params["tStart"]));
	        $repeatParams["dEndDate"] = date('Y-m-d', strtotime($repeat["endDate"]));;
	        $repeatParams["eFrequency"] = $repeat["frequency"];
	        $repeatParams["iWeekly"] = $repeatWeekly;
	        $repeatParams["iMonthly"] = $repeatMonthly;
	        $repeatParams["iAnnually"] = $repeatAnnually;
	        $repeatParams["iWeekDays"] = $repeatWeekDays;
	        $repeatParams["iMonthDays"] = serialize($repeatMonthDays);
	
	        error_log("NewEventRepeat: $repeatWeekDays, $repeatWeekly, $repeatMonthDays, $repeatMonthly, $repeatAnnually, $repeatStart, $repeatEnd");
	
	        $this->db->upsert("CAL_REPEAT", $repeatParams);
	
	
	        $repeatingDates = $this->repeatingDates($repeatWeekDays, $repeatWeekly, $repeatMonthDays, $repeatMonthly, $repeatAnnually, $repeatStart, $repeatEnd);
	
	        $parentStart = $params["tStart"];
	        $parentEnd = $params["tEnd"];
	
	        foreach ($repeatingDates as $repeatingDate) {
	
	            $params["kParentID"] = $eventsID;
	            $params["bRepeating"] = TRUE;
	
	            error_log("Repeat: $repeatingDate");
	
	            if ($params["fDuration"]>0) { // if we know duration, we can take repeating date and solve for repeat ending date stamp
	
	                $parentDuration = $params["fDuration"];
	
	                list($repeatHour,$repeatMinute) = explode(".", $parentDuration,2);
	
	                $repeatDurationStr = "+" . $repeatHour . " hours " . "+" . $repeatMinute . " minutes";
	                	
	                $parentTimeStart = date('H:i:s', strtotime($parentStart));
	
	                $params["tStart"] = $repeatingDate . " " . $parentTimeStart;
	
	                $params["tEnd"] = date('Y-m-d H:i:s', strtotime($repeatDurationStr, strtotime($params["tStart"])));
	            }
	            else { // if we don't know duration, we have to look at previous event difference between start and end time stamps
	
	                $parentTimeStart = date('H:i:s', strtotime($parentStart));
	                $parentTimeDiff = strtotime($parentEnd) - strtotime($parentStart);
	
	                $params["tStart"] = $repeatingDate . " " . $parentTimeStart;
	                	
	                $params["tEnd"] = date('Y-m-d H:i:s', strtotime($params["tStart"]) + $parentTimeDiff);
	
	            }
	
	            // check excluded dates
	            	
	            if ((!in_array($repeatingDate, $repeat["excludeDates"])) and (!in_array($daysOfWeek[date('D',strtotime($repeatingDate))], $repeat["excludeDays"]))){
	                $repeatingEventID = $this->db->insert("CAL_EVENT", $params);
	            }
	            error_log("Repeating Event: ($repeatingEventID) for $repeatingDate");
	
	        }
	    }
	    	
	    return $eventID;
	}
	
	

	public function createEvent($calendarID, $title, $description, $details, $categoryID, $startStamp, $endStamp, $locationID, $eventLink, $isRecurring, $areaID) {
	
	    $params = array();
	
	    $userID = $_SESSION["userID"];
	
	    if ($calendarID == 0) {
	        $calendarID = 1;
	    }
	
	    if (!isset($calendarID)) {
	        $calendarID = 1;
	    }
	
	    $eventsID = $this->db->insert("CAL_EVENTS", array("kCalendarID"=>$calendarID, "bRepeat"=>$isRecurring, "sName"=>$title, "kAuthorID"=>$userID));
	
	    error_log("Create Event: " . $this->db->lastQuery());
	
	    if (is_array($categoryID)) {
	
	        foreach ($categoryID as $category) {
	            $params["kCalendarID"] = 1;
	
	            $params["sTitle"] = $title;
	            $params["sDescription"] = $description;
	            $params["sDetails"] = $details;
	            $params["kCategoryID"] = $category;
	            $params["kAreaID"] = $areaID;
	            $params["tStart"] = $startStamp;
	            $params["tEnd"] = $endStamp;
	            $params["kLocationID"] = $locationID;
	            $params["sURL"] = $eventLink;
	            $params["kEventID"] = $eventsID;
	
	
	            $eventID = $this->db->insert("CAL_EVENT", $params);
	        }
	    }
	
	    else {
	
	
	        $params["kCalendarID"] = 1;
	        	
	        $params["sTitle"] = $title;
	        $params["sDescription"] = $description;
	        $params["sDetails"] = $details;
	        $params["kCategoryID"] = $categoryID;
	        $params["kAreaID"] = $areaID;
	        $params["tStart"] = $startStamp;
	        $params["tEnd"] = $endStamp;
	        $params["kLocationID"] = $locationID;
	        $params["sURL"] = $eventLink;
	        $params["kEventID"] = $eventsID;
	        	
	        	
	        $eventID = $this->db->insert("CAL_EVENT", $params);
	    }
	
	    return $eventsID;
	}
	

	public function deleteEvent($eventID) {
	    	
	    $result = $this->db->update("CAL_EVENT", "kParentID", $eventID, array("bDeleted"=>1));
	
	    error_log($this->db->lastQuery());
	     
	    return TRUE;
	     
	}
	
	public function getEventTitle($eventID) {
	     
	    $r=$this->db->query("select * from CAL_EVENTS where id='$eventID'");
	
	    $results=$r->fetch(\PDO::FETCH_ASSOC);
	
	    error_log($this->db->lastQuery());
	
	    error_log("Title: " . $results["title"]);
	
	    return $results["title"];
	
	
	}
	

	public function getEventSourceBySlotID($slotID) {
	     
	    $r=$this->db->query("select CAL_EVENTS.source from CAL_EVENTS left join CAL_EVENT on (CAL_EVENT.eventID=CAL_EVENTS.id) where CAL_EVENT.id='$slotID'");
	
	    $results=$r->fetch(\PDO::FETCH_ASSOC);
	
	    error_log($this->db->lastQuery());
	
	    error_log("Source: " . $results["source"]);
	
	    return $results["source"];
	
	
	}
	
	public function getEventBySlot($slotID) {
	     
	    $r=$this->db->query("select CAL_EVENT.eventID from CAL_EVENTS left join CAL_EVENT on (CAL_EVENT.eventID=CAL_EVENTS.id) where CAL_EVENT.id='$slotID'");
	
	    $results=$r->fetch(\PDO::FETCH_ASSOC);
	
	    error_log($this->db->lastQuery());
	
	    return $results["eventID"];
	
	
	}
	
	
	public function getEventByID($eventID) {
	
	    $eventIDStr = $this->db->quote($eventID);
	
	    $r=$this->db->query("select CAL_EVENT.*,CAL_LOCATION.kAreaID as kAreaID, CAL_LOCATION.kRegionID as kRegionID, CAL_AREAS.sName as areaName, CAL_EVENTS.bRepeat as eRepeat, CAL_REPEAT.eFrequency as frequency, CAL_REPEAT.dEndDate as repeatEnds, DATE_FORMAT(CAL_REPEAT.dEndDate,'%M %D, %Y') as repeatEndsStr, CAL_LOCATION.zAddress,CAL_LOCATION.bGeocoded as bGeocoded, CAL_LOCATION.sLat as sLat,CAL_LOCATION.sLon as sLon, DATE_FORMAT(tStart,'%b %d %Y %h:%i %p') as tStartStr, DATE_FORMAT(tEnd,'%b %d %Y %h:%i %p') as tEndStr, DATE_FORMAT(tStart,'%M %D, %Y') as tDateStr, DATE_FORMAT(tStart,'%m/%d/%Y') as tStartDate, DATE_FORMAT(tEnd,'%m/%d/%Y') as tEndDate,DATE_FORMAT(tStart,'%h:%i %p') as tStartTime, DATE_FORMAT(tEnd,'%h:%i %p') as tEndTime, CAL_EVENT.id as eventID, CAL_EVENT.kCategoryID as category, CAL_EVENT.kLocationID as location, left(CAL_EVENT.sTitle,50) as title, CAL_EVENT.tStart as startStr, CAL_EVENT.tEnd as endStr, CAL_LOCATION.id as locationID, CAL_LOCATION.zAddress as zAddress, CAL_LOCATION.sState as sState, CAL_LOCATION.sCity as sCity, CAL_LOCATION.sZipcode as sZipcode, CAL_EVENT.sURL as uWebsite, CAL_CATEGORIES.id as categoryID, CAL_CATEGORIES.squareImg as squareImg, CAL_CATEGORIES.rectImg as rectImg, CAL_LOCATION.sName as locationName, CAL_CATEGORIES.sName as categoryName from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) left join CAL_REPEAT on (CAL_EVENT.kEventID=CAL_REPEAT.kEventID) left join CAL_LOCATION on (CAL_EVENT.kLocationID=CAL_LOCATION.id) left join CAL_AREAS on (CAL_LOCATION.kAreaID=CAL_AREAS.kAreaID) left join CAL_CATEGORIES on (CAL_CATEGORIES.id=CAL_EVENT.kCategoryID) where CAL_EVENT.id=$eventIDStr");
	    $event=$r->fetch(\PDO::FETCH_ASSOC);
	
	    error_log($this->db->lastQuery());
	
	    return $event;
	
	}
	
	public function getFeedIDByFeedKey($feedKey) {
	
	    $feedKeyStr = $this->db->quote($feedKey);
	
	    $r=$this->db->query("select CAL_FEEDS.id as feedID from CAL_FEEDS where CAL_FEEDS.feedKey = $feedKeyStr");
	    $results=$r->fetch(\PDO::FETCH_ASSOC);
	
	    error_log($this->db->lastQuery());
	
	    return $results["feedID"];
	
	}
	
	
	public function getEventByParentID($eventID) {
	
	    $eventIDStr = $this->db->quote($eventID);
	
	    $r=$this->db->query("select CAL_EVENT.*,CAL_LOCATION.kAreaID as AreaID,CAL_LOCATION.kRegionID as RegionID,  CAL_AREAS.sName as areaName, CAL_EVENTS.bRepeat as eRepeat, CAL_REPEAT.eFrequency as frequency, CAL_REPEAT.dEndDate as repeatEnds, DATE_FORMAT(CAL_REPEAT.dEndDate,'%M %D, %Y') as repeatEndsStr, CAL_LOCATION.zAddress,CAL_LOCATION.bGeocoded as bGeocoded, CAL_LOCATION.sLat as sLat,CAL_LOCATION.sLon as sLon, DATE_FORMAT(tStart,'%b %d %Y %h:%i %p') as tStartStr, DATE_FORMAT(tEnd,'%b %d %Y %h:%i %p') as tEndStr, DATE_FORMAT(tStart,'%M %D, %Y') as tDateStr, DATE_FORMAT(tStart,'%m/%d/%Y') as tStartDate, DATE_FORMAT(tEnd,'%m/%d/%Y') as tEndDate,DATE_FORMAT(tStart,'%h:%i %p') as tStartTime, DATE_FORMAT(tEnd,'%h:%i %p') as tEndTime, CAL_EVENT.id as eventID, CAL_EVENT.kCategoryID as category, CAL_EVENT.kLocationID as location, left(CAL_EVENT.sTitle,50) as title, CAL_EVENT.tStart as startStr, CAL_EVENT.tEnd as endStr, CAL_LOCATION.id as locationID, CAL_LOCATION.zAddress as zAddress, CAL_LOCATION.sState as sState, CAL_LOCATION.sCity as sCity, CAL_LOCATION.sZipcode as sZipcode, CAL_EVENT.sURL as uWebsite, CAL_CATEGORIES.id as categoryID, CAL_CATEGORIES.squareImg as squareImg, CAL_CATEGORIES.rectImg as rectImg, CAL_LOCATION.sName as locationName, CAL_CATEGORIES.sName as categoryName from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) left join CAL_REPEAT on (CAL_EVENT.kEventID=CAL_REPEAT.kEventID) left join CAL_LOCATION on (CAL_EVENT.kLocationID=CAL_LOCATION.id) left join CAL_AREAS on (CAL_LOCATION.kAreaID=CAL_AREAS.kAreaID) left join CAL_CATEGORIES on (CAL_CATEGORIES.id=CAL_EVENT.kCategoryID) where CAL_EVENTS.id=$eventIDStr order by tStart asc limit 1");
	    $event=$r->fetch(\PDO::FETCH_ASSOC);
	
	    error_log($this->db->lastQuery());
	
	    return $event;
	
	}
	
	public function getAllEventsByFeedID($feedKey) {
	
	    $feedKeyStr = $this->db->quote($feedKey);
	
	    $r=$this->db->query("select CAL_EVENT.*,CAL_FEED.isActive as isActiveOnFeed, CAL_FEED.id as eventFeedID, CAL_LOCATION.kAreaID as kAreaID, CAL_LOCATION.kRegionID as kRegionID, CAL_AREAS.sName as areaName, CAL_EVENTS.bRepeat as eRepeat, CAL_REPEAT.eFrequency as frequency, CAL_REPEAT.dEndDate as repeatEnds, DATE_FORMAT(CAL_REPEAT.dEndDate,'%M %D, %Y') as repeatEndsStr, CAL_LOCATION.zAddress,CAL_LOCATION.bGeocoded as bGeocoded, CAL_LOCATION.sLat as sLat,CAL_LOCATION.sLon as sLon, DATE_FORMAT(tStart,'%b %d %Y %h:%i %p') as tStartStr, DATE_FORMAT(tEnd,'%b %d %Y %h:%i %p') as tEndStr, DATE_FORMAT(tStart,'%M %D, %Y') as tDateStr, DATE_FORMAT(tStart,'%m/%d/%Y') as tStartDate, DATE_FORMAT(tEnd,'%m/%d/%Y') as tEndDate,DATE_FORMAT(tStart,'%h:%i %p') as tStartTime, DATE_FORMAT(tEnd,'%h:%i %p') as tEndTime, CAL_EVENT.id as eventID, CAL_EVENT.kCategoryID as category, CAL_EVENT.kLocationID as location, left(CAL_EVENT.sTitle,50) as title, CAL_EVENT.tStart as startStr, CAL_EVENT.tEnd as endStr, CAL_LOCATION.id as locationID, CAL_LOCATION.zAddress as zAddress, CAL_LOCATION.sState as sState, CAL_LOCATION.sCity as sCity, CAL_LOCATION.sZipcode as sZipcode, CAL_EVENT.sURL as uWebsite, CAL_CATEGORIES.id as categoryID, CAL_CATEGORIES.squareImg as squareImg, CAL_CATEGORIES.rectImg as rectImg, CAL_LOCATION.sName as locationName, CAL_CATEGORIES.sName as categoryName from CAL_FEED left join CAL_EVENT on (CAL_FEED.eventID=CAL_EVENT.kEventID) left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) left join CAL_REPEAT on (CAL_EVENT.kEventID=CAL_REPEAT.kEventID) left join CAL_LOCATION on (CAL_EVENT.kLocationID=CAL_LOCATION.id) left join CAL_AREAS on (CAL_LOCATION.kAreaID=CAL_AREAS.kAreaID) left join CAL_CATEGORIES on (CAL_CATEGORIES.id=CAL_EVENT.kCategoryID) left join CAL_FEEDS on (CAL_FEEDS.id=CAL_FEED.feedID) where CAL_EVENT.bDeleted is FALSE and CAL_FEEDS.feedKey = $feedIDStr");
	    $events=$r->fetchAll();
	
	    error_log($this->db->lastQuery());
	
	    return $events;
	
	}
	
	public function getEventCategoriesByParentID($eventID) {
	
	    $eventIDStr = $this->db->quote($eventID);
	
	    $r=$this->db->query("select distinct(CAL_EVENT.kCategoryID) from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) left join CAL_CATEGORIES on (CAL_CATEGORIES.id=CAL_EVENT.kCategoryID) where CAL_EVENT.kParentID=$eventIDStr");
	    $event=$r->fetch(\PDO::FETCH_ASSOC);
	
	    error_log($this->db->lastQuery());
	
	    return $event;
	
	}
	
	public function getRepeatingEventInfoByParentID($eventID) {
	
	    $eventIDStr = $this->db->quote($eventID);
	
	    $r=$this->db->query("select * from CAL_REPEAT where kEventID=$eventIDStr limit 1");
	    $event=$r->fetch(\PDO::FETCH_ASSOC);
	
	    error_log("Repeating Info: " . $this->db->lastQuery());
	
	    return $event;
	
	}
	
	public function getNextEventByID($calendar, $fromDate, $toDate, $categoryID, $keywords, $areaID, $eventID) {
	
	    $eventIDStr = $this->db->quote($eventID);
	
	    $events = $this->getAllEventsByDateRange($calendar, $fromDate, $toDate, $categoryID, $keywords, $areaID);
	
	    $eventFound = FALSE;
	    $foundID = 0;
	    $previousID = 0;
	    $nextID = 0;
	     
	    foreach($events as $event) {
	        $foundID = $event["eventID"];
	        if ($eventFound) {
	            $nextID = $foundID;
	            $eventFound = FALSE;
	            break;
	        }
	        if ($event["eventID"] == $eventID) {
	            $eventFound = TRUE;
	            $previousEventID = $previousID;
	        }
	        else {
	            $eventFound = FALSE;
	            $previousID = $foundID;
	        }
	
	    }
	     
	    error_log($this->db->lastQuery());
	
	    $nextEventID = $nextID;
	
	    return $this->getEventByID($nextEventID);
	
	}
	
	public function getPreviousEventByID($calendar, $fromDate, $toDate, $categoryID, $keywords, $areaID, $eventID) {
	
	    $eventIDStr = $this->db->quote($eventID);
	
	    $events = $this->getAllEventsByDateRange($calendar, $fromDate, $toDate, $categoryID, $keywords, $areaID);
	
	    $eventFound = FALSE;
	    $foundID = 0;
	    $previousID = 0;
	    $nextID = 0;
	     
	    foreach($events as $event) {
	        $foundID = $event["eventID"];
	        if ($event["eventID"] == $eventID) {
	            $eventFound = TRUE;
	            $previousEventID = $previousID;
	            break;
	        }
	        else {
	            $eventFound = FALSE;
	            $previousID = $foundID;
	        }
	    }
	     
	    error_log($this->db->lastQuery());
	
	    $previousEventID = $previousID;
	     
	    return $this->getEventByID($previousEventID);
	
	}
	
	public function getPendingEventsByCalendarID($calendar, $fromDate) {
	
	    if ($fromDate) {
	        $fromDateStr = " and '$fromDate' <= tEnd ";
	    }
	    else {
	        $fromDateStr = '';
	    }
	
	    $r=$this->db->query("select *,CAL_EVENT.sContactName as organizerName, DATE_FORMAT(min(tStart),'%b %d %Y %h:%i %p') as tStartStr, DATE_FORMAT(max(tEnd),'%b %d %Y %h:%i %p') as tEndStr,CAL_EVENT.id as eventID, CAL_EVENT.kCategoryID as category, CAL_EVENT.kLocationID as location, left(CAL_EVENT.sTitle,50) as title, CAL_EVENT.tStart as startStr, CAL_EVENT.tEnd as endStr, CAL_LOCATION.sName as locationName, CAL_LOCATION.id as locationID, CAL_CATEGORIES.squareImg as squareImg, CAL_CATEGORIES.rectImg as rectImg, CAL_CATEGORIES.id as categoryID, CAL_CATEGORIES.sName as categoryName,CAL_LOCATION.zAddress as zAddress, CAL_LOCATION.sState as sState, CAL_LOCATION.sCity as sCity from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) left join CAL_LOCATION on (CAL_EVENT.kLocationID=CAL_LOCATION.id) left join CAL_CATEGORIES on (CAL_CATEGORIES.id=CAL_EVENT.kCategoryID) where CAL_EVENTS.bConfirmed is FALSE $fromDateStr and CAL_EVENT.bDeleted is FALSE and CAL_EVENTS.kCalendarID = '$calendar' group by (CAL_EVENT.kParentID) order by tStart asc,CAL_EVENT.bRepeating asc");
	    $results=$r->fetchAll();
	
	    error_log("Pending: " . $this->db->lastQuery());
	
	    return $results;
	
	}
	
	public function removeEventFromQueue($parentID, $eventID) {
	    if ($this->db->beginTransaction()) {
	        $this->db->update("CAL_EVENT", "id", $eventID, array("bQueued"=>false, "lastQueued"=>date('Y-m-d H:i:s',strtotime("now"))));
	        $this->db->update("CAL_EVENTS", "id", $parentID, array("bQueued"=>false, "lastQueued"=>date('Y-m-d H:i:s',strtotime("now"))));
	        return true;
	    }
	    else {
	        return false;
	    }
	}
	
	public function addEventToFeed($feedID, $eventID, $isActive) {
	
	    $feedEventID = $this->db->upsert("CAL_FEED", array("feedID"=>$feedID, "eventID"=>$eventID, "isActive"=>$isActive));
	
	    return $feedEventID;
	}
	
	public function getEventsByFeedID($calendarID, $feedID) {
	
	    $feedIDStr = $this->db->quote($feedID);
	    $calendarIDStr = $this->db->quote($calendarID);
	
	
	    $r=$this->db->query("select  *,CAL_FEED.id as eventFeedID, CAL_FEED.isActive as isActiveOnFeed, CAL_EVENT.sContactName as organizerName, DATE_FORMAT(min(tStart),'%b %d %Y %h:%i %p') as tStartStr, DATE_FORMAT(max(tEnd),'%b %d %Y %h:%i %p') as tEndStr,CAL_EVENT.id as eventID, CAL_EVENT.kCategoryID as category, CAL_EVENT.kLocationID as location, left(CAL_EVENT.sTitle,50) as title, CAL_EVENT.tStart as startStr, CAL_EVENT.tEnd as endStr, CAL_LOCATION.sName as locationName, CAL_LOCATION.id as locationID, CAL_CATEGORIES.squareImg as squareImg, CAL_CATEGORIES.rectImg as rectImg, CAL_CATEGORIES.id as categoryID, CAL_CATEGORIES.sName as categoryName,CAL_LOCATION.zAddress as zAddress, CAL_LOCATION.sState as sState, CAL_LOCATION.sCity as sCity from CAL_FEED left join CAL_EVENT on (CAL_FEED.eventID=CAL_EVENT.kEventID) left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) left join CAL_LOCATION on (CAL_EVENT.kLocationID=CAL_LOCATION.id) left join CAL_CATEGORIES on (CAL_CATEGORIES.id=CAL_EVENT.kCategoryID) where CAL_FEED.feedID = $feedIDStr and CAL_EVENT.bDeleted is FALSE group by (CAL_EVENT.kParentID) order by tStart asc,CAL_EVENT.bRepeating asc");
	     
	    $results=$r->fetchAll();
	
	    error_log("getEventsByFeedID:" . $this->db->lastQuery());
	
	    return $results;
	
	}
	
	public function getNewFeedEventsByCalendarID($calendarID) {
	
	    $calendarIDStr = $this->db->quote($calendarID);
	
	
	    $r=$this->db->query("select  *,CAL_FEED.id as eventFeedID, CAL_FEED.isActive as isActiveOnFeed, CAL_EVENT.sContactName as organizerName, DATE_FORMAT(min(tStart),'%b %d %Y %h:%i %p') as tStartStr, DATE_FORMAT(max(tEnd),'%b %d %Y %h:%i %p') as tEndStr,CAL_EVENT.id as eventID, CAL_EVENT.kCategoryID as category, CAL_EVENT.kLocationID as location, left(CAL_EVENT.sTitle,50) as title, CAL_EVENT.tStart as startStr, CAL_EVENT.tEnd as endStr, CAL_LOCATION.sName as locationName, CAL_LOCATION.id as locationID, CAL_CATEGORIES.squareImg as squareImg, CAL_CATEGORIES.rectImg as rectImg, CAL_CATEGORIES.id as categoryID, CAL_CATEGORIES.sName as categoryName,CAL_LOCATION.zAddress as zAddress, CAL_LOCATION.sState as sState, CAL_LOCATION.sCity as sCity from CAL_FEED left join CAL_FEEDS on (CAL_FEED.feedID = CAL_FEEDS.id) left join CAL_EVENT on (CAL_FEED.eventID=CAL_EVENT.kEventID) left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) left join CAL_LOCATION on (CAL_EVENT.kLocationID=CAL_LOCATION.id) left join CAL_CATEGORIES on (CAL_CATEGORIES.id=CAL_EVENT.kCategoryID) where CAL_FEEDS.calendarID = $calendarIDStr and CAL_FEED.isNew is TRUE and CAL_EVENT.bDeleted is FALSE group by (CAL_EVENT.kParentID) order by tStart asc,CAL_EVENT.bRepeating asc");
	    $results=$r->fetchAll();
	
	    error_log($this->db->lastQuery());
	
	    return $results;
	
	}
	
	public function getAllEventsByCalendarID($calendarID,$fromDate) {
	
	    if ($fromDate) {
	        $fromDateStr = " and tStart >= '$fromDate'";
	    }
	    else {
	        $fromDateStr = '';
	    }
	     
	    $calendarIDStr = $this->db->quote($calendarID);
	
	    $r=$this->db->query("select *, DATE_FORMAT(tStart,'%b %d %Y %h:%i %p') as tStartStr, DATE_FORMAT(tEnd,'%b %d %Y %h:%i %p') as tEndStr,CAL_EVENT.id as eventID, CAL_EVENT.kCategoryID as category, CAL_EVENT.kLocationID as location, left(CAL_EVENT.sTitle,50) as title, CAL_EVENT.tStart as startStr, CAL_EVENT.tEnd as endStr, CAL_LOCATION.sName as locationName, CAL_LOCATION.id as locationID, CAL_CATEGORIES.squareImg as squareImg, CAL_CATEGORIES.rectImg as rectImg, CAL_CATEGORIES.id as categoryID, CAL_CATEGORIES.sName as categoryName,CAL_LOCATION.zAddress as zAddress, CAL_LOCATION.sState as sState, CAL_LOCATION.sCity as sCity from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) left join CAL_LOCATION on (CAL_EVENT.kLocationID=CAL_LOCATION.id) left join CAL_CATEGORIES on (CAL_CATEGORIES.id=CAL_EVENT.kCategoryID) where CAL_EVENTS.kCalendarID = $calendarIDStr and CAL_EVENT.sStatus='' and CAL_EVENT.sTitle!='' $fromDateStr order by tStart asc,CAL_EVENT.bRepeating asc");
	    $results=$r->fetchAll();
	
	    error_log($this->db->lastQuery());
	
	    return $results;
	
	}
	
	public function getAllEventsByDateRange($calendar, $fromDate, $toDate, $categoryID, $keywords, $areaID) {
	
	    $categoryIDStr = $this->db->quote($categoryID);
	
	    if ($areaID == "") {
	        $areaID="%";
	    }
	
	    $areaIDStr = $this->db->quote($areaID);
	
	    if ($keywords) {
	        $keywordsStr = " and (CAL_EVENT.zKeywords like " . str_replace(' ', '%', $this->db->quote("%" . $keywords . "%")) . " or CAL_EVENT.sDescription like " . str_replace(' ', '%', $this->db->quote("%" . $keywords . "%")) . " or CAL_EVENT.sTitle like " . str_replace(' ', '%', $this->db->quote("%" . $keywords . "%")) . " or CAL_LOCATION.sName like " . str_replace(' ', '%', $this->db->quote("%" . $keywords . "%")) . " or CAL_LOCATION.zAddress like " . str_replace(' ', '%', $this->db->quote("%" . $keywords . "%")) . ")";
	    }
	    else {
	        $keywordsStr="";
	    }
	    if ($categoryIDStr == "''") {
	        $categoryIDStr="'%'";
	    }
	
	    $r=$this->db->query("select *,DATE_FORMAT(CAL_EVENT.tStart, '%Y-%m-%dT%TZ') as startStamp, DATE_FORMAT(CAL_EVENT.tEnd, '%Y-%m-%dT%TZ') as endStamp, CAL_EVENT.id as eventID, CAL_EVENTS.bRepeat as eRepeat, CAL_EVENT.id as id, date_format(CAL_EVENT.tStart, '%m/%d/%y') as stdDateStr, date_format(CAL_EVENT.tStart, '%m/%d/%Y') as dateStr, DATE_FORMAT(tStart,'%b %d %Y %h:%i %p') as tStartStr, DATE_FORMAT(tEnd,'%b %d %Y %h:%i %p') as tEndStr, CAL_EVENT.kCategoryID as categoryID,'All Categories' as category, CAL_EVENT.kLocationID as location, left(CAL_EVENT.sTitle,250) as title, substring(CAL_EVENT.sDescription,0,50) as description, CAL_EVENT.sURL as website, CAL_EVENT.sDescription as description,CAL_EVENT.sContactEmail as emailAddress, date(tStart) as date, '904-555-1212' as phone, CAL_EVENT.tStart as startStr, CAL_EVENT.tEnd as endStr, CAL_LOCATION.sName as locationName, CAL_LOCATION.id as locationID, CAL_LOCATION.zAddress as zAddress, CAL_LOCATION.sState as sState, CAL_LOCATION.sCity as sCity, CAL_CATEGORIES.id as categoryID, CAL_CATEGORIES.squareImg as squareImg, CAL_CATEGORIES.rectImg as rectImg, CAL_CATEGORIES.sName as categoryName from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) left join CAL_REPEAT on (CAL_EVENT.kEventID=CAL_REPEAT.kTemplateID) left join CAL_LOCATION on (CAL_EVENT.kLocationID=CAL_LOCATION.id) left join CAL_CATEGORIES on (CAL_CATEGORIES.id=CAL_EVENT.kCategoryID) where CAL_EVENT.sStatus='' and CAL_EVENT.sTitle!='' and CAL_EVENT.tStart>='$fromDate 00:00:00' and CAL_EVENT.tEnd<='$toDate 23:59:59' and kCategoryID like $categoryIDStr and CAL_LOCATION.kAreaID like $areaIDStr $keywordsStr order by  tStart asc,CAL_EVENT.bRepeating asc limit 2000");
	    $results=$r->fetchAll();
	
	    error_log("All Events By Date Range: " . $this->db->lastQuery());
	
	    return $results;
	
	}
	
	public function getRatedEventsByDateRange($calendar, $fromDate, $toDate, $categoryID, $keywords, $areaID, $rating) {
	
	    $categoryIDStr = $this->db->quote($categoryID);
	
	    if ($areaID == "") {
	        $areaID="%";
	    }
	
	    $areaIDStr = $this->db->quote($areaID);
	
	    if ($rating == "") {
	        $rating="0";
	    }
	
	    $ratingStr = $this->db->quote($rating);
	
	    if ($keywords) {
	        $keywordsStr = " and (CAL_EVENT.zKeywords like " . str_replace(' ', '%', $this->db->quote("%" . $keywords . "%")) . " or CAL_EVENT.sDescription like " . str_replace(' ', '%', $this->db->quote("%" . $keywords . "%")) . " or CAL_EVENT.sTitle like " . str_replace(' ', '%', $this->db->quote("%" . $keywords . "%")) . " or CAL_LOCATION.sName like " . str_replace(' ', '%', $this->db->quote("%" . $keywords . "%")) . " or CAL_LOCATION.zAddress like " . str_replace(' ', '%', $this->db->quote("%" . $keywords . "%")) . ")";
	    }
	    else {
	        $keywordsStr="";
	    }
	    if ($categoryIDStr == "''") {
	        $categoryIDStr="'%'";
	    }
	
	    $r=$this->db->query("select *,DATE_FORMAT(CAL_EVENT.tStart, '%Y-%m-%dT%TZ') as startStamp, DATE_FORMAT(CAL_EVENT.tEnd, '%Y-%m-%dT%TZ') as endStamp, CAL_EVENT.id as eventID, CAL_EVENTS.bRepeat as eRepeat, CAL_EVENT.id as id, date_format(CAL_EVENT.tStart, '%m/%d/%y') as stdDateStr, date_format(CAL_EVENT.tStart, '%m/%d/%Y') as dateStr, DATE_FORMAT(tStart,'%b %d %Y %h:%i %p') as tStartStr, DATE_FORMAT(tEnd,'%b %d %Y %h:%i %p') as tEndStr, CAL_EVENT.kCategoryID as categoryID,'All Categories' as category, CAL_EVENT.kLocationID as location, CAL_EVENT.zKeywords as keywords, left(CAL_EVENT.sTitle,250) as title, substring(CAL_EVENT.sDescription,0,50) as description, CAL_EVENT.sURL as website, CAL_EVENT.sDescription as description,CAL_EVENT.sContactEmail as emailAddress, date(tStart) as date, '904-555-1212' as phone, CAL_EVENT.tStart as startStr, CAL_EVENT.tEnd as endStr, CAL_LOCATION.sName as locationName, CAL_LOCATION.id as locationID, CAL_LOCATION.zAddress as zAddress, CAL_LOCATION.sState as sState, CAL_LOCATION.sCity as sCity, CAL_CATEGORIES.id as categoryID, CAL_CATEGORIES.squareImg as squareImg, CAL_CATEGORIES.rectImg as rectImg, CAL_CATEGORIES.sName as categoryName from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) left join CAL_REPEAT on (CAL_EVENT.kEventID=CAL_REPEAT.kTemplateID) left join CAL_LOCATION on (CAL_EVENT.kLocationID=CAL_LOCATION.id) left join CAL_CATEGORIES on (CAL_CATEGORIES.id=CAL_EVENT.kCategoryID) where CAL_EVENT.sStatus='' and CAL_EVENT.sTitle!='' and CAL_EVENT.tStart>='$fromDate 00:00:00' and CAL_EVENT.tEnd<='$toDate 23:59:59' and kCategoryID like $categoryIDStr and CAL_LOCATION.kAreaID like $areaIDStr $keywordsStr and CAL_EVENT.iRating > $ratingStr order by  tStart asc,CAL_EVENT.bRepeating asc limit 2000");
	    $results=$r->fetchAll();
	
	    error_log("All Events By Date Range: " . $this->db->lastQuery());
	
	    return $results;
	
	}
	
	
	
	public function getTopEvents($calendar, $fromDate, $toDate, $limit) {
	
	    $limitStr = $this->db->quote($limit);
	     
	    $r=$this->db->query("select *,CAL_EVENT.id as eventID, date_format(CAL_EVENT.tStart, '%m/%d/%Y') as dateStr, DATE_FORMAT(tStart,'%b %d %Y %h:%i %p') as tStartStr, DATE_FORMAT(tEnd,'%b %d %Y %h:%i %p') as tEndStr, CAL_EVENT.kCategoryID as categoryID,'All Categories' as category, CAL_EVENT.kLocationID as location, left(CAL_EVENT.sTitle,100) as title, CAL_EVENT.sDescription as description, CAL_EVENT.sURL as website, CAL_EVENT.sContactEmail as emailAddress, date(tStart) as date, '904-555-1212' as phone, CAL_EVENT.tStart as startStr, CAL_EVENT.tEnd as endStr, CAL_LOCATION.sName as locationName, CAL_LOCATION.zAddress as zAddress, CAL_LOCATION.sState as sState, CAL_LOCATION.sCity as sCity, CAL_CATEGORIES.squareImg as squareImg, CAL_CATEGORIES.rectImg as rectImg, CAL_LOCATION.id as locationID, CAL_CATEGORIES.id as categoryID, CAL_CATEGORIES.sName as categoryName from CAL_EVENT left join CAL_EVENTS on (CAL_EVENT.kEventID=CAL_EVENTS.id) left join CAL_LOCATION on (CAL_EVENT.kLocationID=CAL_LOCATION.id) left join CAL_CATEGORIES on (CAL_CATEGORIES.id=CAL_EVENT.kCategoryID) where CAL_EVENT.sStatus='' and CAL_EVENT.sTitle!='' and CAL_EVENT.tStart>=now() order by tStart asc,CAL_EVENT.bRepeating asc limit 3");
	    $results=$r->fetchAll();
	
	    error_log($this->db->lastQuery());
	
	    return $results;
	
	}
	
	
	
	
	
	
	
}
