<?php 
		/**
		 * This is bugs_reporter_model class file
		 *
		 * @package    HOF\models\bugs_reporter_model
		 * @version    1.0
		 * @copyright  2020, BizyCorp Internal Systems Development
		 * @license    private, All rights reserved
		 * @author     CIGen (Automated CI Code Generator)
		 */
		if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		/**
		 * This is bugs_reporter_model developed to maintain reporting bugs to bugzilla 
		 * 
		 * Methods available
		 * 
		 *			function __construct() - constructor
		 *			function exists() - Checks for existing id
		 *			function getArray() - prepares record data
		 *			function getHeader() - Gets table column as header
		 *			function get_data() - Gets record data from table
		 *			function set_query() - Sets query to execute by get_data()
		 *			function count_data() - Counts record set
		 *			function save() - Saves submitted data
		 *			function delete() - Delets records
		 *			function get_product_details() - get the product details
		 *			function add_comment() - Add comments to table
		 *			function get_comments() - Gets comments from the table
		 *			function add_attachment() - Adds the attachmnets 
		 *			
		 *
		 * @package    HOF\models\bugs_reporter_model
		 * @author     Mohamed Ruzaik Mohamed Roshan <roshan@ekwa.com>
		 * @version    1.0
		 * @copyright  2020, BizyCorp Internal Systems Development
		 * @license    private, All rights reserved
		 * @uses
		 * @see
		 * @created   Jan 29, 2020
		 * @modified  Jan 29, 2020	 
		 * @modification 	
		 */
class Bugs_Reporter_model extends CI_Model{
	/**
	 * $metadata_array()
	 * @var array $metadata_array()
	 */
	protected $metadata_array = array();
	
	/**
	 * $bug_reporter
	 * @var $bug_reporter
	 */
	protected $bug_reporter = null;
	
	/**
	 * $product
	 * @var $product , the application Name on Bugzilla
	 */
	public $product =  'HOF';	
	
	/**
	 * $username
	 * @var $username
	 */
	public $username = '';
	
	/**
	 * $password()
	 * @var $password
	 */
	public $password = '';
	
		/**
		 * Function __construct ()
		 * 
		 * Meta Information will be generated at the class initialization
		 * 
		 * @param	None
		 * @return	void
	 	 * @access	
	 	 * @since	1.0
		 */
	function __construct(){
		
		parent::__construct();
		
		$this->load->library('BugReporter');
		$this->getLoginInfor();
		$this->bug_reporter = new BugReporter($this->product,$this->username,$this->password);
		$this->bug_reporter->init();
		
		/**
		 * @$metadata_array - stores the added field comments,type and lenght of all 
		 * the required fields for the model
		 */
		$this->metadata_array['PK'] = 'id';		
				
	}//end of function
	
	/**
	 * Function getLoginInfor()
	 *
	 * This function reads the xml file and set the login details
	 *
	 * @param none
	 * @return
	 * @access
	 * @since	1.0
	 */
	function getLoginInfor(){
	
		$xmlfile = "http://www.bizydads.com/frameworks/bugzillauser.xml";
		$xml = new DOMDocument("1.0","UTF-8");
		$xml->load($xmlfile);
		$xpath = new DOMXPATH($xml);
	
	
		foreach($xpath->query("//row[@id='1']/cell[@fieldName='user_name']") as $node){
			$this->username=$node->nodeValue;
	
		}
	
		foreach($xpath->query("//row[@id='1']/cell[@fieldName='password']") as $node){
			$this->password=$node->nodeValue;
	
		}
		 
	
	}		
		/**
		 * Function exists() 
		 *
		 * Checks whether given entity exists in the table or not
		 *
		 * @param $primekey is an array of key field and value, starting index of dataset, useful for pagination etc
		 *		  Ex: Array($field_name=>value);
		 * @return TRUE if exists, FALSE if not
		 * 
		 * @access	
		 * @since	1.0
		 */
	function exists($primekey){
		
		$this->db->from('pb_templates');
		foreach ($primekey as $k=>$v){
			$this->db->where($k,$v);
		}
		$query = $this->db->get();

		return ($query->num_rows()>=1);		
	}
	
		/**
		 * Function getArray() 
		 *
		 * converts database query resultset to an associative array
		 *
		 * @param $result, the database resultset
		 *
		 * @return An associative array of resultset and associate db table field comments
		 *  
		 * @access	private
		 * @since	1.0
		 */
	private function getArray($data){		
		
		$out = array();
		$ix = 1;
				
		foreach($data as $row){
			foreach($row as $k => $v )	{	
				if(is_array($v) !== true && is_object($v) !== true){			
					$out[$ix][$k] = $v ;
				}else if(is_array($v) === true){
					foreach($v as $v1){
						if(is_array($v1)!== true){
							$out[$ix][$k] = $v1.'<br>' ;//TODO
						}
						
					}
					
				}else if(is_object($v) === true){
					$out[$ix][$k] = 'object value' ;
				}					
			}				
			$ix++;
		}		
		return $out;
		
	}//end of function
	
