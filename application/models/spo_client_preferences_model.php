<?php
		/**
		 * This is model developed to maintain table spo_client_preferences
		 *
		 * @package    HOF\models\spo_client_preferences
		 * @version    1.0
		 * @copyright  2020, BizyCorp Internal Systems Development
		 * @license    private, All rights reserved
		 * @author     CIGen (Automated CI Code Generator)
		 */
		
		if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		
		/**
		 * This is model developed to maintain table spo_client_preferences
		 *
		 *
		 * Functions available
		 * 		1) function exists()
		 * 		2) function exists_column()
		 * 		3) private function getArray()
		 * 		4) private function getHeader()
		 * 		5) function get_data()
		 * 		6) function set_query()
		 * 		7) function count_data()
		 * 		8) function save()
		 * 		9) function delete()
		 * 	   10) public function getMetadata()
		 *
		 *  @package    HOF\models\spo_client_preferences
		 *  @version    1.0
		 *  @copyright  2020, BizyCorp Internal Systems Development
		 *  @license    private, All rights reserved
		 *  @author     CIGen (Automated CI Code Generator)
		 *  @uses
		 *  @see
		 *  @created   Jan 29, 2020
		 *  @modified  Jan 29, 2020	 
		 *  @modification 	 
		 */
class  Spo_client_preferences_model extends CI_Model
{
	/**
	 * meta-discription array
	 * @var $metadataArray
	 */
	protected $metadata_array = array();
		
		
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
	
