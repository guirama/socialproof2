<?php
		/**
		 * Auto Generated CI View
		 *
		 *
		 * This view file generates the add / edit form in HTML format using the forms object
		 *
		 * @package			HOF\view\spo_posts_form 
		 * @version			1.0
		 * @uses
		 * @see
		 * @copyright		2020, BizyCorp Internal Systems Development
		 * @license			private, All rights reserved
		 * @author			CIGen (Automated CI Code Generator)
		 *
		 */
		
		if ( ! defined('BASEPATH')) exit('No direct script access allowed');

		/**
		 * This view file generates the add / edit form in HTML format using the forms object
		 *
		 * @package      HOF\view\spo_posts_form 
		 * @version      1.0
		 * @copyright    2020, BizyCorp Internal Systems Development
		 * @license      private, All rights reserved
		 * @author       CIGen (Automated CI Code Generator)
		 * @uses
		 * @see
		 * @created    	Jan 29, 2020
		 * @modified   	Jan 29, 2020
		 * @modification
		 */
class spo_posts_form{
	// Just a dummy clas for phpdoc to catch the doc header.
}
		
if(isset($_SESSION['user_name'])){ 
	//echo "Your session has EXPIRED!. You will be redirected....",
	//"<script>parent.window.postMessage('reload','*');</script>";
	// die(); 
	$user_name=$_SESSION["user_name"];
	$user_type=$_SESSION["user_type"];
}else{
	$user_name='';
	$user_type='';	
}

/**
 * Include the common header file
 */

require_once('js-css-loader.php');


$mode	= isset($mode)? $mode: "";
//$formstatus to handle form close and grid reload check for save status success and failure
$formstatus	= isset($formstatus)? $formstatus: ""; 
$ID	= isset($ID)? $ID : "";
$ID = isset($ID)? $ID: "";
$post_author = isset($post_author)? $post_author: "";
$post_date = isset($post_date)? $post_date: "";
$post_date_gmt = isset($post_date_gmt)? $post_date_gmt: "";
$post_content = isset($post_content)? $post_content: "";
$post_title = isset($post_title)? $post_title: "";
$post_excerpt = isset($post_excerpt)? $post_excerpt: "";
$post_status = isset($post_status)? $post_status: "";
$comment_status = isset($comment_status)? $comment_status: "";
$ping_status = isset($ping_status)? $ping_status: "";
$post_password = isset($post_password)? $post_password: "";
$post_name = isset($post_name)? $post_name: "";
$to_ping = isset($to_ping)? $to_ping: "";
$pinged = isset($pinged)? $pinged: "";
$post_modified = isset($post_modified)? $post_modified: "";
$post_modified_gmt = isset($post_modified_gmt)? $post_modified_gmt: "";
$post_content_filtered = isset($post_content_filtered)? $post_content_filtered: "";
$post_parent = isset($post_parent)? $post_parent: "";
$guid = isset($guid)? $guid: "";
$menu_order = isset($menu_order)? $menu_order: "";
$post_type = isset($post_type)? $post_type: "";
$post_mime_type = isset($post_mime_type)? $post_mime_type: "";
$comment_count = isset($comment_count)? $comment_count: "";



$log_create = new log_object();
$log_create->set_disable($this->config->item('log_status'));
$log_create->set_userDetails($user_name, $user_type);
$log_create->set_otherDetails(array('Mode'=>"spo_posts_Form-$mode",'Data'=>$ID));
$log_create->init();


$fieldset_title ="Spo_posts (".ucfirst($mode).")";
?>
<div id="info2" style="width: 100%; padding: 3px; margin: 3px; text-align: center; font-family:Arial; font-size:13px; font-style:italic; color:red;">
<?php if(isset($message['msgText'])) echo $message['msgText']; ?>
</div>
<div id="toolbarObj"></div>
<div id="formbox" style="width:100%;height:100%; font-family:Arial; font-size:12px; overflow:scroll;">

