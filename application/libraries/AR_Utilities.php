<?php 
/**
 * Manually Developed CI Controller
 *
 * @package			AIR\Libraris\AR_Utilities
 * @version			V1.2.0
 * @copyright		2015, BizyCorp Internal Systems Development
 * @license			private, All rights reserved
 * @author			MRM Roshan <roshan@ekwa.com>
 *
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Manually Developed CI Library
 *
 * This library communicats with AIR to issue or verify tokens. 
 *
 * Usage:-
 *
 *			function __construct(), default funtion to init uaacs vars
 *
 * @package			AIR\Libraris\AR_Utilities
 * @version			V1.2.0
 * @copyright		2015, BizyCorp Internal Systems Development
 * @license			private, All rights reserved
 * @author			MRM Roshan
 * @created			July 2014
 * @uses
 * @see
 * @modified        28/04/2016 by MRM Roshan
 * @modification	1. Fix UAACS redirect issue when login to AIR
 * */
class AR_Utilities {
	
	
 /**
  * AI Id
  * @var $ai_id
  */	
  public $ai_id = 0;
  /**
   * Calling app user id
   * @var $calling_app_user_id
   */  
  public $calling_app_user_id = 0;
  /**
   * Calling app function id
   * @var $calling_app_function_id
   */  
  public $calling_app_function_id = 0;
  /**
   * Calling app id
   * @var $calling_app_id
   */
  public $calling_app_id = 0;
  /**
   * Called app id
   * @var $called_app_id
   */  
  public $called_app_id = 0;
  /**
   * debug
   * @var $debug
   */
  public $debug = false;
  /**
   * AIR app URL
   * @var $AR_URL
   */  
  public $AR_URL;
  /**
   * AIR issue token request url
   * @var $AR_issue_token_url
   */  
  public $AR_issue_token_url;
  /**
   * AR verify token url
   * @var $AR_verify_token_url
   */  
  public $AR_verify_token_url;
  /**
   * token data array
   * @var $token_data_array
   */  
  public $token_data_array;
  /**
   * progress
   * @var $progress
   */
  
  public $progress;
  /**
   * callback function
   * @var $callback_function
   */ 
  public $callback_function;
  /**
   * validity Status array
   * @var $validityStatus
   */  
  public $validityStatus = array('validity' => null);
  /**
   * request method
   * @var $request_method
   */  
  public $request_method = 'get'; //by default request method is get
  /**
   * receivedtoken
   * @var $received_token
   */
  public $received_token = null; // This is reffering to the token which is received from calling app.
  /**
   * token
   * @var $token
   */  
  public $token; // This is reffering to the token which is obtained directly from AIR.  
  /**
   * function url
   * @var $function_url
   */  
  private $function_url;
  /**
   * function url method
   * @var $function_url_method
   */  
  private $function_url_method;
  /**
   * function para
   * @var $function_para
   */
  private $function_para;
  /**
   * querystring
   * @var $querystring
   */
  private $querystring;
  /**
   * user defined querystring
   * @var $user_defined_querystring
   */
  private $user_defined_querystring;
  /**
   * called app role id
   * @var $called_app_role_id
   */
  private $called_app_role_id;
  /**
   * integration name
   * @var $integration_name
   */
  private $integration_name;
  /**
   * header response
   * @var $header_response
   */  
  private $header_response = array();
  

  
  /**
   *Function __construct()
   *
   * This is default construct which checks request methods to function as get or post outputs.
   * 
   * @param string $app_type caling_app or called_app   
   * @return  void
   * @access  public
   * @since 1.2.0
   * 
   */  
  function __construct($app_type = null) {  	
  
  	if($this->debug) log_message('info',"<b>AR_Utilities lib __construct() invoked and app type is :$app_type</b>");
  
  	// following segment is only executed for called app. Which requires to verify received token
  	if($app_type == 'called_app'){	
  		
  		//check request type
  		if(isset($_GET['token']) && !empty($_GET['token'])){
  			 
  			$this->received_token = $_GET['token'];
  			$this->request_method = 'get';
  			 
  		}else if(isset($_POST['token']) && !empty($_POST['token'])){
  			 
  			$this->received_token = $_POST['token'];
  			$this->request_method = 'post';
  			 
  		}else if(isset($_GET['token']) && empty($_GET['token'])){
  			 
  			$this->received_token = null;
  			$this->request_method = 'get';
  			//if the request is get type then echo the error code and err msg directly
  			//echo "Error : 511 Token was not given!<br>"; //as per channas suggestion error messages always shoud be as header msgs 17/03/2015 MRMR
  			$this->header_output(511,'Token was not given!!');
  			exit;
  			 
  		}else if(isset($_POST['token']) && empty($_POST['token'])){
  			 
  			$this->received_token = null;
  			$this->request_method = 'post';  			
  			$this->header_output(511,'Token was not given!!');//if the request is post type then use header output
  			exit;
  		}  		
  		
  		if($this->debug) log_message(
  				'info',
  				"<b>AR_Utilities lib __construct(), token:$this->token: token request_method :$this->request_method</b>"
  				);
  		
  		if(!empty($this->received_token)){
  				
  			$this->validityStatus = $this->verify_token($this->received_token,$this->debug);
  				
  			if($this->debug) log_message('info',"<b>token validity response:".print_r($this->validityStatus,true)."</b>");
  				
  			if($this->validityStatus['validity'] == 'VALID'){
  				
  				// Register any callback function if you want to run after token validation.
  				// make sure this function is present at the controller.
  				$this->callback_function = "set_external_session_vars";
  				
  			}else{
  				
  				if($this->request_method == 'get'){
  					//echo $this->validityStatus['errorCode'],$this->validityStatus['error'];
  					$this->header_output($this->validityStatus['errorCode'],$this->validityStatus['error']);//as per Channa's suggestion
  					exit;
  				}else if($this->request_method == 'post'){
  					//if the request is post type then use header output
  					$this->header_output($this->validityStatus['errorCode'],$this->validityStatus['error']);
  					exit;
  				}//end else if
  			}//end else  				
  		}	  		
  	}//end if called function settings
  	
 }//end of function
  
  
  
