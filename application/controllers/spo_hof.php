<?php
		/**
		 * This controller facilitates the access of table spo_hof
		 *
		 * @package    HOF\controller\spo_hof
		 * @version    1.0
		 * @copyright  2020, BizyCorp Internal Systems Development
		 * @license    private, All rights reserved
		 * @author     CIGen (Automated CI Code Generator)
		 */
		
		if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		
		/**
		 * This file contains CI controller for CI Code Generation
		 * 
		 * 
		 * This class contains the following functions
		 *
		 *  1) function index() , can be used to retrieve data from the table with filteration
		 *	2) function save() , can be used to add / update data
		 *	3) function key_validate() , used to validate the primary key of the table
		 *	4) function delete() , used to delete a record
		 *	5) function loadForm(), used to load the forms
		 *	6) public function createDropdown(), generates the dropdown
		 *	7) function loadWB(), initiates the workbench
		 *
		 * @package      HOF\controller\spo_hof
		 * @version		 1.0
		 * @uses			
		 * @see				
		 * @copyright	 2020, BizyCorp Internal Systems Development
		 * @license		 private, All rights reserved
		 * @author		 CIGen (Automated CI Code Generator)
		 * @created    	Jan 29, 2020
		 * @modified   	Jan 29, 2020
		 * @modification 
		 */
class Spo_hof extends CI_Controller
{
	
	/**
	 * AIR related vars
	 * $AIR_call_flag
	 * @var $AIR_call_flag
	 */
	private $AIR_call_flag 	= false;
	
	/**
	 * AIR related vars
	 * debug
	 * @var $debug
	 */
	private $debug 			= true;  
	
	/**
	 * AIR related vars
	 * AR_Utilities
	 * @var $AR_Utilities
	 */
	private $AR_Utilities 	= null;

	/**
	 * Common vars
	 * User Name
	 * @var $user_name
	 */
	private $user_name='';	
	
	/**
	 * Common vars
	 * User Type
	 * @var $user_type
	 */
	private $user_type='';
	
	/**
	 * Common vars
	 * Log Object instance
	 * @var $log_create
	 */
	private $log_create='';
	
	/**
	 * Function __construct
	 *
	 * The constructor function
	 * 
	 * @param	None
	 * @return	void
	 * @access	
	 * @since	1.0
	 */
 
    function __construct()
	{

        	parent::__construct();
        	
        	if($_SESSION){
        	
        		$this->user_name=$_SESSION["user_name"];
        		$this->user_type=$_SESSION["user_type"];
        	}else{
        		$this->user_name='';
        		$this->user_type='';
        	}

       	    $this->log_create = new log_object();
        	$this->log_create->set_disable($this->config->item('log_status'));
        	$this->log_create->set_userDetails($this->user_name, $this->user_type);
        	        	
	       	// Load AIR Lib to chek and configure settings/views if its an AIR related call        	        	
        	$this->load->library('AR_Utilities');
        	$this->AR_Utilities = new AR_Utilities("called_app");  // Create AIR obj to act as called app
        	if($this->AR_Utilities->validityStatus['validity'] == 'VALID'){
        		$this->AIR_call_flag = true;
        	}
                
            $this->load->model('spo_hof_model');
                           
	}//end of construct__
	
		
	/**
	 * Function set_external_session_vars()
	 *
	 * This method is be executed for extra function definitions to be implemented when AIR token verification
	 * is done.
	 * This function is executed by AIR_Utilities class upon successfull token verification
	 *
	 * @param	None
	 * @return	void
	 * @access	public
	 * @since	1.0
	 */
	
