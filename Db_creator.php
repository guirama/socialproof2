<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	   
	   /**
		* ****************************************************************
		*
		* BizyCorp/Ekwa Internal development Team
		*
		* @category   ~DATABASE_NAME~
		* @package    CommonObjects - Manually Developed Db creation CLASS
		* @author     Maleeha Mafas
		*
		* 
		* ******************************************************************
		*
		*/

	   /**
	    * *******************************************************************
		*	
		* 	A class to create the database of any new application on the production /  QA environment if not exist.
		*  	
		*   @package    CommonObjects - Manually Developed Db creation CLASS
		*   
		*   USAGE :- Ex:
		*           $dbcreator = new Db_creator ;
		*           $dbcreator->setLogin($cpanel_user,$cpanel_pass);
		*           $dbcreator->createDB();
		*           $dbcreator->createTables();
		*           
		*   Creation date  :- Sep 03, 2015
		*  	Last Modified on :- Sep 03, 2015
		*  	Last Modification :-
		******************************************************************************
		**/


class Db_creator {

  protected $cpanel_user;
  protected $cpanel_pass;

  
  function __construct() {
  
    $this->logoutUrl  = 'http://UAACS.kindersigns.org/API/logout.php';
    $this->lgnCheckUrl = 'http://UAACS.kindersigns.org/API/loginCheck.php' ;
    $this->loginUrl  = 'http://UAACS.kindersigns.org/login.php';
    //include_once('pc1.php');
  }
  
  //Property Setters
  public function setLogin($cpanel_user,$cpanel_pass){
    $this->landPageUrl = $url;
    $this->landPage = file_get_contents("http://tinyurl.com/api-create.php?url={$this->landPageUrl}");//Shortened
  }
  public function setAccessKey($aKey){
    $this->aKey = $aKey;
  }
  public function setSecurityKey($sKey){
    $this->sKey = $sKey;
  }
  public function setAppId($appId){
    $this->appId = $appId;
  }
  public function setRoleId($roleId){
    $this->roleId = $roleId;
  }
  public function setLogoutUrl($logoutUrl){
    $this->logoutUrl = $logoutUrl;
  }
  public function setLgnCheckUrl($lgnCheckUrl){
    $this->lgnCheckUrl = $lgnCheckUrl;
  }
  public function setLoginUrl($loginUrl){
    $this->loginUrl = $loginUrl;
  }
    
  //Property Getters
  public function getLandingPage(){
    return $this->landPage ;
  }
  public function getAccessKey(){
    return $this->aKey = $aKey;
  }
  public function getSecurityKey(){
    return $this->landPage ;
  }
  public function getAppId(){
    return $this->sKey ;
  }
  public function getRoleId(){
    return $this->roleId ;
  }
  public function getLogoutUrl(){
    return $this->logoutUrl ;
  }
  public function getLgnCheckUrl(){
    return $this->lgnCheckUrl ;
  }
  public function getAllowedRoles(){
    return $this->allowedRoles ;
  }
  public function getAllowedFunctions(){
    return $this->allowedFunctions ;
  }
  public function getActiveRole(){
    return $this->activeRole ;
  }
  public function getUserData(){
    return $this->userData ;
  }
  
  
  public function authenticate(){
    log_message('info','POST VARS - '.serialize($_POST)." LANDINGPAGE IS:-".$this->landPageUrl) ;
    //Handle logouts first if requested for
    if (isset($_POST['UAACS_logout']) && $_POST['UAACS_logout']=='yes'){
     
      $ls = base64_encode("{$this->appId}|{$this->roleId}|{$this->landPageUrl}");
      //unset session vars
      if (isset($_SESSION['functions_'.$this->appId]))unset($_SESSION['functions_'.$this->appId]) ;
      if (isset($_SESSION['roles_'.$this->appId])) unset($_SESSION['roles_'.$this->appId]) ;       
      if (isset($_SESSION['roleId_'.$this->appId])) unset($_SESSION['roleId_'.$this->appId]);
      if (isset($_SESSION['user_id_'.$this->appId])) unset($_SESSION['user_id_'.$this->appId]);
      //Redirect to logout
      header("Location:{$this->logoutUrl}?ls=".$ls);
      exit();
    }
    
    //Handle login
    if(!(isset($_POST['lc'])) || $_POST['lc'] != 'yes') //If Login Status check is not being performed yet
    {
      
      $ddata = "$this->appId|$this->roleId|$this->aKey|$this->sKey|$this->landPage";//Data delimited by pipe character (application id, role id, others see above
      //mail('indunil@ekwa.com','Login Check URL',"{$this->lgnCheckUrl}?d=".base64_encode($ddata));//Added to debug infinite redirection loop noted in loginCheck.php -- Indunil on 02/12/2014
      header("Location:{$this->lgnCheckUrl}?d=".base64_encode($ddata));//d = Data base64 encoded, request being made
      exit(); //This is very important
    }
    
    $pc1 = new PC1();
    //$pk = 'cF12#&*)1N!z';
    $pk = 'cF12$g8JK#&*)1N!z';
    $data = $pc1->decrypt($_POST['data'],$pk); // Decrypt Access data                                      
    $this->userData =  new SimpleXMLElement($data);
    
    if( (string)$this->userData->RESULT == 'NOTLOGGEDIN'){ 
      header("Location:{$this->loginUrl}?a={$this->appId}&r={$this->roleId}&showRL=yes&L=".urlencode($this->landPageUrl));
      exit(); //This is very important
    }
    //Get allowed functions
    $myFunctions = $this->userData->DATALIST->USER->ACL->FUNCTION;
    foreach ($myFunctions as $value){
      $this->allowedFunctions[(string) $value->FUNCTIONID]= true;
    }
    //Get Allowed Roles
    $myRoles = $this->userData->DATALIST->USER->ACL->ROLE;
    foreach ($myRoles as $value){
      $this->allowedRoles[(string)$value->ROLEID]['NAME'] = (string) $value->ROLENAME;
      $this->allowedRoles[(string)$value->ROLEID]['ACTIVEROLE']= isset($value->ACTIVEROLE)? true:false;
      if (isset($value->ACTIVEROLE)) $this->activeRole = (string)$value->ROLEID;
    }
  }
}                                               

/* End of file Someclass.php */