  /**
   * Function set_AR_url_parameters()
   * 
   * This function sets AR_URL porperty value
   *     
   * @return  void
   * @access  private
   * @since 1.2.0
   */
  private function set_AR_url_parameters(){
  	
  	$integration_id = $this->ai_id;
  	$calling_app_id = $this->calling_app_id;
  	$called_app_id = $this->called_app_id;
  	$calling_app_user_id = $this->calling_app_user_id;
  	$calling_app_func_id = $this->calling_app_function_id;
  	$debug = $this->debug;  	
  	
  	if($debug)$this->progress .= "<br>AR_utilities Class:set_AR_url_parameters():integration id:$integration_id, 
  	app id:$calling_app_id,
  	called app id:$called_app_id,
  	calling app user id:$calling_app_user_id,
  	calling_app_func_id:$calling_app_func_id";
	
  	$this->AR_issue_token_url = AR_URL."issueToken/$integration_id/$calling_app_id/$called_app_id/$calling_app_user_id/$calling_app_func_id/$debug";
  	if($debug)$this->progress .= "<br>AR_utilities Class:set_AR_url_parameters(): AR_issue_token_url:".$this->AR_issue_token_url;
  	
  }//end of function
  
  
  
  
  /**
   * Function get_AR_url()
   * 
   * This function returns AR_URL property value
   *  
   * @return  string AIR app url
   * @access  public
   * @since 1.2.0
   */
  public function get_AR_url(){
  	return AR_URL;
  }//end of function
  
  
  