	public function set_external_session_vars(){
	
		// You can specify custome session variables soon after AIR call and token is verified.
		// By default after token verification, necessessary UAACS session vars get initiated inside AR_Utilities class. 
		// This method can be used to initiate additional session vars if needed
		
		// example usage
		// $_SESSION['Test_Session_1'] = 'This is a test session';
		
	
	}//end of set_txternal_session_vars();
	
		
		/**
		 * Function index()
		 *
		 * @param $search, Boolean value whether search is enable or not
		 * @param $limit, Limit of record set
		 * @param $offset, Offset of record set
		 * @param $file , view file
		 * @param $format , format of the out put
		 * @param $collist, to pass the column filter to the view columns are sent as
		 *        col01:col02:...:coln and is pased to view as an array of col names
		 *        (Added by WCD on 31/7/13)
		 * @param $widths to pass the column widths to the view, widths are sent as col1=10:col2=25.... to the controller
		 * 		  controller will pass the width as array to the view
		 * 		  array('col1'=>10,'col2'=>25)
		 * @param $visibilityList, pass the visibility list to the view, list should be sent col1=true:col2=false ... to the controller 
		 * 		  and the contorller will process the param and construct an array as 
		 *        array(col1=>true,col2=>true,col3=>false)) and pass it to the view
	     * @param $cellStyles, pass the cell styles list to the view, list should be sent text-align:center_text-align:center_text-align:left ... to the controller 
	     * 		  and the contorller will process the param and construct an array as 
	     *        array(text-align:center,text-align:center,text-align:center) and pass it to the view
	     *        
		 * Data from view :
		 * Use $_REQUEST
		 * Filed names are like :  filed_name_querymethod
		 *
		 *	Send to Model : Array of data
		 * ex: Array('search' => $searchobj_array,'limit' => $limit,'offset'=>$offset)
		 *
		 * Note : $searchobj_array is a array consist of set of objects.
		 * ex: $searchobj_array = array([0]=>array('search_filed'=>'name','search_text'=>'sara','query_method'=>'like'),[1]=>array('search_filed'=>'country','search_text'=>'srilanka','query_method'=>'equel'))
		 * @return  the data feed
		 * @access	public
	 	 * @since	1.0
		 */
      
	function index($search=FALSE,$limit=0,$offset=0,$file='data_feed_template',$format='',$collist='',$widths='',$visibilityList='',$cellStyles='')
	{	


		$this->log_create->set_otherDetails(array('Mode'=>'view','Data'=>'QUERY- STRING:'.count($_POST)>0?serialize($_POST):serialize($_GET)));
		$this->log_create->init();

            if($search==true){ 
                $searchobj_array = array();              
                foreach((count($_POST)>0?$_POST:$_GET) as $key => $val){ 
				
                     $search_text=$val; //search text 

                     $pos = strrpos($key, '_'); 

                     $query_method = substr($key,$pos+1);  
  
                     $field= substr($key, 0, $pos);

                     //if filed has '.'
                     $field = str_replace('/','.',$field);

                     //log_message('info',"\$field :- $field");

                     $search_obj= array('search_field' => $field, 'search_text' => $search_text,'query_method'=>$query_method);
                     
                     array_push($searchobj_array, $search_obj);  

                }  
                 
                   $data['dataset'] = $this->spo_hof_model->get_data(array('search'=>$searchobj_array,'limit' => $limit,'offset'=>$offset,'order_by'=>array('spo_hof.dfm_id'=>'Asc')));
            }else {
                   $data['dataset'] = $this->spo_hof_model->get_data(array('limit' => $limit,'offset'=>$offset,'order_by'=>array('spo_hof.dfm_id'=>'Asc')));
            }   
       
            $wrapped_data['data'] = $data;
            $wrapped_data['format'] = $format;
            $wrapped_data['searchOn'] = $search;
            
            $wrapped_data['collist'] = $collist ? explode(':',$collist) : array('hof_id','user_id','gmr_id','dfm_id')  ;
            
            if($widths !="0" && $widths !=""){
	            $widthsPara = explode(':',$widths);
	            	 
	            foreach ($widthsPara as $val )   {
	            	$split =  explode('=',$val);
	            	$widths_arr[$split[0]]= $split[1];
	            }
            
            }
            $wrapped_data['widths'] = $widths ? $widths_arr : array('hof_id'=>75,'user_id'=>75,'gmr_id'=>75,'dfm_id'=>75) ;
            
			if($visibilityList !="0" && $visibilityList !=""){
            	$visibilityListPara = explode(':',$visibilityList);
            	 
            	foreach ($visibilityListPara as $val )   {
            		$split =  explode('=',$val);
            		$visibilityList_arr[$split[0]]= $split[1];
            	}
            
            }
		    $wrapped_data['visibilityList'] = $visibilityList ? $visibilityList_arr : array('hof_id'=>true,'user_id'=>true,'gmr_id'=>true,'dfm_id'=>true);
		    
		    if($cellStyles !="0" && $cellStyles !=""){
		    	$stylesListPara = explode('_',$cellStyles);
		    
		    	foreach ($stylesListPara as $val )   {
		    		$stylesList_arr[]= $val;
		    	}
		    
		    }
		    $wrapped_data['cellStyles'] = $cellStyles ? $stylesList_arr : array('text-align:center','text-align:center','text-align:center','text-align:center');
		    
		    //manual pagination related code
		    $wrapped_data['data']['dataset']['limit'] = $limit;
		    $wrapped_data['data']['dataset']['offset'] = $offset;

		    
            //If AIR_call_flag is true which means its an AIR related call/external call=========================
            if($this->AIR_call_flag){
            	
            	// if the function call is from an external app then identify request method then 
            	// choose appropriate output mechanism.
            	
            	if($this->debug) log_message('info',"index() invoked via AIR call: QUERY- STRING :".count($_POST)>0?serialize($_POST):serialize($_GET));
            	
				$wrapped_data['request_method'] = $this->AR_Utilities->request_method;				
				$this->load->view('AIR_output',$wrapped_data);	          	
            
            }else{            		
            	// if the function call is from application itself then proceed with normal output.
            	$this->load->view($file,$wrapped_data);
				
            }//end if air call validator
            
            //End of AIR mechanism ============================================================================== 
		                
	}//end of index method
	
