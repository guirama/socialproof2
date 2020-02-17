<?php
		
		/**
		 * ******************************************************************
		 *
		 * BizyCorp/Ekwa Internal development Team
		 *
		 * @category   BizyOffice
		 * @package    CommonObjects -Manually Developed LogObject
		 * @author     Nuwan Wickramarathne
		 *
		 * ******************************************************************
		 *
		 */
		
		/**
		 * ******************************************************************************
		 *	@package    CommonObjects -Manually Developed LogObject
		 *	
		 *	This object writes an access log entry 
		 *	
		 *	 
		 *  Creation date     :- Jan 03, 2014
		 *  Last Modified on  :- 
		 *  Last Modification :- 
		 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_object{
	protected $serverDetails = array(
		'Referer' => 'HTTP_REFERER,-',
		'Gateway'=>'REMOTE_ADDR,-', 
		'Server port'=>'SERVER_PORT,80', 
		'Remote port'=>'REMOTE_PORT,-',
		'Server name'=>'SERVER_NAME,-',
		'Request method'=>'REQUEST_METHOD,GET',
		'Request uri'=>'REQUEST_URI, ',
		'User agent'=>'HTTP_USER_AGENT, '
	);
	protected $otherDetails='';
	protected $date = '';
	protected $serverData = '';
	protected $user_name = '';
	protected $memtype = '';
	protected $save_path='./application/logs/access';
	protected $disabled = false;
	
	function __construct(){
		
		date_default_timezone_set('UTC');
		$this->date = date('Y-m-d H:i:s e');
	}//end of construct
	
	//set methodes
	/**
	 * set_serverDetails function
	 * This is a public function. To set details need to get from server to add in to log file
	 * @param multiarray $serverDetails
	 */
	public function set_serverDetails($serverDetails){
		$this->serverDetails=$serverDetails;
	}
	
	/**
	 * set_otherDetails function
	 * This is a public function. To set other Details need to add in to log file
	 * @param multiarray $otherDetails
	 */
	public function set_otherDetails($otherDetails){
		$this->otherDetails=$otherDetails;
	}
	
	/**
	 * set_userDetails
	 * To set user id and user Type.
	 * @param string $useId
	 * @param string $useType
	 */
	public function set_userDetails($userName='', $userType=''){
		$this->user_name= ($userName!='')?$userName:'-';
		$this->memtype = ($userType!='')?$userType:'-';
	}
	
	/**
	 * set_path function
	 * This is a public function to set access log file path.
	*/
	public function set_path($path=''){
		$this->save_path = $path;
	}
	
	/**
	 * set_disabled function
	 * This is a public function. To set log object disabling
	 * @param string $dis
	 */
	public function set_disable($dis){
		$this->disabled = $dis;
	}
	
	/**
	 * getIP function
	 * This is a private function to get client ip address.
	 */
	private function getIP() { 
		if (getenv("HTTP_CLIENT_IP")) 
			$ip = getenv("HTTP_CLIENT_IP");
		else if (getenv("HTTP_X_FORWARDED_FOR")) 
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		else if (getenv("REMOTE_ADDR")) 
			$ip = getenv("REMOTE_ADDR");
		else 
			$ip = "UNKNOWN";
			
		return $ip;
	}
	
	/**
	 * get_variable function
	 * This is a private function to get more server and client details.
	 */
	private function get_variable() {
		$data = array();
		foreach ($this->serverDetails as $keyName=>$value){
			$data = explode(",",$value);
			$this->serverData[$keyName] = getenv($data[0])? getenv($data[0]):$data[1];
		}		
	    unset($data);
	}
	
	/**
	 * init function
	 * This is a public function. This to initialized log
	 */
	public function init(){
		if($this->disabled == false){
			$rowId 	= "'".microtime()."'";
			
			$errorLog="
				<row id=$rowId>/n
	 	 			<cell fieldName='Date Created'><![CDATA[".$this->date."]]></cell>/n
	  				<cell fieldName='User id'><![CDATA[".$this->user_name."]]></cell>/n
	  				<cell fieldName='Member type'><![CDATA[".$this->memtype."]]></cell>/n
	 	 			<cell fieldName='IP address'><![CDATA[".$this->getIP()."]]></cell>/n";
			
			if(isset($this->serverDetails)){
				$this->get_variable();
				foreach ($this->serverData as $key=>$values){
					$errorLog .= "<cell fieldName='".$key."'><![CDATA[".$values."]]></cell>/n";
				}
			}
			
			if(is_array($this->otherDetails)){
				foreach ($this->otherDetails as $key=>$values){
					if(is_array($values))
						$values = serialize($values);
						
					$errorLog .= "<cell fieldName='".$key."'><![CDATA[".$values."]]></cell>/n";
				}
			}
			$errorLog.='</row>/n';
			
			if (!file_exists($this->save_path.'/AL-'.date('Y-m-d').'.xml')){
		    	write_file($this->save_path.'/AL-'.date('Y-m-d').'.xml',null);
		  	}
		  	$logfile 	= get_filenames($this->save_path,true);
	  		$logfile 	= str_replace('\\','/',$logfile[0]);
	  		$logfile 	= substr($logfile,0,strripos($logfile,'/'));
	  		$logfile .= '/AL-'. date('Y-m-d').'.xml' ;
	  				
	 	 	error_log($errorLog,3,$logfile);
		}
	}
	
	/**
	 * get_xml function
	 * This is a public function. This out XML file for DHTML grid 
	 * @param strign $logDate
	 * @param array $widths
	 * @param array $collist
	 * @return string :- XML output
	 */
	public function get_xml($logDate, $widths, $collist){
		ob_start();
  		echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
  			echo "<rows>\n"; 
     			echo "<head>\n";
     			
     			if(isset($collist)){
     				foreach ($collist as $key){
     					echo "
     						<column type='ro' align='center' sort='str' width='".$widths[$key]."'>
     							&lt;div style='text-align:center;' &gt;".$key."&lt;/div&gt;
     						</column>\n
     					";
     				}
     			}
     			
     			else{
      				echo "<column type='ro' align='center' sort='str' width='150'>&lt;div style='text-align:center;'&gt;Date Created&lt;/div&gt;</column>\n" ;
      				echo "<column type='ro' align='center' sort='str' width='100'>&lt;div style='text-align:center;'&gt;User Name&lt;/div&gt;</column>\n" ;
      				echo "<column type='ro' align='center' sort='str' width='100'>&lt;div style='text-align:center;'&gt;Member type&lt;/div&gt;</column>\n" ;
      				echo "<column type='ro' align='center' sort='str' width='100'>&lt;div style='text-align:center;'&gt;IP address&lt;/div&gt;</column>\n" ;
      				
      				if(isset($this->serverDetails)){
						$this->get_variable();
      					foreach($this->serverData as $key=>$value){
							echo "<column type='ro' align='center' sort='str' width='100'>&lt;div style='text-align:center;'&gt;".$key."&lt;/div&gt;</column>\n" ;
						}
      				}

					if(is_array($this->otherDetails)){
						foreach($this->otherDetails as $key=>$value){
							echo "<column type='ro' align='center' sort='str' width='100'>&lt;div style='text-align:center;'&gt;".$key."&lt;/div&gt;</column>\n" ;
						}
					}
     			}
    			echo "</head>\n";
    			
    	if ($logDate){
    		include($this->save_path.'/AL-'.$logDate.'.xml');
    	}
    	else{
      		include($this->save_path.'/AL-'.date('Y-m-d').'.xml');
    	}
    	
    	echo "</rows>";
  		$xmldata = ob_get_clean();
  		return $xmldata;
	}
}
?>