		/**
		 * Function getHeader() 
		 *
		 * returns the header information as an array, 
		 * checks the $data["selction"] to get the column , if selection is not set or empty function will return the header information of the default selection.
		 *
		 * @param $data is a composit array with elements for
		 * 				selection - fields that are to be selected / default *, filter - the conditions for where clause, group by , having and order by
		 * 				Ex: Array(['selection']=>'table_name.field_name1,table_name.field_name2', ['filter']=>array(field_name=>value), ['group_by']=>'field_name1,field_name2', ['having']=>array(filed_name => value) , ['order_by']=>array(filed_name => order));
		 *				['order_by']=>array(filed_name => order) - order is asc/desc
		 *
		 * 			
		 * @return An array of resultset and associate db table field comments
		 * 	
		 * @access	private
		 * @since	1.0
		 */
	private function getHeader($data){		
		
		$out['PK'] = $this->metadata_array['PK'];
		if(!empty($data[1])){
			foreach($data[1] as $k=>$v){
				
				$out[$k]['header']= $k;
				$out[$k]['type']= 'varchar';
				$out[$k]['width']='170';
			}	
		}else{
			$out[1]['header']= 'creator';
			$out[1]['type']= 'varchar';
			$out[1]['width']='170';
		}				
		return $out;
				
	}//end of function
		
		/**
		 * Function get_data()
		 *
		 * gets complete data from the table with the facility of selection and filters.
		 * records can be grouped and ordered
         *  
		 * @param $data is a composit array with elements for 
		 * 				selection - fields that are to be selected / default *, search - the conditions for where clause, group by , having and order by , filter - join filter is an identifier to set the approval filter.
		 * 				Ex: Array(['selection']=>'table_name.field_name1,table_name.field_name2', ['search']=>array(field_name=>value), ['group_by']=>'field_name1,field_name2', ['having']=>array(filed_name => value) , ['order_by']=>array(filed_name => order));
		 *				['order_by']=>array(filed_name => order) - order is asc/desc
		 * 
         * 			$data['search'] is a an associative array
		 * 		    will have the field, value and query method as array object
		 * 			array('search_field' => $field, 'search_text' => $search_text,'query_method'=>$query_method);
		 * 		  	search_field=> table field name
		 * 		  	search_text=> text / id to be searched
		 * 		  	query_method=> equal/like the query method to be used for the search	         
		 *                          
         * 
         * @return All data, as an associative array with use of getArray() function
		 *
		 * if any relationships found the method will have the joint statement.
		 * 
		 * @access	
		 * @since	1.0
	     */
	function get_data($data){	
			
		$out = array();	
		
		if(isset($data['limit']) && $data['limit'] !="" && $data['limit'] !="0"){
			$limt_enabled=true;				
		}else{
			$limt_enabled=false;				
		}		
	  
	  $bugs_list =  $this->bug_reporter->get_all_bugs();	  
	  $result = $this->getArray($bugs_list['bugs']);
	  $total_num_records = count($result);
	  $header=$this->getHeader($result);
	  
	  $out['metadata']=$header;
	  $out['total_rows']= $total_num_records;
	  $out['result_set'] = $result;
	  $out['limit'] = (isset($data['limit']))?$data['limit']:0;
	  $out['offset'] = (isset($data['offset']))?$data['offset']:0;
	  
      return $out;     
  	  
	}//end of function

		/**
		 * Function save()
		 *
		 * Insert data as a new record, 
		 *  
		 * @param $data_array associative array of data 
		 * 		  Ex: $data_array=>Array(field_name=>value)
		 * @param $key an array of key field names and values
		 * 		  Ex: $key=>Array(field_name=>value)
		 * 				
		 *
		 * @return status of Query execution , TRUE if successful, otherwise FALSE
		 * 	
		 * @access	
		 * @since	1.0
		 */
	function save($data){		
		
		$this->bug_reporter = new BugzillaXML("Bug.create");
		
		$paramArr["product"] = $this->product;
		$paramArr["component"] = $data['component'];
		$paramArr["summary"] = $data['summary'];
		$paramArr["version"] = $data['version'];
		$paramArr['bug_severity']=$data['bug_severity'];
		$paramArr['op_sys'] = $data['op_sys'];
		$paramArr["rep_platform"] = $data['rep_platform'];		
		$comment = $data['description'];
			
		foreach ($paramArr as $k => $v) {
			if ($k == 'ids' || $k == 'limit') {
				$type = 'int';
			} else if ($k == "description") {
				$type = "special";
			} else {
				$type = 'string';
			}
			$this->bug_reporter->addMember($k, $v, $type);
		}
		$return = $this->bug_reporter->submit(true);
		
		//once the bug is added save comment seperatly as per the bugzilla doc
		if(!empty($return['id'])){
			$comment_return = $this->add_comment($return['id'],$comment);
			if(empty($comment_return['id'])){
				return $comment_return;
			}
			
			if(!empty($_FILES['attachment']['name'])){
				$bug_arr = array('id'=>$return['id'],'summary'=>$data['summary']);
				$attachment_return = $this->add_attachment($bug_arr,$_FILES);
			}	
		}		
		return $return;		

	}//end of save
	
	