	/**
	 * Function data_form 
	 * 
	 * function handaling form add,edit,delete and view features
	 * 
	 * @param  $data stirng values, key
	 * @param  $mode strign, forms type add, edit, delete, view
	 * @return	
	 * @access	
	 * @since	1.0
	 */
	
	function data_form($mode='add',$data = null){
	

		$this->log_create->set_otherDetails(array('Mode'=>$mode?$mode:'-','Data'=>$_POST?serialize($this->input->post()):($data!=''?$data:'-')));
		$this->log_create->init();
	
		$data2save = array();
		$key2save = array();
		$message = array('msgText'=>'','msgType'=>'','focusField'=>'');
		
		if($mode != 'add'){
		
			$limit=0;
			$offset=0;
		
			$row=$this->spo_hof_model->get_data(array('search'=>array(array('search_field' => 'hof_id', 'search_text' => $data,'query_method'=>'equal')),'limit' => $limit,'offset'=>$offset)) ;
			$w = $row['result_set'][1]; //should we validate if there is records?
			foreach ($w as $c=>$v){ $wrapper[$c] = $v; }
		
		}
		
		if($_POST){
		//$postData = $this->input->post();
			$postData = $_POST;
		
			foreach($postData as $c=>$v){
			if($c!='mode' && $c!='formstatus'){
			$data2save[$c] = $v;
		
			}
			$wrapper[$c] = $v;
			}
			if($this->input->post('hof_id') !=''){
			$key2save = array('hof_id' =>$this->input->post('hof_id'));
			}
		}
		
		switch ($mode){
	
			case "add": //-----------------------------------------------------
				
				//Check duplicates
				if ($this->input->post('dfm_id')) {
					if ($this->spo_hof_model->exists(array('dfm_id' => $this->input->post('dfm_id')))) {
						$message['msgText'] ='Sorry this record already exist!';
						$message['msgType'] ='failure';
						$message['focusField'] ='dfm_id';
					
					}else{
						$msg = $this->spo_hof_model->save($data2save,$key2save);
						if ($msg) {
							$message['msgText'] ='<span style="color:#008000;">Record successfully created!</span>';
							$message['msgType'] ='success';
							$message['gridHandler'] ='updateAndClose';
							
						}else{
							$message['msgText'] =$msg;
							$message['msgType'] ='failure';
							$message['focusField'] ='dfm_id';
								
						}
						
					}
				}

			break;
	
			case "edit":
				
				//Do validations if form submitted based on POST var
				if ($this->input->post('hof_id')) {
	
					//check for prime key existance
					if (!$this->spo_hof_model->exists(array('hof_id' => $this->input->post('hof_id')))) {
					 $message['msgText'] ='Sorry this record does not exist!';
					 $message['msgType'] ='failure';
					 $message['focusField'] ='dfm_id';

					}else{//Valid key
						//checking existance
						if ($this->spo_hof_model->exists(array('dfm_id' => $this->input->post('dfm_id'),'hof_id !=' => $this->input->post('hof_id')))){
							$message['msgText'] ='Sorry this record already exist!';
							$message['msgType'] ='failure';
							$message['focusField'] ='dfm_id';
						
						}else{
							
						    $msg = $this->spo_hof_model->save($data2save,$key2save);
							if ($msg) {
								$message['msgText'] ='<span style="color:#008000;">Record successfully updated!</span>';
								$message['msgType'] ='success';
								$message['gridHandler'] ='updateAndClose';
							}else{
								$message['msgText'] =$msg;
								$message['msgType'] ='failure';
								$message['focusField'] ='dfm_id';
								
							}

							
						}
				 }
				 //end validation & save

				}
				
			break;
					
			case "delete":
				
				//Do validations if form submitted based on POST var
				if ($this->input->post('hof_id')) {
					//check for prime key existance
					if (!$this->spo_hof_model->exists(array('hof_id' => $this->input->post('hof_id')))) {
					 $message['msgText'] ='Sorry this record does not exist!';
					 $message['msgType'] ='failure';
					 $message['focusField'] ='';

					}
				}

			break;
	
			case "view":

			break;
					
		}
		
		$wrapper['message'] = $message;
		$wrapper['mode'] = $mode;
		$this->load->view('spo_hof_form',$wrapper);
	}
	    	