  /**
   * Function request_token()
   *
   * This function request a token from AIR to communicate with called application
   * 
   * @param bool $debug true or false default false   
   * @return  array token data array on success otherwise error
   * @access  public
   * @since 1.2.0 
   */  
  public function request_token($debug = false){
  
  	if($debug)$this->progress .= "<br>AR_utilities Class:request_token(): invoked";
  	 
  	$start = microtime(true);
  	
  	//check if property values are set  	
  	if($this->ai_id == 0 || empty($this->ai_id)){
  		$this->token_data_array = array(
  				'ErrorCode'=>600,
  				'Error'=>'Integration Id not set!'
  		);
  		$this->log(array('mode'=>'Token request call via AR_Utilities','data'=>'Token request responce:'.print_r($this->token_data_array,true)));
  		return $this->token_data_array;
  		
  	}else if($this->calling_app_id ==0 || empty($this->calling_app_id)){
  		$this->token_data_array = array(
  				'ErrorCode'=>601,
  				'Error'=>'Caling app Id not set!'
  		);
  		$this->log(array('mode'=>'Token request call via AR_Utilities','data'=>'Token request responce:'.print_r($this->token_data_array,true)));
  		return $this->token_data_array;
  		
  	}else if($this->called_app_id ==0 || empty($this->called_app_id)){
  		$this->token_data_array = array(
  				'ErrorCode'=>602,
  				'Error'=>'Called app Id not set!'
  		);
  		$this->log(array('mode'=>'Token request call via AR_Utilities','data'=>'Token request responce:'.print_r($this->token_data_array,true)));
  		return $this->token_data_array;
  		
  	}else if($this->calling_app_user_id==0 || empty($this->calling_app_user_id)){
  		$this->token_data_array = array(
  				'ErrorCode'=>603,
  				'Error'=>'Caling app user Id not set!'
  		);
  		$this->log(array('mode'=>'Token request call via AR_Utilities','data'=>'Token request responce:'.print_r($this->token_data_array,true)));
  		return $this->token_data_array;
  		
  	}else if($this->calling_app_function_id ==0 || empty($this->calling_app_function_id)){
  		$this->token_data_array = array(
  				'ErrorCode'=>604,
  				'Error'=>'Caling app function Id not set!'
  		);
  		$this->log(array('mode'=>'Token request call via AR_Utilities','data'=>'Token request responce:'.print_r($this->token_data_array,true)));
  		return $this->token_data_array;
  		
  	}//end if
  	
  	//if all properties are set then proceed to set air url 
  	$this->set_AR_url_parameters();

  	$xmlUrl = $this->AR_issue_token_url;  	
  	$xmlDoc = file_get_contents($xmlUrl);
  	$xmlObj = simplexml_load_string($xmlDoc);
  	
  	//var_dump($xmlObj);exit;
    	 
  	$AR = $xmlObj->xpath("//AR");
  	$status = trim($AR[0]->LOGIN);
  	$debugData = trim($AR[0]->DEBUG);
  	
  	//if($debug)$this->progress .= "<br><br><b>AR_utilities RESPONSE:</b><br>"; 
  	  	 
  	if($debug){
  		
  	  if($debug)$this->progress .= "<br><br><b>AIR RESPONSE:</b>".$debugData;
      if($debug)$this->progress .= "<br>AR_utilities Class:request_token(): login status:$status";
  	}
  	 
  	if($status == 'SUCCESS'){  
  		
  		$this->token = trim($AR[0]->TOKEN);  		
  		$this->progress .= "<br>AR_utilities Class:request_token(): obtained token:".$this->token;
  
  		$this->function_url = trim($AR[0]->FUNCTION_URL_DATA->URL);
  		$this->progress .= "<br>AR_utilities Class:request_token(): obtained function url:".$this->function_url;
  
  		$this->function_url_method = strtolower(trim($AR[0]->FUNCTION_URL_DATA->METHOD));
  		$this->progress .= "<br>AR_utilities Class:request_token(): function url method:".$this->function_url_method;
  
  		$this->function_para = json_decode(json_encode($AR[0]->FUNCTION_URL_DATA->FUNCTION_PARAMETERS->PARAMETER), true);;
  		$this->progress .= "<br>AR_utilities Class:request_token(): function url parameter list:<pre>".print_r($this->function_para,true).'</pre>';
  		
  		//make parameter vars global
  		$this->globalize_var($this->function_para,$debug);
  		
  		$this->querystring = json_decode(json_encode($AR[0]->FUNCTION_URL_DATA->QUERYSTRING->QUERYPARM), true);;
  		$this->progress .= "<br>AR_utilities Class:request_token(): function url querystring list:<pre>".print_r($this->querystring,true).'</pre>';  
  		
  		//make querystring vars global
  		$this->globalize_var($this->querystring,$debug);
  		
  		$this->user_defined_querystring = $AR[0]->FUNCTION_URL_DATA->USER_DEFINED_QUERYSTRING;
  		$this->progress .= "<br>AR_utilities Class:request_token(): function user defined querystring:<pre>".print_r($this->user_defined_querystring,true).'</pre>';
  		//var_dump($this->user_defined_querystring);exit;
  		
  	}else{
  		
  		//$loginStatus = $xpath->query("//LOGIN");
  		$status = trim($AR[0]->LOGIN);
  
  		//$errorCode = $xpath->query("//ERRORCODE");
  		//$errorCode = $errorCode->item(0)->textContent;
  		$errorCode = trim($AR[0]->ERRORCODE);
  
  		//$error = $xpath->query("//ERROR");
  		//$error = $error->item(0)->textContent;
  		$error = trim($AR[0]->ERROR);
  
  		//if($debug) log_message('debug',"AR_Utilities lib:errorCode:$errorCode");
  		if($debug)$this->progress .= "<br>AR_utilities Class:request_token(): error code:".$errorCode;
  
  		//if($debug) log_message('debug',"AR_Utilities lib:error:$error");
  		if($debug)$this->progress .= "<br>AR_utilities Class:request_token(): error msg:".$error;
  
  		$this->token = null;
  		
  		
  	}
  
  	 
  	$endtime = microtime(true) - $start;
  	  	 
  	$token_data = array();
  	 
  	if(!empty($this->token)){
  		$this->token_data_array = array(
  				'token' => $this->token, 
  				'function_url' => $this->function_url,
  				'function_url_method' => $this->function_url_method,
  				'function_para' => $this->function_para,
  				'querystrings' => $this->querystring,
  				'user_defined_querystrings' => $this->user_defined_querystring			
  				
  		);
  		
  	}else{
  		$this->token_data_array = array(
  				'ErrorCode'=>$errorCode, 
  				'Error'=>$error
  		);
  		
  	}
  	 	
  	if($debug)$this->progress .= "<br>AR_utilities Class:request_token(): token_data_array :<pre>".print_r($this->token_data_array,true).'</pre>';
  	if($debug)$this->progress .= "<br>AR_utilities Class:request_token(): total execution time:".$endtime;
  	

  	//log
  	$this->log(array(
  			'mode'=>'Token request call via AR_Utilities',
  			'data'=>'Token request URL:'.$xmlUrl.
  			' Token request responce:'.print_r($this->token_data_array,true)));
  	 
  	
  	return $this->token_data_array;  	 
  	 
  }//end of function
  
  
  