		/**
		 * Function delete()
		 * 
		 * Delete record(s)
		 * This function will work ie: the delete will be executed 
		 * only when the user identification is present.
		 *  
		 * @param $pk an array of data PK values of the relevant record
		 * 				array($pk=>$value);
		 * 				(field_name=>value)
		 * 				
		 * @return status of Query execution , TRUE if successful, otherwise FALSE
		 * 
		 * @access	
		 * @since	1.0
		 */	
	function delete($pks){	
		
		$this->db->where($pks);
		$this->db->delete('pb_templates');
		return $this->db->affected_rows();
		
 	}//end of function
 	
		/**
 		 * Function getMetadata()
 		 * 
 		 * This function will retun the Metadata array for the use of the controller
 		 * a any other purpose
 		 * USAGE ;- $antvar = getMetadata();
 		 * 
 		 * @param	None
		 * @return	true/false
		 * @access	public
		 * @since	1.0
 		 */	 	
    public function getMetadata() {
  	    
    	If (isset($this->metadata_array)) {
      		return $this->metadata_array;
    	}else {
     	 return false;
    	}
     }//end of function
  
     /**
      * Function get_product_details()
      *
      * This function will retun the product details
      *
      *
      * @param	None
      * @return	product details
      * @access	
      * @since	1.0
      */
     function get_product_details(){
     	$product_details = $this->bug_reporter->get_product_details();
     	return $product_details;
     }
     
     /**
      * Function add_comment()
      *
      * This function will retun the product details
      *
      *
      * @param	$bug_id
      * @param  $comment
      * @return	
      * @access
      * @since	1.0
      */
     function add_comment($bug_id,$comment){
     
     	$bugzilla = new BugzillaXML("Bug.add_comment");
     	$paramArr["comment"] = $comment;
     	$paramArr["id"] = $bug_id;
     
     
     	foreach ($paramArr as $k => $v) {
     		if ($k == 'ids' || $k == 'limit') {
     			$type = 'int';
     		} else if ($k == "description") {
     			$type = "special";
     		} else {
     			$type = 'string';
     		}
     		$bugzilla->addMember($k, $v, $type);
     	}//end foreach
     
     	//Then submit
     	$return = $bugzilla->submit(true);
     	return $return;
     		
     }
 
     /**
      * Function get_comments()
      *
      * This function will retun the product details
      *
      *
      * @param	None
      * @return
      * @access
      * @since	1.0
      */
     public function get_comments(){
     	$bugs_list =  $this->bug_reporter->get_comments();
     }
     
     /**
      * Function add_attachment()
      *
      * This function will retun the product details
      *
      *
      * @param	$bug_arr
      * @param  $attachment_arr
      * @return
      * @access
      * @since	1.0
      */
     function add_attachment($bug_arr,$attachment_arr){
     
     	$bugzilla = new BugzillaXML("Bug.add_attachment");
     
     	$paramArr["ids"] = $bug_arr['id'];
     	$paramArr["summary"] = $bug_arr["summary"];
     	$paramArr["file_name"] = $attachment_arr["attachment"]['name'];
     	$paramArr["content_type"] = $attachment_arr["attachment"]['type'];
     
     
     	//Now the members are added dynamically so as to remove repetition
     	foreach ($paramArr as $k => $v) {
     		if ($k == 'ids' || $k == 'limit') {
     			$type = 'int';
     		} else if ($k == "description") {
     			$type = "special";
     		} else {
     			$type = 'string';
     		}
     		$bugzilla->addMember($k, $v, $type);
     	}
     
     	$tempName = $attachment_arr["attachment"]['tmp_name'];
     	$contents = base64_encode(file_get_contents($tempName));
     
     	if ($attachment_arr['attachment']['error'] != UPLOAD_ERR_OK) {
     		$ret = json_encode(array("error" => $attachment_arr['attachment']['error']."(See documentation for interpertaion)"));
     	} else if (empty($tempName)) {
     		$ret = json_encode(array("error" => "No file to upload"));
     	} else if ($contents === false) {
     		$ret = json_encode(array("error" => "Couldn't get file contents"));
     	} else {
     		$bugzilla->addMember("data", $contents, "base64");
     		$ret = $bugzilla->submit();
     		header('Content-Type: text/html; charset=iso-8859-1');
     	}
     }//end of function
     
 	
}//end of class
?>