		/**
  		 * Function save()
  		 * 
  		 * Data from View
  		 * using $_REQUEST
  		 * Data to model
  		 * send data as a array
  		 * two arrays. One is for data and one is for key.
  		 * ex: data=array('field1'=>'value1','field2'=>'value2'.....);
  		 *     key=array('staff_id'=>123,'project_id'=>534);
  		 *     
  		 * @param   action - add or edit
  		 * @param   callback - callback fun name for field validation
  		 * @return  bool true/false
  		 * @access	
	 	 * @since	2.0
  		 */
	     
  	function save($action,$callback = null){


  		$save_data=array();
  		$key=array();
  		$metadata = $this->spo_hof_model->getMetadata();
  		$metadata = explode(",",$metadata['PK']);
  		
  		log_message('info','Save data :-'.serialize($_POST));
  		
  		foreach((count($_POST)>0?$_POST:$_GET) as $k => $v){
  		
  			$end = substr(strrchr($k, "_"), 1);
  			if(in_array($k,$metadata) !== false) {
  				$key[$k] = $v;
  			}elseif($end=='skip') {
  				//nothing do with skip
  			}else {
  				$save_data[$k]=$v;
  			}
  		}
  		
  		// AIR call handling mechanism ============================================================================
  			
  		// if AIR_call_flag is true which means its an AIR related call/external call
  		if($this->AIR_call_flag){
  				
  			if($this->debug)log_message('info',"save() invoked: request method:".$this->AR_Utilities->request_method);

  			//** Implement AIR call variable validation as following example code. Use error codes above 520  			
  			/*  			    
  			if(empty($actual_start_date)){
  				$this->AR_Utilities->header_output(520,'Actual Start Date cannot be empty');
  				exit;
  			}else if(empty($actual_end_date)){
  				$this->AR_Utilities->header_output(521,'Actual End Date cannot be empty');
  				exit;
  			}
  			*/  			  			
  			if($this->AR_Utilities->request_method == 'get'){
  				
  				// usually form submissions are made as post. If your form submits as get then use this 
  				// space to echo output as notmal or use a view file whenever appropriate
  			
  			}else if($this->AR_Utilities->request_method == 'post'){  			
  				$added=$this->spo_hof_model->save($save_data,$key);  				
  				$this->log_create->set_otherDetails(array('Mode'=>$action,'AIR call: Data'=>serialize($save_data).", KEY: ".serialize($key)));
  				$this->log_create->init();  				
  				$this->AR_Utilities->header_output(200,$added); // You can customized your success message as you wish  				
  			}	
  			
  			//end if AIR call verifier		
  		}else{  				
  				$added=$this->spo_hof_model->save($save_data,$key);
  				$this->log_create->set_otherDetails(array('Mode'=>$action,'Data'=>serialize($save_data).", KEY: ".serialize($key)));
  				$this->log_create->init();  				
  				//echo $added;  	
  		}
  		//=====================================================================================================================		
  		return $added;
	}//end of save method
	    
	    
		/**
		 * Function key_validate()
		 *
		 * This is to validate the keys which are send based on the action param
		 * key=array('staff_id'=>123,'project_id'=>534,'worktype_id'=>342);
		 *
		 * @param $action , add / edit
		 * @param $key , primary $key can be composit or single
		 *
		 * @return true on success or on valid key , on inexistance or invalid key error will be returned as an array
		 * 		ex: array('primary_key'=>'Doesnt exists','staff_id'=>'Doesnt exists')
		 *
		 * @access
		 * @since	2.0
		 */
	