  /**
   * Function globalize_var($vars)
   * 
   * This functioin maks all passed varialbe global to acccess from anywhere in the application
   * mainly to access URL parameters and querystring vars.
   * 
   * @param array $vars varialbe array which needs to be make as globals
   * @param bool $debug true or false default false   
   * @return  void
   * @access  private
   * @since 1.2.0 
   */
  private function globalize_var($vars,$debug){
  	
  	if($debug)$this->progress .= "<br>AR_utilities Class:globalize_var(): received vars:<pre>".print_r($vars,true).'</pre>';
  	
  	$new_para = null;
  	foreach($vars as $var){
  		$v = explode('-',$var);
  		if(count($v) > 1){  	
  			$m = null;
  			foreach($v as $g){
  				$pos = strpos($g, '$');
  				if($pos !== false){ 
  					$GLOBALS[$g] = substr($g, 1);  					
  					//$new_para .= $GLOBALS[$g].'-';
  					 			  					
  				}		 				  			 
  			}//end foreach
  			//$new_para = rtrim($new_para,'-');
  				
  		}else{
  			
  			$pos = strpos($var, '$');  			
  			if($pos !== false){
  				$GLOBALS[$var] = substr($var, 1);				
  			}
  			 			
  		}//end if  		
  	}//end foreach

  	if($debug)$this->progress .= "<br>AR_utilities Class:globalize_var(): globalization done:<pre>".print_r($vars,true).'</pre>';
  	
  }//end of function
  
    
  /**
   * Function verify_token()
   * 
   * This function gets the token to verify from AR.This function makes the call to AR along with the token.
   * and then gets response XML from AR. Based on the response xml feed this will either return valid or invalid
   * 
   * @param string $enc_token
   * @param bool $debug true or false default false   
   * @return  array token validity status
   * @access  public
   * @since 1.2.0 
   */
  public function verify_token($enc_token,$debug = false){
  	
  	if($debug)$this->progress .= "<br>AR_utilities Class:verify_token() invoked";  	
  	
  	if(empty($enc_token)){
  		
  		if($this->request_method == 'post'){
  			header("HTTP/1.1 511 Token was not given!");
  			exit;
  		}else {
  			echo '511 Token was not given!';
  			exit;
  		}
  	
  	}
  	
  	$error = null;
  	$errorCode = null;
  	$verifyStatus = array(); 
  	
  	//decrypt and break token values to get called app function id 
  	$token = base64_decode($enc_token);
  	if($debug) log_message('info',"AR_Utilities:verify_token();decrypted token value:$token");
  	
  	if($debug)$this->progress .= "<br>AR_utilities Class:verify_token() decrypted token:$token`";
  	
  	//var_dump($token);exit;	
  	//verify process
  	$token_parts = explode('-', $token);
  	
  	$token_parts = explode('-', $token);
  	if(!empty($token_parts)){		
  		
  		if(isset($token_parts[0])){
  			$session_vars['calling_app_id'] = $token_parts[0];
  		}else{
  			if($this->request_method == 'post'){
  				header("HTTP/1.1 513 Incomplete token was given");
  				exit;
  			}else {
  				echo '513 Incomplete token was given';
  				exit;
  			}
  		} 
  		if(isset($token_parts[1])){
  			$session_vars['called_app_id'] = $token_parts[1];
  		}else{
  			if($this->request_method == 'post'){
  				header("HTTP/1.1 513 Incomplete token was given");
  				exit;
  			}else {
  				echo '513 Incomplete token was given';
  				exit;
  			}
  		} 
  		if(isset($token_parts[2])){
  			$session_vars['calling_app_host_ip'] = $token_parts[2];
  		}else{
  			if($this->request_method == 'post'){
  				header("HTTP/1.1 513 Incomplete token was given");
  				exit;
  			}else {
  				echo '513 Incomplete token was given';
  				exit;
  			}
  		} 
  		if(isset($token_parts[3])){
  			$session_vars['calling_app_user_id'] = $token_parts[3];
  		}else{
  			if($this->request_method == 'post'){
  				header("HTTP/1.1 513 Incomplete token was given");
  				exit;
  			}else {
  				echo '513 Incomplete token was given';
  				exit;
  			}
  		} 
  		if(isset($token_parts[4])){
  			$session_vars['called_app_func_id'] = $token_parts[4];
  		}else{
  			if($this->request_method == 'post'){
  				header("HTTP/1.1 513 Incomplete token was given");
  				exit;
  			}else {
  				echo '513 Incomplete token was given';
  				exit;
  			}
  		} 
  		if(isset($token_parts[5])){
  			$session_vars['time_stamp'] = $token_parts[5];
  		}else {
  			if($this->request_method == 'post'){
  				header("HTTP/1.1 513 Incomplete token was given");
  				exit;
  			}else {
  				echo '513 Incomplete token was given';
  				exit;
  			}
  		}  	
  	}else{
  		if($this->request_method == 'post'){
  			header("HTTP/1.1 512 Token was not valied");
  			exit;
  		}else {
  			echo '512 Token was not valied';
  			exit;
  		}
  	}
  	
  	//create uaacs env sessions
  	$this->create_uaacs_env($session_vars);
  	
  	//
  	// Please refffer this URL to understand how to call a method of a different class
  	// http://php.net/manual/en/language.types.callable.php
  	//
  	
  	if(isset($this->callback_function))
  		call_user_func(array($this->get_calling_class(), $this->callback_function));
  	
  	
  	$this->AR_verify_token_url = AR_URL."verify_token/$debug?token=$enc_token";
  	//if($debug) log_message('info',"AR_Utilities/verify_token()-AR_verify_token_url:".$this->AR_verify_token_url."");
  	if($debug)$this->progress .= "<br>AR_utilities Class:verify_token() - AR_verify_token_url:".$this->AR_verify_token_url."";
  	
  	$AR_response = file_get_contents($this->AR_verify_token_url);
  	//if($debug) log_message('info',"AR_Utilities/verify_token()-AR_response:$AR_response");
  	if($debug)$this->progress .= "<br>AR_Utilities/verify_token()-AR_response:$AR_response";
  	
  	//var_dump($AR_response);exit;
  	
  	$doc = new DOMDocument();
  	$doc->loadXML($AR_response);
  	$xpath = new DOMXPath($doc);
  	$status = $xpath->query("//TOKENVALIDITY");  		
  	$this->validityStatus['validity'] = $status->item(0)->textContent;
  	
  	//if($this->debug) log_message('info',"AR_Utilities/verify_token(),token validity:".$this->validityStatus['validity']."");
  	if($debug)$this->progress .= "<br>AR_Utilities/verify_token(),token validity:".$this->validityStatus['validity'];
  	
  	if($debug){
  		$debug = $xpath->query("//DEBUG");
  		$debugData = $debug->item(0)->textContent;
  		if($debug)$this->progress .= "<br><b>AR VERIFY TOKEN RESPONSE:</b>".$debugData;
  	} 	 
  	
  	if($this->validityStatus['validity'] == 'INVALID'){
  		
  		$errorCode = $xpath->query("//ERRORCODE");
  		$errorCode = $errorCode->item(0)->textContent;
  		//if($debug) log_message('info',"AR_Utilities/verify_token(),errorCode:$errorCode");
  		if($debug)$this->progress .= "<br>AR_Utilities/verify_token(),errorCode:$errorCode";
  		
  		$error = $xpath->query("//ERROR");
  		$error = $error->item(0)->textContent;
  		
  		//if($debug) log_message('info',"AR_Utilities/verify_token(),error:$error");
  		if($debug)$this->progress .= "<br>AR_Utilities/verify_token(),error:$error";
  		$this->validityStatus['errorCode'] = $errorCode;
  		$this->validityStatus['error'] = $error;  	
  		
  		//log
  		$this->log(array(
  				'mode'=>'Verify token call via AR_Utilities',
  				'data'=>'Verify Token URL:'.$this->AR_verify_token_url.
  				' Token verification responce: '.print_r($this->validityStatus,true)));
  		
  		if($this->request_method == 'post'){
  			header("HTTP/1.1 $errorCode $error");
  			exit;  		
  		}else {
  			echo $errorCode.' '.$error;
  			exit;
  		}
  		
  	}  	
  	

  	//log
  	$this->log(array(
  			'mode'=>'Verify token call via AR_Utilities',
  			'data'=>'Verify Token URL:'.$this->AR_verify_token_url.
  			' Token verification responce: '.print_r($this->validityStatus,true)));
  	 
  	
  	return $this->validityStatus;
  	
  }//end of function
  
  

