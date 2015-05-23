<?php

/**
 * FILELOGIX CALENDAR CLASS
 *  
 * @author Andrew Stonecipher
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */ 
  
namespace CAL;

class Feed
{
    
    // Will store database connection here
    private $db;
    private $sessionID;
    
    
    public function __construct($db) {
        $this->db = $db;
        $this->sessionID = session_id();
    
    }
    
    public function getAllFeeds() {
         
        $r=$this->db->query("select * from CAL_FEEDS where bActive is TRUE");
        $results=$r->fetchAll();
    
        return $results;
    
    }
    
    public function getFeedsByCalendarIDAndUserID($userID, $calendarID) {
         
        $calendarIDStr = $this->db->quote($calendarID);
        $userIDStr = $this->db->quote($userID);
    
         
        $r=$this->db->query("select * from CAL_USERS left join CAL_MASTER on (CAL_USERS.kCalendarID=CAL_MASTER.id) left join CAL_FEEDS on (CAL_USERS.kCalendarID = CAL_FEEDS.calendarID) where CAL_USERS.kUserID = $userIDStr and CAL_FEEDS.calendarID = $calendarIDStr ");
        $results=$r->fetchAll();
    
        error_log($this->db->lastQuery());
    
        return $results;
    
    }
    
    public function getCurrentFeedByUserID($userID, $calendarID) {
         
        $r=$this->db->query("select kFeedID as feedID from CAL_USERS where CAL_USERS.kUserID=\"$userID\" and CAL_USERS.kCalendarID=\"$calendarID\" and isSelected is TRUE");
     	  $results=$r->fetch(\PDO::FETCH_ASSOC);
    
     	  error_log("FeedID:"  . $this->db->lastQuery());
    
     	  return $results["feedID"];
    
    }
    

    public function getCurrentFeedNameByUserID($userID, $calendarID) {
         
        $r=$this->db->query("select CAL_FEEDS.name as feedName from CAL_USERS left join CAL_MASTER on (CAL_USERS.kCalendarID=CAL_MASTER.id) left join CAL_FEEDS on (CAL_FEEDS.id = CAL_USERS.kFeedID) where CAL_USERS.kUserID=\"$userID\" and CAL_USERS.kCalendarID = \"$calendarID\" and CAL_USERS.isSelected is true");
     	  $results=$r->fetch(\PDO::FETCH_ASSOC);
    
     	  return $results["feedName"];
    
    }
    
    public function setFeedByUserID($userID, $calendarID, $feedID) {
    
        if ($this->checkCalendarByUserID($userID, $calendarID)) {
            $result = $this->db->update("CAL_USERS", "id", $this->getCalendarUserIDByCalendarID($userID, $calendarID), array("kFeedID"=>$feedID));
            if ($result) {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return -1;
        }
    
    }
    
    public function getFeedEventsByDateRange($feedID, $fromDate, $toDate, $categoryID, $keywords, $areaID, $rating) {
    
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
    
        $r=$this->db->query("select *,DATE_FORMAT(CAL_EVENT.tStart, '%Y-%m-%dT%TZ') as startStamp, DATE_FORMAT(CAL_EVENT.tEnd, '%Y-%m-%dT%TZ') as endStamp, CAL_EVENT.id as eventID, CAL_EVENTS.bRepeat as eRepeat, CAL_EVENT.id as id, date_format(CAL_EVENT.tStart, '%m/%d/%y') as stdDateStr, date_format(CAL_EVENT.tStart, '%m/%d/%Y') as dateStr, DATE_FORMAT(tStart,'%b %d %Y %h:%i %p') as tStartStr, DATE_FORMAT(tEnd,'%b %d %Y %h:%i %p') as tEndStr, CAL_EVENT.kCategoryID as categoryID,'All Categories' as category, CAL_EVENT.kLocationID as location, CAL_EVENT.zKeywords as keywords, left(CAL_EVENT.sTitle,250) as title, substring(CAL_EVENT.sDescription,0,50) as description, CAL_EVENT.sURL as website, CAL_EVENT.sDescription as description,CAL_EVENT.sContactEmail as emailAddress, date(tStart) as date, '904-555-1212' as phone, CAL_EVENT.tStart as startStr, CAL_EVENT.tEnd as endStr, CAL_LOCATION.sName as locationName, CAL_LOCATION.id as locationID, CAL_LOCATION.zAddress as zAddress, CAL_LOCATION.sState as sState, CAL_LOCATION.sCity as sCity, CAL_CATEGORIES.id as categoryID, CAL_CATEGORIES.squareImg as squareImg, CAL_CATEGORIES.rectImg as rectImg, CAL_CATEGORIES.sName as categoryName from CAL_FEED left join CAL_EVENTS on (CAL_FEED.eventID = CAL_EVENTS.id) left join CAL_EVENT on (CAL_EVENT.kEventID=CAL_EVENTS.id) left join CAL_REPEAT on (CAL_EVENT.kEventID=CAL_REPEAT.kTemplateID) left join CAL_LOCATION on (CAL_EVENT.kLocationID=CAL_LOCATION.id) left join CAL_CATEGORIES on (CAL_CATEGORIES.id=CAL_EVENT.kCategoryID) where CAL_EVENT.sStatus='' and CAL_EVENT.sTitle!='' and CAL_EVENT.tStart>='$fromDate 00:00:00' and CAL_EVENT.tEnd<='$toDate 23:59:59' and kCategoryID like $categoryIDStr and CAL_LOCATION.kAreaID like $areaIDStr $keywordsStr and CAL_FEED.feedID = '$feedID' and CAL_FEED.isActive>0 group by CAL_EVENTS.id order by  tStart asc,CAL_EVENT.bRepeating asc");
        $results=$r->fetchAll();
    
        error_log("Feed ($feedID) Events By Date Range: " . $this->db->lastQuery());
    
        return $results;
    
    }
    
    
    
}
