<?php
		/**
		 * This is model developed to maintain table spo_posts
		 *
		 * @package    HOF\models\spo_posts
		 * @version    1.0
		 * @copyright  2020, BizyCorp Internal Systems Development
		 * @license    private, All rights reserved
		 * @author     CIGen (Automated CI Code Generator)
		 */
		
		if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		
		/**
		 * This is model developed to maintain table spo_posts
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
		 *  @package    HOF\models\spo_posts
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
class  Spo_posts_model extends CI_Model
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
		
		
$this->metadata_array['PK']= 'ID';

$this->metadata_array['ID']['header']= '';

$this->metadata_array['ID']['type']= 'bigint';

$this->metadata_array['ID']['width']='20 unsigned';

$this->metadata_array['post_author']['header']= '';

$this->metadata_array['post_author']['type']= 'bigint';

$this->metadata_array['post_author']['width']='20 unsigned';

$this->metadata_array['post_date']['header']= '';

$this->metadata_array['post_date']['type']= 'datetime';

$this->metadata_array['post_date']['width']='';

$this->metadata_array['post_date_gmt']['header']= '';

$this->metadata_array['post_date_gmt']['type']= 'datetime';

$this->metadata_array['post_date_gmt']['width']='';

$this->metadata_array['post_content']['header']= '';

$this->metadata_array['post_content']['type']= 'longtext';

$this->metadata_array['post_content']['width']='';

$this->metadata_array['post_title']['header']= '';

$this->metadata_array['post_title']['type']= 'text';

$this->metadata_array['post_title']['width']='';

$this->metadata_array['post_excerpt']['header']= '';

$this->metadata_array['post_excerpt']['type']= 'text';

$this->metadata_array['post_excerpt']['width']='';

$this->metadata_array['post_status']['header']= '';

$this->metadata_array['post_status']['type']= 'varchar';

$this->metadata_array['post_status']['width']='20';

$this->metadata_array['comment_status']['header']= '';

$this->metadata_array['comment_status']['type']= 'varchar';

$this->metadata_array['comment_status']['width']='20';

$this->metadata_array['ping_status']['header']= '';

$this->metadata_array['ping_status']['type']= 'varchar';

$this->metadata_array['ping_status']['width']='20';

$this->metadata_array['post_password']['header']= '';

$this->metadata_array['post_password']['type']= 'varchar';

$this->metadata_array['post_password']['width']='255';

$this->metadata_array['post_name']['header']= '';

$this->metadata_array['post_name']['type']= 'varchar';

$this->metadata_array['post_name']['width']='200';

$this->metadata_array['to_ping']['header']= '';

$this->metadata_array['to_ping']['type']= 'text';

$this->metadata_array['to_ping']['width']='';

$this->metadata_array['pinged']['header']= '';

$this->metadata_array['pinged']['type']= 'text';

$this->metadata_array['pinged']['width']='';

$this->metadata_array['post_modified']['header']= '';

$this->metadata_array['post_modified']['type']= 'datetime';

$this->metadata_array['post_modified']['width']='';

$this->metadata_array['post_modified_gmt']['header']= '';

$this->metadata_array['post_modified_gmt']['type']= 'datetime';

$this->metadata_array['post_modified_gmt']['width']='';

$this->metadata_array['post_content_filtered']['header']= '';

$this->metadata_array['post_content_filtered']['type']= 'longtext';

$this->metadata_array['post_content_filtered']['width']='';

$this->metadata_array['post_parent']['header']= '';

$this->metadata_array['post_parent']['type']= 'bigint';

$this->metadata_array['post_parent']['width']='20 unsigned';

$this->metadata_array['guid']['header']= '';

$this->metadata_array['guid']['type']= 'varchar';

$this->metadata_array['guid']['width']='255';

$this->metadata_array['menu_order']['header']= '';

$this->metadata_array['menu_order']['type']= 'int';

$this->metadata_array['menu_order']['width']='11';

$this->metadata_array['post_type']['header']= '';

$this->metadata_array['post_type']['type']= 'varchar';

$this->metadata_array['post_type']['width']='20';

$this->metadata_array['post_mime_type']['header']= '';

$this->metadata_array['post_mime_type']['type']= 'varchar';

$this->metadata_array['post_mime_type']['width']='100';

$this->metadata_array['comment_count']['header']= '';

$this->metadata_array['comment_count']['type']= 'bigint';

$this->metadata_array['comment_count']['width']='20';

		
		$metadata = $this->db->field_data('spo_posts') ;
		
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
		$this->db->from('spo_posts');
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
		return $this->db->field_exists($column,'spo_posts');
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
		
		$selection =  isset($data['selection'])? $data['selection']: 'spo_posts.ID,spo_posts.post_author,spo_posts.post_date,spo_posts.post_date_gmt,spo_posts.post_content,spo_posts.post_title,spo_posts.post_excerpt,spo_posts.post_status,spo_posts.comment_status,spo_posts.ping_status,spo_posts.post_password,spo_posts.post_name,spo_posts.to_ping,spo_posts.pinged,spo_posts.post_modified,spo_posts.post_modified_gmt,spo_posts.post_content_filtered,spo_posts.post_parent,spo_posts.guid,spo_posts.menu_order,spo_posts.post_type,spo_posts.post_mime_type,spo_posts.comment_count' ;
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
		$data['selection'] =  isset($data['selection'])? $data['selection']: 'spo_posts.ID,spo_posts.post_author,spo_posts.post_date,spo_posts.post_date_gmt,spo_posts.post_content,spo_posts.post_title,spo_posts.post_excerpt,spo_posts.post_status,spo_posts.comment_status,spo_posts.ping_status,spo_posts.post_password,spo_posts.post_name,spo_posts.to_ping,spo_posts.pinged,spo_posts.post_modified,spo_posts.post_modified_gmt,spo_posts.post_content_filtered,spo_posts.post_parent,spo_posts.guid,spo_posts.menu_order,spo_posts.post_type,spo_posts.post_mime_type,spo_posts.comment_count';

		$data['search'] = isset($data['search'])  ? $data['search'] : $search_filter ;

		$this->db->from('spo_posts');
		

		
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
	
			if($this->db->insert('spo_posts'))
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
		
			if($this->db->update('spo_posts')){
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
			return $this->db->delete('spo_posts');
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