  /**
   * Function get_calling_class()
   *
   * This function is used for getting the calling class name. This calling class name then
   * be used to execute callback user defined function at calling class.
   * http://stackoverflow.com/questions/3620923/how-to-get-the-name-of-the-calling-class-in-php
   * 
   * @access  private
   * @since 1.2.0
   * @return  void 
   */
  function get_calling_class() {
  
  	//get the trace
  	$trace = debug_backtrace();
  
  	// Get the class that is asking for who awoke it
  	$class = $trace[1]['class'];
  
  	// +1 to i cos we have to account for calling this function
  	for ( $i=1; $i<count( $trace ); $i++ ) {
  		if ( isset( $trace[$i] ) ) // is it set?
  			if ( $class != $trace[$i]['class'] ) // is it a different class
  			return $trace[$i]['class'];
  	}
  }//end of function
  
  
  /**
   * Function create_uaacs_env()
   *
   * This function will create UAACS environment session vars upon call.
   *
   * @param array session variables to be created in called application as UAACS auth   
   * @return  void
   * @access  public
   * @since 1.2.0
   */
  public function create_uaacs_env($session_vars){ 	 
  
  	//create uaacs env sessions
  
  	$_SESSION['app_id'] = $session_vars['called_app_id'];
  	$_SESSION['user_id'] = $session_vars['calling_app_user_id'];
  	$_SESSION['user_name']='AIR';
  	$_SESSION['user_type'] =  'AIR User';
  	$_SESSION['roleId_'.$_SESSION['app_id']] = 'AIR Role id';
  	$_SESSION['roles_'.$_SESSION['app_id']] = array('AIR Role' => Array('NAME' => "AIR User",'ACTIVEROLE' => 1));
  	
  	//set cookies
  	setcookie("user_type",'AIR User');
  	setcookie("user_id",$session_vars['calling_app_user_id']);
  	 
  }//end of function
  
    
  /**
   * Function init_call()
   * 
   * This function initiate the communication from calling function to called function.
   * this funcion automatically extracts parameter list and querystring (get/post) vars from AIR response xml
   * and prepares appropriate variable arrays. Then calls post or get url calls based on url method specified on 
   * AIR response xml.
   *  
   * @param bool $show_output - true or false
   * @param bool $debug - true or false
   * @param string $token - token string    
   * @return  string responce This canbe a header message or html output
   * @access  public
   * @since 1.2.0 
   */
  public function init_call($show_output = false,$debug = false,$token=null){
  	
  	
  	if($debug)$this->progress .= "<br>AR_utilities Class:init_call() invoked";  	
  	
  	if(empty($this->token_data_array['token'])){
  		
  		echo '511 Token was not given!';
  		exit;
  	}
  	
  	$response = null;
  	$para_list = null;
  	$new_querystring_vars = null;
  	$method = $this->function_url_method;
  	$token_data = $this->token_data_array;  	
	$function_url = trim($this->function_url,'/');// get the url without trailing '/';
		
  	//obtain URL para list from AIR feed
  	$url_paras = (isset($token_data['function_para']))?$token_data['function_para']:null;
  	if($debug)$this->progress .= "<br>AR_utilities Class: params var data:<pre>".print_r($url_paras,true).'</pre>';
  	
  	//obtain querysting list from AIR feed
  	$querystring_vars = (isset($token_data['querystrings']))?$token_data['querystrings']:null;  	
  	 
  	if(!empty($url_paras)){
  	//process the para list and make them $GLOBALS to access local variable values
  	foreach($url_paras as $para){
  	
  		//check for '-' or '_'  seperated variables in $para var. if found break them into single variables
  		
  		$v = explode('-',$para);
  		//$v2 = explode('_',$para);  		
  		$v2 = 0;
  		if(count($v) > 1){
  			$new_para = null;
  			$m = null;
  			foreach($v as $g){
  				$pos = strpos($g, '$');
  				if($pos !== false){
  					$g = substr($g, 1);  					
  					$new_para .= $GLOBALS[$g].'-'; 			  					
  				}else{//end if
  					$new_para .= $g.'-';
  				}  				 				  			 
  			}//end foreach
  			$new_para = rtrim($new_para,'-');
  			$para_list .= '/'.$new_para;
  				
  		}else if(count($v2) > 1){
  			
  			$new_para = null;
  			$m = null;
  			
  			foreach($v2 as $g){
  				$pos = strpos($g, '$');
  				if($pos !== false){
  					$g = substr($g, 1);
  					$new_para .= $GLOBALS[$g].'_';
  				}else{//end if
  					$new_para .= $g.'_';
  				}
  			}//end foreach
  			$new_para = rtrim($new_para,'_');
  			$para_list .= '/'.$new_para;
  			
  		}else{
  			
  			//eval is needed to assign values to actual $vars.Otherwise $vars will be treated as strings.
  			//eval("\$para = \"$para\";");
  			
  			$pos = strpos($para, '$');  			
  			if($pos !== false){
  				$para = substr($para, 1);
  				$new_para = $GLOBALS[$para];
  			}else{
  				$new_para = $para;
  			}//end if  			
  			$para_list .= '/'.$new_para;
  			  			
  		}//end if 		  		
  	}//end foreach
  	
  	}//end if
  	
  	//prepare function URL with para list for execution  	
  	$url = $function_url.$para_list; 	
  	//var_dump($url);exit;
  	
  	//Attach the token
  	$new_querystring_vars['token'] = $token;//$token_data['token']; //changed as per channa's request
  	  	
  	if(!empty($querystring_vars)){
  	//process the querystring list and make them $GLOBALS to access local variable values
  	foreach($querystring_vars as $para){
  		
  		$var_with_val= null;
  		$pair = explode('=',$para);  		
 		$pos = strpos($pair[1], '$');
 		
  		if($pos !== false){
  			$pair[1] = substr($pair[1], 1); 			
  			
  			 $new_querystring_vars[$pair[0]] = $GLOBALS[$pair[1]];
  			 
  			 if(empty($new_querystring_vars[$pair[0]])){  			 
  			 	echo '604 '.$pair[0].' cannot be empty.Aborting...';
  			 	//log
  			 	$this->log(array(
  			 			'mode'=>'init_call() var check via AR_Utilities',
  			 			'data'=>'Error : 604 '.$pair[0]. ' is empty. Aborted'));
  			 	exit;
  			 }
  			
  		}else{  		
  			$new_querystring_vars[$pair[0]] = $pair[1];
  			if(empty($new_querystring_vars[$pair[0]])){
				echo '604 '.$pair[0].' cannot be empty.Aborting...';
				//log
				$this->log(array(
						'mode'=>'init_call() var check via AR_Utilities',
						'data'=>'Error : 604 '.$pair[0]. ' is empty. Aborted'));
				
  				exit;
  			}
  		}//end if
  		
  	}//end foreach
  	}//end if
  	  
  	//var_dump($new_querystring_vars);exit;  	
  	
  	//log
  	$this->log(array(
  			'mode'=>'init_call() var check via AR_Utilities',
  			'data'=> "method: $method, url :$url, show output :$show_output".' Qstring vars: '.print_r($new_querystring_vars,true)));
  	
  	  	
  	if($method == 'get'){
  	  		
  		$response = $this->http_get_call(
  				$url,
  				$new_querystring_vars,
  				$show_output,
  				$debug);
  		
  	}elseif($method == 'post'){
  		
  		$response = $this->http_post_call(
  				$url,
  				$new_querystring_vars,
  				$debug);  		
  	}
  	
  	//log
  	$this->log(array(
  			'mode'=>'init_call responce via AR_Utilities',
  			'data'=>'constructed URL: '.$url. ' Token :'.$token.
  			' Show Output: '.$show_output));
  	
  	return $response;
  	
  }//end of function
  
  
  
  
  /**
   * Function http_get_call()
   * 
   * This function maks the call as get method.
   * $debug true or false default false
   * 
   * @param string $url - URL to be called as get 
   * @param array $qstring_array - Qstirng array to be appended to get URL
   * @param bool $show_output - show output tru/false
   * @param bool $debug - true or false     
   * @return  string output This canbe a header message or html output
   * @access  public
   * @since 1.2.0 
   */
  public function http_get_call($url,$qstring_array,$show_output = true,$debug = false){

  	if($debug)$this->progress .= "<br><br>AR_utilities Class:http_get_call() invoked";
  	if($debug)$this->progress .= "<br>AR_utilities Class:http_get_call() url value:".$url;
  	if($debug)$this->progress .= "<br>AR_utilities Class:http_get_call() params value:<pre>".print_r($qstring_array,true)."</pre>";
  	
  	$qstring = '?';
  	$output = null;
  	
  	if(is_array($qstring_array)){
  		foreach($qstring_array as $k => $v){
  			$qstring .= $k.'='.$v.'&';
  		}//end foreach	
  	}//end if
  	
  	$qstring = rtrim($qstring,'&'); 
  	
  	if($debug)$this->progress .= "<br>AR_utilities Class:http_get_call() final querystring:$qstring";
  	if($debug)$this->progress .= "<br>AR_utilities Class:http_get_call() querystring with URL:$url$qstring";
  	
  	$full_url = $url.$qstring;
  	//var_dump($full_url);exit;
  	
  	//log
  	$this->log(array(
  			'mode'=>'http_get_call() via AR_Utilities',
  			'data'=>' URL with Qstring vars: '.$full_url));
  	
  	/*
  	// get content function does not return some pagees due to time out. stream_context soludtion did not work for me here.
  	// so i implmeented curl functions to overcome the issue. MRMR 3/5/2016
  	//$output = $this->get_contents_with_session($full_url);  	
  	$Context = stream_context_create(array(
  			'http' => array(
  					'method' => 'get',
  					'timeout' => 300,
  			)
  	));  	
  	$output = file_get_contents($full_url,false,$Context);  	
  	*/  	
  	$url=$full_url;
  	$ch=curl_init();
  	$timeout=20;  	
  	curl_setopt($ch, CURLOPT_URL, $url);
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);  	
  	$result=curl_exec($ch);
  	curl_close($ch);
  	
