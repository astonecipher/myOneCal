<?php

/**
 * FILELOGIX HOME CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 */
namespace FLX\Controllers;

class home extends \controller
{
    // Will store database connection here
    private $db;

    private $connID;

    private $sessionID;

    private $userID;

    private $view = "home";

    private $auth;

    private $vars = array();

    private $lists;

    private $registration;

    private $request;

    private $editor;

    /**
     * Create instance, load current info based on session info
     *
     * @return bool
     */
    public function __construct($db, $sessionID, $userID, $request)
    {
        $this->db = $db;
        $this->sessionID = $sessionID;
        $this->userID = $userID;
        $this->request = $request;
        
        $this->auth = new \auth($this->db);
        
        if (! $this->auth->validate($this->userID)) {
            
            $_SESSION["returnURL"] = $this->request->getRequest();
            
            $this->view = "login";
            
            return;
        }
        
        $access = $this->auth->getAccessByUserID($this->userID, "Control Panel");
        
        if (! $access["read"]) {
            
            $_SESSION["returnURL"] = $this->request->getRequest();
            
            $this->view = "login";
            
            return;
        }
        
        unset($_SESSION["returnURL"]);
        
        $this->lists = new \lists($this->db);
        $this->editor = new \editor($this->db);
        
        $this->vars["sideNav"] = "Dashboard";
        
        $this->vars["username"] = "@" . $this->auth->getShortName($this->userID);
        
        $this->dflt();
        
        // $this->db->insert("FLX_CONNECTIONS", array("type"=>$this->type, "sessionID"=>$this->sessionID, "httpHost"=>$this->httpHost, "ipAddress"=>$this->ipAddress, "userAgent"=>$this->userAgent, "fingerprint"=>$this->fingerprint, "requestURI"=>$this->requestURI, "_server"=>print_r($_SERVER,1), "_get"=>print_r($_GET,1), "_post"=>print_r($_POST,1)));
        
        // error_log($this->db->lastQuery());
    }

    public function login($params)
    {
        if ($this->auth->validate($this->userID)) {
            
            $this->view = "CAL_HOME";
            $this->vars["navHomeActive"] = true;
            
            $this->isAdmin = $this->auth->getAccessByUserID($this->auth->getUserID(), "Administrator");
            
            if ($this->isAdmin[0]["view"]) {
                $this->vars["navAdminEnabled"] = true;
            } else {
                $this->vars["navAdminEnabled"] = false;
            }
            
            /*
             * $this->calendar->setCalendarByUserID($this->userID, $this->calendar->getDefaultCalendarByUserID($this->userID));
             *
             * $this->vars["calendars"] = $this->calendar->getCalendarsByUserID($_SESSION["userID"]);
             * $this->vars["currentCalendar"] = $this->calendar->getCurrentCalendarNameByUserID($this->userID);
             *
             */
            return $this->home($params);
        } else {
            
            error_log("Logging Calendar User In... " . $_POST["username"]);
            
            if (($_POST["username"] != "") and ($_POST["password"] != "")) {
                if ($this->auth->login($_POST["username"], $_POST["password"])) {
                    
                    $this->view = "CAL_HOME";
                    $this->vars["navHomeActive"] = true;
                    
                    $this->isAdmin = $this->auth->getAccessByUserID($this->userID, "Administrator");
                    
                    if ($this->isAdmin[0]["view"]) {
                        $this->vars["navAdminEnabled"] = true;
                    } else {
                        $this->vars["navAdminEnabled"] = false;
                    }
                    
                    return $this->home($params);
                } else {
                    $this->view = "CAL_LOGIN";
                    $this->vars["alertError"] = true;
                    return true;
                }
            }
            $this->view = "CAL_LOGIN";
            $this->vars["navHomeActive"] = false;
            
            return true;
        }
    }

    /**
     * Opens the controller - responsible for authentication and loading defaults
     *
     * @return bool true if success, false if failure
     */
    public function open()
    {
        /*
         * $this->users=$this->db->query("select * from connections");
         * foreach ($this->users as $row) {
         * $this->userID = $row['userID'];
         * $this->username = $row['username'];
         * $this->emailAddress = $row['emailAddress'];
         * }
         *
         */
        $this->vars["active"] = "dashboard";
    }

    /**
     * Loads the controller, handles any templating and pre-display logic for the requested view
     *
     * @return bool
     */
    public function load($view)
    {}

    public function dflt()
    {
        if ($this->auth->validate($this->userID)) {
            
            $this->vars["active"] = "dashboard";
            
            $this->view = "home";
            
            return true;
        } else {
            $this->view = "home";
            // return false;
        }
    }

    public function players()
    {
        if ($this->auth->validate($this->userID)) {
            
            return true;
        } else {
            return false;
        }
    }

    public function editor($params)
    {
        if ($this->auth->validate($this->userID)) {
            
            $this->vars["sideNav"] = "Editor";
            /*
             * if ($params[4] == "save") {
             * error_log("Saving Editor Content.");
             * error_log(html_entity_decode($_POST["editorContent"]));
             *
             * return true;
             * }
             */
            
            if ($params[4] == "ace") {
                
                $this->vars["titleBar"] = $params[5];
                
                $this->view = "editor-ace";
                
                $source = $this->editor->getTemplate($params[5]);
                
                // error_log("Dump: $source");
                
                $this->vars["editorSource"] = htmlentities($source);
                
                return true;
            } 

            else {
                
                $this->view = "editor-table";
                
                $templates = $this->editor->getTemplates();
                
                // error_log("Dump: $source");
                
                $this->vars["items"] = $templates;
                
                return true;
            }
        } else {
            return false;
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
?>