    function key_validate($action,$key) {
    	   
	    //make overall validation true at the begining
	    $overall_valid=true;
	    $error_info=array();
	    
	    /*check for the primary key or composite key exists. Send key array to check.*/
	    $key_exist=$this->spo_hof_model->exists($key);
		
	    if($key_exist) {
	      if($action=='add') {
	          //if the primary key exists this can not add. so validation fails and add information 
	          //to error info array.
	          $overall_valid=false;
	          $error_info['primary_key']='Record Already exists';
	      }
	      if($action=='edit') {
	          //in edit function the primary key should be there.
	          //to error info array.
	          $overall_valid=true;
	      }
	    }else {
	      if($action=='add') {
	          //if primary key not found it can be added
	          $overall_valid=true;                   
	      }
	      if($action=='edit') {
	          //if primary key not found it can not be edited         
	          $overall_valid=false;
	          $error_info['primary_key']='Record Doesnt exists';
	      }
	    }
	      
	    if($overall_valid==true){
	        return true;
	    }
	    else  {
	        return $error_info; //array('primary_key'=>'Already exists') or
	                            //array('primary_key'=>'Doesnt exists','staff_id'=>'Doesnt exists')  
	    }
    }
 		
		/**
		 * Function delete()
		 * 
		 * Data from View
		 * using $_REQUEST
		 * $_REQUEST['staff_id']=234
		 *
		 * @param $String, the key 
		 *  
		 * Data to model
		 * send a array
		 * ex: $key = array('staff_id'=>123,'project_id'=>245,'worktype_id'=>933)
		 * 
		 * @return 
	     * @access	
	     * @since	2.0
		 */
     
	function delete($String)
	{
		
        $delete=array();
        $pieces = explode("-", $String);
         foreach($pieces as $k => $v) {
            $content = explode(":", $v);
            $delete[$content[0]]=$content[1];
         }	
        

		$this->log_create->set_otherDetails(array('Mode'=>'delete','Data'=>serialize($delete)));
		$this->log_create->init();       		
	
		return($this->spo_hof_model->delete($delete));
	}
 		
  		/**
  		 * Function loadForm()
  		 * 
		 * load the form for creation / edit
		 * 
		 * @param $editable, key, mode info
		 * @param $file , name of the view file
		 * @return 
	     * @access	
	     * @since	2.0
		 */ 

  	function loadForm($editable=null,$file='spo_hof_form') {
  		 		
  		$data['editable'] = $editable;
  		$this->load->view($file,$data);
  	} 
	
		 /**
		  * Function loadWB()
		  * 
		  * function initiates the workbech
		  *
		  * @param $file , name of the view file
		  * @return loads the work bench
	      * @access	
	      * @since	2.0
		  */
		  
