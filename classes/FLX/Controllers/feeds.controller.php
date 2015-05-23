<?php

/**
 * FILELOGIX CALENDAR CLASS
 *
 * @author Andrew Stonecipher
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */
namespace FLX\Controllers;

class feeds 
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
    public function __construct($db, $sessionID, $userID)
    {
        $this->db = $db;
        $this->sessionID = $sessionID;
        $this->auth = new \auth($db);
        $this->userID = $this->auth->getUserID();
        
        $this->lists = new \lists($this->db);
        
        $this->calendar = new \CAL\calendar($this->db);
        
        $this->vars["categories"] = $this->calendar->getAllCategories();
        $this->vars["areas"] = $this->calendar->getAllAreas(1);
        
        $this->vars["events"] = $this->calendar->getTopEvents(1, "2014-04-01", "2014-07-01", 3);
        
        if ($this->auth->validate($this->userID)) {
            
            $this->isAdmin = $this->auth->getAccessByUserID($this->userID, "Administrator");
            
            error_log("IsAdmin: " . $this->isAdmin);
            
            if ($this->isAdmin[0]["view"]) {
                $this->vars["navAdminEnabled"] = true;
            }
        } else {
            $this->vars["navAdminEnabled"] = false;
        }
        
        $this->dflt();
    }

    public function dflt($params)
    {
        if ($params[3] == "event") {
            
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
                $this->view = "CAL_AJAX_RESPONSE";
                
                // $this->vars["events"]=$events;
                // $this->view="CAL_EVENTS_JSON";
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
                $this->view = "CAL_AJAX_RESPONSE";
                
                // $this->vars["event"]=$event;
                // $this->view="CAL_EVENT_JSON";
            }
            
            return $this->vars;
        } 

        else 
            if ($params[3] == "categories") {
                
                $feedID = $params[4];
                
                $calendar = new \CAL\calendar($this->db);
                $categories = $calendar->getCategoriesNotAll();
                $this->vars["categories"] = $categories;
                
                $this->view = "CAL_CATEGORIES_JSON";
                
                return $this->vars;
            } 

            else 
                if ($params[3] == "areas") {
                    
                    $feedID = $params[4];
                    
                    $calendar = new \CAL\calendar($this->db);
                    $areas = $calendar->getAllAreas(1);
                    $this->vars["areas"] = $areas;
                    
                    $this->view = "CAL_AREAS_JSON";
                    
                    return $this->vars;
                } 

                else 
                    if ($params[3] == "locations") {
                        
                        $feedID = $params[4];
                        
                        $calendar = new \CAL\calendar($this->db);
                        $locations = $calendar->getGeocodedLocations(1);
                        $this->vars["locations"] = $locations;
                        
                        $this->view = "CAL_LOCATIONS_JSON";
                        
                        return $this->vars;
                    } 

                    else {
                        
                        if ($_GET["start"]) {
                            if (is_numeric(urldecode($_GET["start"]))) {
                                $fromDate = date("Y-m-d", urldecode($_GET["start"]));
                            } else {
                                $fromDate = date("Y-m-d", strtotime(urldecode($_GET["start"])));
                            }
                        } else {
                            $fromDate = date("Y-m-d", strtotime("yesterday"));
                        }
                        
                        if ($_GET["end"]) {
                            if (is_numeric(urldecode($_GET["end"]))) {
                                $toDate = date("Y-m-d", urldecode($_GET["end"]));
                            } else {
                                $toDate = date("Y-m-d", strtotime(urldecode($_GET["end"])));
                            }
                        } else {
                            $toDate = date("Y-m-d", strtotime("+52 weeks"));
                        }
                        
                        if ($_GET["category"]) {
                            $categoryID = urldecode($_GET["category"]);
                            if ($categoryID == 99) {
                                $categoryID = "";
                            }
                        } else {
                            $categoryID = "";
                        }
                        
                        if ($_GET["area"]) {
                            $areaID = urldecode($_GET["area"]);
                        } else {
                            $areaID = "";
                        }
                        
                        if ($_GET["keywords"]) {
                            $keywords = urldecode($_GET["keywords"]);
                        } else {
                            $keywords = "";
                        }
                        
                        $calendar = new \CAL\calendar($this->db);
                        
                        // $events = $calendar->getRatedEventsByDateRange(1, $fromDate, $toDate, $categoryID, $keywords, $areaID,-1);
                        
                        $feedKey = $params[2];
                        
                        $feedID = $calendar->getFeedIDByFeedKey($feedKey);
                        
                        $events = $calendar->getFeedEventsByDateRange($feedID, $fromDate, $toDate, $categoryID, $keywords, $areaID, - 1);
                        $this->vars["events"] = $events;
                        
                        $this->view = "CAL_FEED_JSON";
                        
                        return $this->vars;
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