	function __construct()
	{

		parent::__construct();
		
		/**
		 * @$metadata_array - stores the added field comments,type and lenght of all the required fields for the model
		 */
		
		
$this->metadata_array['PK']= 'pref_id';

$this->metadata_array['pref_id']['header']= '';

$this->metadata_array['pref_id']['type']= 'int';

$this->metadata_array['pref_id']['width']='11';

$this->metadata_array['client_id']['header']= '';

$this->metadata_array['client_id']['type']= 'int';

$this->metadata_array['client_id']['width']='11';

$this->metadata_array['so_review_st']['header']= '';

$this->metadata_array['so_review_st']['type']= 'tinyint';

$this->metadata_array['so_review_st']['width']='1';

$this->metadata_array['my_so_reviews']['header']= '';

$this->metadata_array['my_so_reviews']['type']= 'tinyint';

$this->metadata_array['my_so_reviews']['width']='1';

$this->metadata_array['appointments']['header']= '';

$this->metadata_array['appointments']['type']= 'tinyint';

$this->metadata_array['appointments']['width']='1';

$this->metadata_array['calls']['header']= '';

$this->metadata_array['calls']['type']= 'tinyint';

$this->metadata_array['calls']['width']='1';

$this->metadata_array['other_proofs']['header']= '';

$this->metadata_array['other_proofs']['type']= 'tinyint';

$this->metadata_array['other_proofs']['width']='1';

$this->metadata_array['bg_color']['header']= '';

$this->metadata_array['bg_color']['type']= 'varchar';

$this->metadata_array['bg_color']['width']='255';

$this->metadata_array['color']['header']= '';

$this->metadata_array['color']['type']= 'varchar';

$this->metadata_array['color']['width']='255';

		
		$metadata = $this->db->field_data('spo_client_preferences') ;
		
		foreach($metadata as $column){
			if($column->primary_key==1 && !isset($this->metadata_array['PK'])){
				$this->metadata_array['PK'] = $column->name;

			}
		if (!isset($this->metadata_array[$column->name])) {
				$this->metadata_array[$column->name]['header'] = $column->long_name ? $column->long_name : $column->name ;
				$this->metadata_array[$column->name]['type'] = $column->type ;
				$this->metadata_array[$column->name]['width'] = $column->max_length ;
		}
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
		
	function exists($primekey)
	{
		$this->db->from('spo_client_preferences');
		foreach ($primekey as $k=>$v){
			$this->db->where($k,$v);
		}
		$query = $this->db->get();

		return $query->num_rows();
	}
	
		/**
		 * Function exists_column()
		 *
		 * Checks whether given column exists in the table or not
		 *
		 * @param $column is a single value
		 *		  Ex: $column = "field1";
		 * @return TRUE if exists, FALSE if not
		 *
		 * @access	
		 * @since	1.0
		 */
	
	function exists_column($column){
		return $this->db->field_exists($column,'spo_client_preferences');
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
		
	private function getArray($data)
	{
		
		$out = array();
		$ix = 1;

		foreach($data as $k)
		{
		
			foreach($k as $f => $v) {   
	            
	            $out[$ix][$f]=  $v;
	         }

			$ix++;
        }
		
		return $out;
	}
			
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
		
		$selection =  isset($data['selection'])? $data['selection']: 'spo_client_preferences.pref_id,spo_client_preferences.client_id,spo_client_preferences.so_review_st,spo_client_preferences.my_so_reviews,spo_client_preferences.appointments,spo_client_preferences.calls,spo_client_preferences.other_proofs,spo_client_preferences.bg_color,spo_client_preferences.color' ;
		$selection_array= array();
		
		$selection_array=explode(",",$selection);
		$out['PK']=$this->metadata_array['PK'];
		foreach($selection_array as $t_field){
			
			$field=explode(".",$t_field);
			if($field[1] =='*'){
			$out=$this->metadata_array;
			break;
			}else{
			$out[$field[1]]['header']=$this->metadata_array[$field[1]]['header'];
			$out[$field[1]]['type']=$this->metadata_array[$field[1]]['type'];
			$out[$field[1]]['width']=$this->metadata_array[$field[1]]['width'];
			}
			
		}
		
		return $out;
	}
		
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
	 
	  	$header=$this->getHeader($data);
	  	$total_num_records = $this->count_data($data);
		
	  	$this->set_query($data,$limt_enabled);
	  	
      	$query = $this->db->get();
      	
	  	//log_message('info', "\$out :-".serialize($data));
      	
      	$result = $this->getArray($query->result());
	  	log_message('info',"SQL :-".$this->db->last_query());
     	
      	$out['metadata']=$header;
      	$out['total_rows']= $total_num_records;
      	$out['result_set'] = $result;
      	
      	//for pagination 
      	$out['limit'] = $data['limit'];
      	$out['offset'] = $data['offset'];
	  	
      	//log_message('info', "\$out :-".serialize($out));
      	return $out;
	}
			
		/**
		 * Function set_query()
		 *
		 * sets the query to get data, get the count from the staff table with the facility of selection and filters.
		 * records can be grouped and ordered
		 *
		 *
		 * @param $data is a composit array with elements for
		 * 				selection - fields that are to be selected / default *, filter - the conditions for where clause, group by , having and order by
		 * 				Ex: Array(['selection']=>'table_name.field_name1,table_name.field_name2', ['filter']=>array(field_name=>value), ['group_by']=>'field_name1,field_name2', ['having']=>array(filed_name => value) , ['order_by']=>array(filed_name => order));
		 *				['order_by']=>array(filed_name => order) - order is asc/desc
		 *
		 * 			$data['search'] is a an associative array
		 * 		    will have the field, value and query method as array object
		 * 			array('search_field' => $field, 'search_text' => $search_text,'query_method'=>$query_method);
		 * 		  	search_field=> table field name
		 * 		  	search_text=> text / id to be searched
		 * 		  	query_method=> equal/like the query method to be used for the search
		 *
		 * @param $limit_enable is a flag to determine if the query should be set with a limit or without a limit
		 * 
		 * @return	
		 * @access	
		 * @since	1.0
		 */
	
	function set_query($data,$limit_enable){
		
		$search_filter="";
		$data['selection'] =  isset($data['selection'])? $data['selection']: 'spo_client_preferences.pref_id,spo_client_preferences.client_id,spo_client_preferences.so_review_st,spo_client_preferences.my_so_reviews,spo_client_preferences.appointments,spo_client_preferences.calls,spo_client_preferences.other_proofs,spo_client_preferences.bg_color,spo_client_preferences.color';

		$data['search'] = isset($data['search'])  ? $data['search'] : $search_filter ;

		$this->db->from('spo_client_preferences');
		

		
		if ($data['selection']) {
			
			$this->db->select($data['selection']); // TODO check and implement
		}
		
		if(isset($data['search'])&& $data['search']!=null) {
			//log_message('info',"search :-".serialize($data['search']));
			foreach($data['search'] as $s)
			{
                
				if($s['query_method'] == "equal" && $s["search_text"] !=""){
					$this->db->where($s["search_field"],$s["search_text"]);
				}elseif($s['query_method'] == "equal" && $s["search_text"] ==""){
					$this->db->where($s["search_field"]);
				}elseif($s['query_method'] == "orwhere"){
					$this->db->or_where($s["search_field"],$s["search_text"]);
				}elseif ($s['query_method'] == "like"){
					$this->db->like($s["search_field"],$s["search_text"]);
				}elseif($s['query_method'] == "orlike"){
					$this->db->or_like($s["search_field"],$s["search_text"]);
				}elseif($s['query_method'] == "notlike"){
					$this->db->not_like($s["search_field"],$s["search_text"]);
				}elseif($s['query_method'] == "gt"){
					$this->db->where($s["search_field"]." >",$s["search_text"]);
				}elseif($s['query_method'] == "lt"){
					$this->db->where($s["search_field"]." <",$s["search_text"]);
				}elseif($s['query_method'] == "gtequal"){
					$this->db->where($s["search_field"]." >=",$s["search_text"]);
				}elseif($s['query_method'] == "ltequal"){
					$this->db->where($s["search_field"]." <=",$s["search_text"]);
				}elseif($s['query_method'] == "gtorequal"){
					$this->db->or_where($s["search_field"]." >=",$s["search_text"]);
				}elseif($s['query_method'] == "ltorequal"){
					$this->db->or_where($s["search_field"]." <=",$s["search_text"]);
				}elseif($s['query_method'] == "wherein"){
					$this->db->where_in($s["search_field"],explode(',',$s["search_text"]));
				}elseif($s['query_method'] == "where_not_in"){
					$this->db->where_not_in($s["search_field"],explode(',',$s["search_text"]));
				}
			}
			//log_message('info',"SQL :-".serialize($this->db));
		}
		
	
		if (isset($data['group_by'])){
			 
			$this->db->group_by($data['group_by']);
		
		}
		
		if (isset($data['having'])){
		
			foreach($data['having'] as $c=>$v)
			{
				$this->db->having($c,$v);
			}
		
		}
		
		if (isset($data['order_by'])){
			foreach($data['order_by'] as $c=>$v)
			{
				$this->db->order_by($c,$v);
			}
			 
		}
		
		if($limit_enable == true){
  		if (isset($data['limit'])){
  		  $this->db->limit($data['limit'],$data['offset']) ;
  		}
		}
		
	}
		
		/**
		 * Function count_data()
		 *
		 * gets count of records from the staff table with the facility of selection and filters.
		 * records can be grouped and ordered
		 * 
		 * @param $data is a composit array with elements for 
		 * 				selection - fields that are to be selected / default *, filter - the conditions for where clause, group by , having and order by 
		 * 				Ex: Array(['selection']=>'table_name.field_name1,table_name.field_name2', ['filter']=>array(field_name=>value), ['group_by']=>'field_name1,field_name2', ['having']=>array(filed_name => value) , ['order_by']=>array(filed_name => order));
		 *				['order_by']=>array(filed_name => order) - order is asc/desc
		 * @return the count of records.
		 * 
		 * @access	
		 * @since	1.0
		 */

	function count_data($data)
	{
        
      	$this->set_query($data,false);
		
		return $this->db->count_all_results();
		
	}

		/**
		 * Function save()
		 *
		 * Insert data as a new record, if not exists, otherwise do Update
		 * This function will work ie: the delete will be executed 
		 * only when the user identification is present.
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
	
	function save(&$data_array,$key=false)
	{
		if (!isset($_SESSION['user_name'])){
			 show_error('No user identification given! data not saved',$status_code=500) ;
			 return false;
		}
		
		// set the data from the passed array
	  
		foreach($data_array as $c=>$v)
			{
				$this->db->set($c,$v);
			} 

		//If key passed set key fields and creation date and insert
		if (!$key or !$this->exists($key))
			{

		    foreach($key as $c=>$v)
			{
				$this->db->set($c,$v);
			}
	
			if($this->db->insert('spo_client_preferences'))
			{
					return true;
					log_message('info', "\$insert :-insert success");
			}
				return false;
			}
		
			foreach($key as $c=>$v)
			{
				$this->db->where($c,$v);
			}
			//log_message('info', "$key :-".serialize($key));
		
			if($this->db->update('spo_client_preferences')){
				return true;
				log_message('info', "\$update :-update success"); 
			}
		$error = $this->db->_error_message();
		
		//log_message('info', "\$$error :-".$error.$this->db->affected_rows()); 
	}
		
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
	
	function delete($pks)
	{
		 if (!isset($_SESSION['user_name'])){
			 show_error('No user identification given! data not saved',$status_code=500) ;
			 return false;
    	 }else{ 
			$this->db->where($pks);
			return $this->db->delete('spo_client_preferences');
		 }
 	}
 		
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

 	
 		if (isset($this->metadata_array)) {
 			return $this->metadata_array;
 		}else {
 			return false;
 		}
 	} 
}
?>