 	function loadWB($file='spo_hof_wb'){
  		
 		$data ='';
  		$this->load->view($file,$data);
  		
  	}

  
	    /**
 		 * Function createDropdown()
 		 *
 		 * 
 		 * Function overview :-
 		 * createDropdown is the component function. 
 		 * Its main functionality is to produce a dropdown with pre populated table data
 		 *
 		 * Parameter list :-
 		 *
 		 *   $data['displayClm']     => 'field1'  - preselection of column to be displayed         //sachini
 		 *   $data['selectByValue']  => null      - preselection of list items by value
 		 *   $data['selectBYText']   => null      - preselection of list items by Text
 		 *   $data['filterBy']       => null      - filter data set by a field or list
 		 *   $data['outFormat']      => 'html'    - Format of the output like HTML,XML Etc
 		 *   $data['isMultiple']     => false     - is the drop down with multi select capable
 		 *   $data['sort']           => 'asc'     - sort list text Ascending or Descending
 		 *   $data['optionsOnly']    => false     - Specify the controller that output only <options> values
 		 *   $data['groupBy']        => null      - Display the dropdown grouped according to the specified column        //sachini
 		 *   $data['nameTag']        => 'field2'  - Name and Id values of the select tag                                 //sachini
 		 *
 		 *
 		 *    Usage :-
 		 *
 		 *    1) Format for internal functional call by passing data array
 		 *
 		 *    $data = array('selectByValue' => null,
 		 *					'selectBYText' => null,
 		 *					'outFormat' => 'html' ,
 		 *					'isMultiple' => false,
 		 *					'sort' => 'asc',
 		 *					'optionsOnly' => false,
 		 *					'filterBy' => array(
 		 *									'search_field' => 'T.status',
 		 *									'search_text' => '0',
 		 *									'query_method'=>'equal',
 		 *									'order_by' => 'asc'
 		 *									)
 		 *						)
 		 *
 		 *
 		 *    2) Format of external call by URL
 		 *
 		 *    http://.../index.php/Spo_hof/createDropdown/?sbv=null&sbt=null&format=html&multiple=false&sort=asc&filterby=status_equal=1
 		 *
 		 *
 		 *    1. For normal listing:
 		 *
 		 *    http://.../index.php/Spo_hof/createDropdown
 		 *
 		 *    2. For listing with multiple selection
 		 *
 		 *    http://.../index.php/Spo_hof/createDropdown/?multiple=true
 		 *
 		 *    3. For listing with pre selection (select by value) for single selection drop down
 		 *
 		 *    http://.../index.php/Spo_hof/createDropdown/?sbv=123
 		 *
 		 *    4. For listing with pre selection for multiple (select by value)
 		 *
 		 *    http://.../index.php/Spo_hof/createDropdown/?sbv=123,321,345&multiple=true
 		 *
 		 *    5. For listing with pre selection of select by text for single selection dropdown
 		 *
 		 *     http://.../index.php/Spo_hof/createDropdown/?sbt=test string&multiple=true
 		 *
 		 *    6. For xml(DHTMLX compatible) dropdown
 		 *
 		 *    http://.../index.php/Spo_hof/createDropdown/?format=xml
 		 *
 		 *    7. groupBy
 		 *    http://...../Spo_hof/createDropdown/?groupby=users.user_type
 		 *
 		 *	 8. groupCode
 		 *	  http://..../Spo_hof/createDropdown/?groupby=users.user_type&groupcodes=1=Staff,2=Admin,4=Manager
 		 *
 		 *    Description of parameter list,
 		 *
 		 *    sbv - selectByValue  => null
 		 *    sbt - selectBYText   => null
 		 *    format - outFormat   => 'html'
 		 *    multiple - isMultiple=> false
 		 *    sort - sort          => 'asc'
 		 *    filterby - filterBy  => null
 		 *    optionsOnly - options only listing
 		 *
 		 *    groupBy - column to group, should be specified with the table name ex: spo_hof.staff_id
 		 *
 		 *	  groupcodes - coma seperated values to display as group lable
 		 *
		 * @param $data , data array
		 *  
		 * @access public
		 * @return returns the table dropdown
		 * @since 1.0
 		 */