  	$output = $result;  	
  	$headers = get_headers($full_url);
  	
  	
  	if($debug)$this->progress .= "<br>AR_utilities Class:http_get_call() output :<pre>".$output."</pre>";
  	
  	$this->HandleHeader(null,$headers[0]);
  	if(empty($output)){
  		return	 $output;//$this->header_response;
  	}else{
  		return $output;
  	} 	 
  	
  }//end of function
  
  

  /**
   * Function http_post_call()
   *
   * This function is used for making POST method calls to a given function url.
   *
   * @param string $url - URL to be called as get 
   * @param array $params - url parameters   
   * @return  string output This canbe a header message or html output
   * @access  public
   * @since 1.2.0 
   *
   */  
  public function http_post_call($url,$params,$debug = false){
  	
  	if($debug)$this->progress .= "<br><br>AR_utilities Class:http_post_call() invoked";
  	if($debug)$this->progress .= "<br>AR_utilities Class:http_post_call() url value:".$url;
  	if($debug)$this->progress .= "<br>AR_utilities Class:http_post_call() params value:<pre>".print_r($params,true)."</pre>";
  	
  	//log
  	$this->log(array(
  			'mode'=>'http_post_call() method vars',
  			'data'=>' $params array befor post qstring :'.print_r($params,true) ));
  	 
  	
  	$postData = '';  
  	if(is_array($params)){
  		//create name value pairs seperated by &
  		foreach($params as $k => $v){
  			if(!is_array($v)){
  				$postData .= $k . '='.$v.'&';
  			}else{
  				foreach($v as $k1 => $v1){
  					$postData .= $k1 . '='.$v1.'&';
  				}  				
  				
  			}	
  		}
  		rtrim($postData, '&');
  	}
  	
  	//log
  	$this->log(array(
  			'mode'=>'http_post_call() method vars',
  			'data'=>' $params array after post qstring :'.print_r($postData,true) ));
  	  	
  	$ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
  	curl_setopt($ch,CURLOPT_HEADER, 1);
  	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);	
  	curl_setopt($ch, CURLOPT_HEADERFUNCTION,array(&$this, "HandleHeader"));  
  	curl_setopt($ch, CURLOPT_POST, count($postData));
  	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
  	
  	$output = curl_exec($ch);
  	//$header_info = curl_getinfo($ch);

  	//log
  	$this->log(array(
  			'mode'=>'http_post_call() via AR_Utilities',
  			'data'=>' URL : '.$url.' post vars: '.print_r($postData,true) ));
  	 
  	
  	curl_close($ch);
  	  	
  	if($debug)$this->progress .= "<br>AR_utilities Class:http_post_call() output :<pre>".$output."</pre>";
  	//var_dump($this->header_response);
  	return $this->header_response;
  	  
  }//end of function
  
   
  /**
   * Function HandleHeader()
   *
   * This function is here to process curl response header and to capture header message part
   * 
   * @param string $curl - URL to be called as get 
   * @param string $header - Header message   
   * @return  void
   * @access  private
   * @since 1.2.0 
   */
  private function HandleHeader( $curl, $header ) {
  
  	$pos = strpos($header,'HTTP/');
  	if($pos !== false){
  		$header = str_replace('HTTP/1.1','',$header);
  		$this->header_response = $header;
  	}  	
  }//end of function

  
  /**
   * Function header_output()
   * 
   * This function produces header outputs when executed and stops
   * 
   * @param $code numeric - header code
   * @param $msg string - String which you wanted to pass on
   * @return  Prints header message
   * @access  public
   * @since 1.2.0  
   * 
   */
  public function header_output($code,$msg){

  	header("HTTP/1.1 $code $msg");
  	exit;
  	
  }//end of function
  
  
  
  /**
   * Function show_progress()
   * 
   * This function shows debug information when executed
   *
   * @return  Prints debug info
   * @access  public
   * @since 1.2.0 
   * @return void
   */
  public function show_progress(){
  	
  	return $this->progress;
  }
  
  
  
  /**
   * Function get_related_ar_links()
   * 
   * This function will call AR with $calling_app_id and $calling_app_function_id with optional debug to fetch all
   * related AR entries from AIR. Which then return as an associative array.
   *   
   * @param number $calling_app_id
   * @param number $calling_app_function_id
   * @param string $debug
   * @access  public
   * @since 1.2.0 
   * @return array $ar_data_array
   */
  public function get_related_ar_links($calling_app_id=0,$calling_app_function_id=0,$debug=false){
  	  	
  	$url = AR_URL."get_related_links/$calling_app_id/$calling_app_function_id";
  	
  	if($debug)$this->progress .= "<br>AR_utilities Class:get_related_ar_links() - URL:".$url;  	 
  	$AR_response_json = file_get_contents($url);
  	if($debug)$this->progress .= "<br>AR_Utilities/get_related_ar_links()- AR_response:$AR_response_json";
	$ar_data_array = json_decode($AR_response_json, true);
	
	return $ar_data_array;
	
  }//end of function
  
  
  /**
   * Function log()
   * 
   * This funcion logs actions which are passed throug as a parameter array
   * 
   * @param array $data  - array('data'=>'data','mode'=>'mode')
   * @access  private
   * @since 1.2.0
   */
  private function log($data){
  	
  	@session_start();
  	//check if log object class is present
  	if (class_exists('Log_Object')) {
  	  	
	  	$log_create = new log_object();
	  	$log_create->set_userDetails($_SESSION['user_name'], $_SESSION["user_type"]);
	  	$log_create->set_otherDetails(
	  			array(
	  					'Mode'=>$data['mode'],
	  					'Data'=>$data['data']  					
	  				)
	  			);
	  	$log_create->init();
  	}else{
  		$username = (isset($_SESSION['user_name']))?$_SESSION['user_name']:'AIR calling app';
  		$usertype = (isset($_SESSION["user_type"]))?$_SESSION["user_type"]:'AIR user ';
  		$message = 'Username :'.$username.' - User type: '.$usertype.' - '.$data['mode'].' - '.$data['data'];
  		if (function_exists('log_message')){
  			log_message('info',$message);
 	 	}else{
 	 		error_log($message, 0);
  		}
  	}
  	
  }//end of function 
  
}//end of class                                               
/* End of file AR_Utilities.php */
