<?php 
		/**
		 * This is Bug reporter controller file. Which handls all functions related to bugzilla CRUD functions
		 *
		 * @package    HOF\controller\bug_reporter_ctr
		 * @version    1.0
		 * @copyright  2020, BizyCorp Internal Systems Development
		 * @license    private, All rights reserved
		 * @author     Mohamed Ruzaik Mohamed Roshan <roshan@ekwa.com>
		 */
		
		if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		
		/**
		 * This is Bug Reporter controller class. 
		 *
		 *
		 * This class contains the following functions
		 *
		 *  1) function index() , can be used to retrieve data from the table with filteration
		 *	2) function bugs_reporter_wb() 
		 *	3) function add_bug() ,can be used to add
		 *	4) function edit() , used to edit a record
		 *
		 * @package      HOF\controller\bug_reporter_ctr
		 * @version		 1.0
		 * @uses
		 * @see
		 * @copyright	 2020, BizyCorp Internal Systems Development
		 * @license		 private, All rights reserved
		 * @author		 Mohamed Ruzaik Mohamed Roshan <roshan@ekwa.com>
		 * @created    	Jan 29, 2020
		 * @modified   	Jan 29, 2020
		 * @modification
		 */
class Bugs_Reporter_Ctr extends CI_Controller {
	/**
	 * debug identifyer
	 * @var bool
	 */
	var $debug = false;
	
	/**
	 * $bug_reporter
	 * @var $bug_reporter
	 */
	var $bug_reporter = null;
	

	/**
	 * Function __construct
	 *
	 * This is standard constructor function for Bug Reporter controller class
	 *
	 * @param	None
	 * @return	void
	 * @access
	 * @since	1.0
	 */
	function __construct(){
		
		parent::__construct();		
		$this->load->model('Bugs_reporter_model');	
		

	}//end of function
			
		/**
		 * Function index()
		 *
		 * @param $search, Boolean value whether search is enable or not
		 * @param $limit, Limit of record set
		 * @param $offset, Offset of record set
		 * @param $file , view file
		 * @param $format , format of the out put
	     *        
		 * Data from view :
		 * Use $_REQUEST
		 * Filed names are like :  filed_name_querymethod
		 *
		 *	Send to Model : Array of data
		 * @return  the data feed
		 * @access	public
	 	 * @since	1.0
		 */
	function index($search = false ,$limit = 0, $offset = 0 , $file = 'bugs_reporter_index' , $format = ''){
		
		$para_array = array(
				'search'=> '',
				'limit' => 10000,
				'offset'=>0,				
				'order_by'=>array()
		);
		
		$data['dataset'] = $this->Bugs_reporter_model->get_data($para_array);
				
		if($this->debug) $this->output->enable_profiler(TRUE);		 
		$wrapped_data['data'] = $data;
		$wrapped_data['format'] = $format;
		$wrapped_data['searchOn'] = $search;
		$wrapped_data['limit'] = $limit;
		$wrapped_data['offset'] = $offset;
		
		$this->load->view($file,$wrapped_data);
		
	}//end of function
		
		
	/**
	 * Function bug_reporter_wb()
	 * 
	 * This is standard template workbench function to load workbench
	 * @return  
	 * @access	public
	 * @since	1.0
	 */
	public function bugs_reporter_wb(){
		
		$data['reporter'] = 'this is from controller';
		$this->load->view('bugs_reporter_wb',$data);
		
	}//end of function template_wb();
		
	/**
	 * Function add()
	 * 
	 * This function is standard add function for templates
	 * 
	 * @return  
	 * @access	public
	 * @since	1.0
	 */
	public function add_bug(){

		
		$prod = $this->Bugs_reporter_model->get_product_details();
		$data['components'] = $prod['products'][0]['components'];
		$data['versions'] = $prod['products'][0]['versions'];
		$data['msg'] = null;
		$data['savestatus'] = 0;
		
		if(isset($_POST["component"])){			
			
			 //$data['bug_id'] = $_POST["bug_id"]; 
			 //$data['product'] = $_POST["product"];
			 $data['component'] = $_POST["component"];
			 $data['version'] = $_POST["version"];
			 $data['priority'] = $_POST["priority"];
			 $data['summary'] = $_POST["summary"];                                                              
			 $data['bug_severity'] = $_POST["bug_severity"];
			 $data['op_sys'] = $_POST["op_sys"]; 
			 $data['rep_platform'] = $_POST["rep_platform"]; 
			 $data['description'] = $_POST["description"];
			 
			 $return = $this->Bugs_reporter_model->save($data);
			 if(isset($return['id']) || isset($return['ids'])){
			 	$data['msg'] = 'Bug created successfully';
			 	$data['savestatus'] = 1;
			 }else{
			 	if(!is_string($return)){
			 		$data['msg'] = $return["faultString"];
			 	}
			 }			
		}//end if				
		$this->load->view("add_bug_form",$data);
		
	}//end of function
	

}//end of templates
?>