<?
//Create new form
$myForm = new form_object('spo_posts_form') ;

	$myForm->formOpenTag = array('method' => 'post',
    	'action'  => '#',
        'attributes' => array(
        'enctype' => 'multipart/form-data',
        'onsubmit' => 'return inputValidate()'));
		
		$mode_field = new field('mode','hidden',array('id'=>'mode','value'=>$mode,'required_mark' => false));
		
		$form_status_field = new field('formstatus','hidden',array('id'=>'formstatus','value'=>$message['msgType'],'required_mark' => false));
		
		$id_field = new field('ID','hidden',array('value'=>$ID,'required_mark' => false));

		$field_0 = new field(
									'ID',
									'text',array(
											'id'=>'ID',
											'value'=>"$ID",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_1 = new field(
									'post_author',
									'text',array(
											'id'=>'post_author',
											'value'=>"$post_author",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_2 = new field(
									'post_date',
									'text',array(
											'id'=>'post_date',
											'value'=>"$post_date",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_3 = new field(
									'post_date_gmt',
									'text',array(
											'id'=>'post_date_gmt',
											'value'=>"$post_date_gmt",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_4 = new field(
									'post_content',
									'text',array(
											'id'=>'post_content',
											'value'=>"$post_content",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_5 = new field(
									'post_title',
									'text',array(
											'id'=>'post_title',
											'value'=>"$post_title",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_6 = new field(
									'post_excerpt',
									'text',array(
											'id'=>'post_excerpt',
											'value'=>"$post_excerpt",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_7 = new field(
									'post_status',
									'text',array(
											'id'=>'post_status',
											'value'=>"$post_status",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_8 = new field(
									'comment_status',
									'text',array(
											'id'=>'comment_status',
											'value'=>"$comment_status",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_9 = new field(
									'ping_status',
									'text',array(
											'id'=>'ping_status',
											'value'=>"$ping_status",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_10 = new field(
									'post_password',
									'text',array(
											'id'=>'post_password',
											'value'=>"$post_password",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_11 = new field(
									'post_name',
									'text',array(
											'id'=>'post_name',
											'value'=>"$post_name",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_12 = new field(
									'to_ping',
									'text',array(
											'id'=>'to_ping',
											'value'=>"$to_ping",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_13 = new field(
									'pinged',
									'text',array(
											'id'=>'pinged',
											'value'=>"$pinged",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_14 = new field(
									'post_modified',
									'text',array(
											'id'=>'post_modified',
											'value'=>"$post_modified",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_15 = new field(
									'post_modified_gmt',
									'text',array(
											'id'=>'post_modified_gmt',
											'value'=>"$post_modified_gmt",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_16 = new field(
									'post_content_filtered',
									'text',array(
											'id'=>'post_content_filtered',
											'value'=>"$post_content_filtered",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_17 = new field(
									'post_parent',
									'text',array(
											'id'=>'post_parent',
											'value'=>"$post_parent",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_18 = new field(
									'guid',
									'text',array(
											'id'=>'guid',
											'value'=>"$guid",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_19 = new field(
									'menu_order',
									'text',array(
											'id'=>'menu_order',
											'value'=>"$menu_order",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_20 = new field(
									'post_type',
									'text',array(
											'id'=>'post_type',
											'value'=>"$post_type",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_21 = new field(
									'post_mime_type',
									'text',array(
											'id'=>'post_mime_type',
											'value'=>"$post_mime_type",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_22 = new field(
									'comment_count',
									'text',array(
											'id'=>'comment_count',
											'value'=>"$comment_count",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);



	$myForm->fieldSets = array(
			'tpdetails' => array(
					'legend'=> $fieldset_title,
					'attributes' => array(
							'class' => 'fieldset_class',
							'id'=>'ms_fieldset'
					),
					'fields' =>  array(
							$id_field,
							$mode_field,$form_status_field,$field_0,$field_1,$field_2,$field_3,$field_4,$field_5,$field_6,$field_7,$field_8,$field_9,$field_10,$field_11,$field_12,$field_13,$field_14,$field_15,$field_16,$field_17,$field_18,$field_19,$field_20,$field_21,$field_22
							)
					)
	);
$myForm->init();
?>
</div>
<style>
body{font-family: Helvetica;font-size:10pt;}
table{font-family: Helvetica;font-size:10pt}
.form_field_label_class{ width:30%;font-size:10pt}
.form_field_class{ width:100%;}
.field_msg_div_class {color: red; font-size:0.7em;}
.fieldset_class{ width:90%;font-family:Tahoma, Geneva, sans-serif; color:#10579E }
span.required{
 color:#F00;
}
</style>

<script type="text/javascript">
disableInputs();

function inputValidate(){
    var error = Array();
  	
	var reg = /^([A-Za-z0-9_\-\.])+\@(([A-Za-z0-9_\-])+\.)+([A-Za-z]{2,4})$/; 

	idlist = Array('ID','post_author','post_date','post_date_gmt','post_content','post_title','post_excerpt','post_status','comment_status','ping_status','post_password','post_name','to_ping','pinged','post_modified','post_modified_gmt','post_content_filtered','post_parent','guid','menu_order','post_type','post_mime_type','comment_count');
	iddis = Array('','','','','','','','','','','','','','','','','','','','','','','');
	
	subpremit=true;
	msg='';
	for(i=0; i<idlist.length; i++){
		valobject = document.getElementById(idlist[i]);
		if(valobject.value==''){
			error.push([iddis[i]+' cannot be empty.']);
			
		}
	}
  
	  
    if(error.length > 0){
	
	return error;
  	}else{
	
	document.getElementById('info2').innerHTML= '';
  	return true;	
  	}
}

function disableInputs(){
	
	if(document.getElementsByName('mode')[0].value == "delete"){
		
		//document.getElementById('catId').disabled=true;
		//document.getElementById('cid').disabled=true;
		
	}

}
</script>
