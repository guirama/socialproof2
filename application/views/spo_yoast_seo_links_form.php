<?php
		/**
		 * Auto Generated CI View
		 *
		 *
		 * This view file generates the add / edit form in HTML format using the forms object
		 *
		 * @package			HOF\view\spo_yoast_seo_links_form 
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
		 * @package      HOF\view\spo_yoast_seo_links_form 
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
class spo_yoast_seo_links_form{
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
$id	= isset($id)? $id : "";
$id = isset($id)? $id: "";
$url = isset($url)? $url: "";
$post_id = isset($post_id)? $post_id: "";
$target_post_id = isset($target_post_id)? $target_post_id: "";
$type = isset($type)? $type: "";



$log_create = new log_object();
$log_create->set_disable($this->config->item('log_status'));
$log_create->set_userDetails($user_name, $user_type);
$log_create->set_otherDetails(array('Mode'=>"spo_yoast_seo_links_Form-$mode",'Data'=>$id));
$log_create->init();


$fieldset_title ="Spo_yoast_seo_links (".ucfirst($mode).")";
?>
<div id="info2" style="width: 100%; padding: 3px; margin: 3px; text-align: center; font-family:Arial; font-size:13px; font-style:italic; color:red;">
<?php if(isset($message['msgText'])) echo $message['msgText']; ?>
</div>
<div id="toolbarObj"></div>
<div id="formbox" style="width:100%;height:100%; font-family:Arial; font-size:12px; overflow:scroll;">

<?
//Create new form
$myForm = new form_object('spo_yoast_seo_links_form') ;

	$myForm->formOpenTag = array('method' => 'post',
    	'action'  => '#',
        'attributes' => array(
        'enctype' => 'multipart/form-data',
        'onsubmit' => 'return inputValidate()'));
		
		$mode_field = new field('mode','hidden',array('id'=>'mode','value'=>$mode,'required_mark' => false));
		
		$form_status_field = new field('formstatus','hidden',array('id'=>'formstatus','value'=>$message['msgType'],'required_mark' => false));
		
		$id_field = new field('id','hidden',array('value'=>$id,'required_mark' => false));

		$field_0 = new field(
									'id',
									'text',array(
											'id'=>'id',
											'value'=>"$id",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_1 = new field(
									'url',
									'text',array(
											'id'=>'url',
											'value'=>"$url",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_2 = new field(
									'post_id',
									'text',array(
											'id'=>'post_id',
											'value'=>"$post_id",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_3 = new field(
									'target_post_id',
									'text',array(
											'id'=>'target_post_id',
											'value'=>"$target_post_id",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_4 = new field(
									'type',
									'text',array(
											'id'=>'type',
											'value'=>"$type",
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
							$mode_field,$form_status_field,$field_0,$field_1,$field_2,$field_3,$field_4
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

	idlist = Array('id','url','post_id','target_post_id','type');
	iddis = Array('','','','','');
	
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