	public function createDropdown($data = false){
  
	  	$dataset = null;
	  	$selectByValue = null;
	  	$selectBYText = null;
	  	$outFormat = 'html' ;
	  	$isMultiple = null;
	  	$sort = null;
	    $sort_array = array('spo_hof.hof_id' => 'ASC');
	  	$filterBy = null;
	   	$searchobj_array = null;
	   	$optionsOnly = false;
	   	$label = null;
	   	$displayClm = 'spo_hof.dfm_id';
	   	$groupBy = null;   
	   	$groupcodes = null;
	   	$nameTag = 'hof_id'; 
	  	
		  	/**
		  	 *	first check whether the call is internal(ie:internal function call) or external(ie:url call)
		  	 *	to do this we can check $data variable.if this variable is an array it means its an internal call
		  	 *	if $data is 'false' it means its an external call.
		  	 */	
	  		
	  	if(is_array($data)){
	  		
	  		/** 
	  		 * this is an internal call. so construct the search obj with passed array parameeters. 
	  		 * extract the data and pass on to the view
	  		 */
	  		
	  		
	  		$selectByValue = isset($data['selectByValue'])?$data['selectByValue']:null;
	  		$selectBYText = isset($data['selectBYText'])?$data['selectBYText']:null;
	  		$outFormat = isset($data['outFormat'])?$data['outFormat']:null;
	  		$isMultiple = isset($data['isMultiple'])?$data['isMultiple']:false;
	  		$sort = isset($data['sort'])?$data['sort']:'spo_hof.hof_id=ASC';
	  		$filterBy = isset($data['filterBy'])?$data['filterBy']:null;
	  		$optionsOnly = isset($data['optionsOnly'])?$data['optionsOnly']:false;
	  		
	  		$label = isset($data['label'])?$data['label']:'hof_id';
	  		$displayClm = isset($data['display'])?$data['display']:$displayClm;
	  		$groupBy = isset($data['groupBy'])?$data['groupBy']:null;    
	  		$nameTag = isset($data['nameTag'])?$data['nameTag']:'hof_id';    
	  		$groupcodes = isset($data['groupcodes'])?$data['groupcodes']:null;
	  		
	  		
	  	}else{
	  		
	  		/** 
	  		 * this is an external url call. So process $_GET or $_POST parameeter values and using
	  		 * these values construct search obj and fetch data for combo box
	  		 */
	  		if(count($_POST)>0 || count($_GET)>0){
	  			
	        	$myParams = count($_POST)>0? $_POST:$_GET;
	  
	  			$selectByValue = isset($myParams['sbv'])? $myParams['sbv']:null ;		
	  			$selectByValue = (!empty($selectByValue))?$selectByValue:null; // set default values if not supplied.
	  			 		
	  			$selectBYText = isset($myParams['sbt'])?$myParams['sbt']:null;
	  			$selectBYText = (!empty($selectBYText))?$selectBYText:null;
	  			
	  			$outFormat = isset($myParams['format'])?$myParams['format']:null;
	  			$outFormat = ($outFormat != 'html' && !empty($outFormat))?$outFormat:'html';
	  			
	  			$isMultiple = isset($myParams['multiple'])?$myParams['multiple']:null;
	  			$isMultiple = ($isMultiple == 'true')?true:false;
	  			
	  			$sort = isset($myParams['sort'])?$myParams['sort']:'spo_hof.hof_id=ASC';
	  			
	  			
	  			$filterBy_string = isset($myParams['filterby'])? $myParams['filterby']:null;
	  			$filterBy_string = (!empty($filterBy_string))?$filterBy_string:null;
	  			
	  			$optionsOnly = isset($myParams['optionsonly'])? $myParams['optionsonly']:false;
	  			$optionsOnly = ($optionsOnly == 'true')? true:false;
	  
	  			$label = isset($myParams['label'])?$myParams['label']:null;
	  			$label = (!empty($label))?$label:null;
	  			
	  			$displayClm = isset($myParams['display'])? $myParams['display']:$displayClm;
	  			$displayClm = (!empty($displayClm))?$displayClm:'description';
	  			
	  			$groupBy = isset($myParams['groupby'])?$myParams['groupby']:null;    
	  			$groupBy = (!empty($groupBy))?$groupBy:null;                         
	  			
	  			$groupcodes = isset($myParams['groupcodes'])?$myParams['groupcodes']:null;
	  			
	  			
	  			/**
	  			 *	first check whether the request includes grouping
	  			 *	to do this we can check $groupBy variable.if this variable is null then it is ungrouped dropdown
	  			 *	if $groupBy is 'field1' it means its a request for grouped dropdown.
	  			 */
	  			
	  			if($groupBy){
	  				
	  				/**
	  				 * this is a grouped dropdown request
	  				 * set the $sort_array first sorted according to $groupBy column and then to $displayClm
	  				 */
	  				
	  				$sort_array = array($groupBy => 'ASC',$displayClm => 'ASC' );
	  				if (!empty($groupcodes)){
	  			
	  					$sortPara = explode(',',$groupcodes);
	  					 
	  					foreach ($sortPara as $val ){
	  						$split =  explode('=',$val);
	  						$group[$split[0]]= $split[1];
	  						 
	  					}
	  			
	  				}
	  			}else{
	  				
	  				/**
	  				 * this is not a grouped dropdown request
	  				 */
	  				$sort = isset($myParams['sort'])?$myParams['sort']:"$displayClm=ASC";
	  			}
	  			//end of sort allocation condition
	  			
	  			$nameTag = isset($myParams['nametag'])?$myParams['nametag']:$nameTag;   
	  			$nameTag = (!empty($nameTag))?$nameTag:'hof_id';                       
	  			
	  			  	
	  			
	  			if(!empty($filterBy_string)){        
	          		
	  				$fieldPara = explode(',',$filterBy_string);
	          		
	          		foreach ($fieldPara as $val )   {
	             			$split =  explode('=',$val);
	             			$filterBy[$split[0]]= $split[1];
	          			}
	  
	  			}else{
	  				
	  				$filterBy = null;
	  			}
	        
	        if (!empty($sort)){
	             
	          $sortPara = explode(',',$sort);
	          foreach ($sortPara as $val )   {
	             $split =  explode('=',$val);
	             $sort_array[$split[0]]= $split[1];
	          }
	        }
	  			
	  		}
	  	}//end of param check and config
	  
	  	// Construct search object if present 
	  		
	  	If ($filterBy){
	  			
	  		$searchobj_array = array();
	  			
	  		foreach($filterBy as $key => $val){
	  	
	  			$search_text = $val; //search text
	  			$query_method = substr(strrchr($key, "_"), 1);
	  			$pos = strrpos($key, '_');
	  			$field = substr($key, 0, $pos);
	  			$search_obj = array(
	  					'search_field' => $field,
	  					'search_text'  => $search_text,
	  					'query_method' => $query_method
	  			);
	  				
	  			array_push($searchobj_array, $search_obj);
	  		}	
	  	}//end if
	    
	      //Construct selection list. (Fixed)
	      $selection = 'spo_hof.hof_id,spo_hof.user_id,spo_hof.gmr_id,spo_hof.dfm_id';
	    
	      // Fetch data from model
	  	  $dataset = $this->spo_hof_model->get_data(array(
	  			'search' => $searchobj_array,
	  	  		'limit' => 0,
	  	  		'offset'=>0,
	  			'selection' => $selection,
	        		'order_by' => $sort_array));  
	  
	  	
	  	
	  	// Construct data structure for view
	  	$wrapped_data['data']['dataset'] = $dataset;	
	    $wrapped_data['selectByValue'] = $selectByValue;
	  	$wrapped_data['selectByText'] = $selectBYText;
	  	$wrapped_data['outFormat'] = $outFormat;
	  	$wrapped_data['isMultiple'] = $isMultiple;
	  	$wrapped_data['required'] = true;
		$wrapped_data['label'] = $label;
		
		$displayClm =  explode('.',$displayClm);
		$wrapped_data['display'] = $displayClm[1];
		$wrapped_data['nameTag'] = $nameTag;
	  	
	  	if($optionsOnly !=""){
	  		$wrapped_data['optionsOnly'] = $optionsOnly;
	  	}
	  	
	  	if($groupBy != ""){
	  		$gb_arrya=explode(",",$groupBy);
	  		for($x=0;$x<count($gb_arrya); $x++){
	  			$gb = explode(".",$gb_arrya[$x]);
	  			$wrapped_data['groupBy'] = $gb[1];
	  		}    
	  	}
	  	   
	  	if(!empty($group)){
	  		$wrapped_data['codename'] = $group;
	  	}
	  
	  	
	  	//If AIR_call_flag is true which means its an AIR related call/external call=========================
	  	if($this->AIR_call_flag){
	  		 
	  		// if the function call is from an external app then identify request method then
	  		// choose appropriate output mechanism.
	  		 
	  		if($this->debug) log_message(
	  				'info',
	  				"createDropdown invoked via AIR call: QUERY- STRING :".count($_POST)>0?serialize($_POST):serialize($_GET));	  			
	  		//perform the function codes and call view file with output.
	  		if($this->AR_Utilities->request_method == 'get'){	  	
	  			$this->load->view('dropdown_template',$wrapped_data);	  	
	  		}else if($this->AR_Utilities->request_method == 'post'){	  	
	  			//If request method is post then use appropriate view files to output as post
	  			//...	  	
	  		}//end if method verifier	  	
	  	}else{	  	
	  		// if the function call is from application itself then proceed with normal output.	  		
	  		// load view file with assigned data array
	  		$this->load->view('dropdown_template',$wrapped_data);	  		
	  	}//end if air call validator	  	
	  	//End of AIR mechanism ==============================================================================	  	
	  		  		  	
    }// End of Function createDropdown
            

}//-------- END CLASS -------------------------------------------------------

?>
