<?php
		/**
		 * Auto Generated CI View
		 *
		 *
		 * This view file generates the add / edit form in HTML format using the forms object
		 *
		 * @package			HOF\view\spo_client_reviews_form 
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
		 * @package      HOF\view\spo_client_reviews_form 
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
class spo_client_reviews_form{
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
$review_id = isset($review_id)? $review_id: "";
$user_id = isset($user_id)? $user_id: "";
$rating = isset($rating)? $rating: "";
$user_name = isset($user_name)? $user_name: "";
$comment = isset($comment)? $comment: "";
$provider_name = isset($provider_name)? $provider_name: "";
$profile_link = isset($profile_link)? $profile_link: "";
$created_on = isset($created_on)? $created_on: "";



$log_create = new log_object();
$log_create->set_disable($this->config->item('log_status'));
$log_create->set_userDetails($user_name, $user_type);
$log_create->set_otherDetails(array('Mode'=>"spo_client_reviews_Form-$mode",'Data'=>$id));
$log_create->init();


$fieldset_title ="Spo_client_reviews (".ucfirst($mode).")";
?>
<div id="info2" style="width: 100%; padding: 3px; margin: 3px; text-align: center; font-family:Arial; font-size:13px; font-style:italic; color:red;">
<?php if(isset($message['msgText'])) echo $message['msgText']; ?>
</div>
<div id="toolbarObj"></div>
<div id="formbox" style="width:100%;height:100%; font-family:Arial; font-size:12px; overflow:scroll;">

<?
//Create new form
$myForm = new form_object('spo_client_reviews_form') ;

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
									'review_id',
									'text',array(
											'id'=>'review_id',
											'value'=>"$review_id",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_2 = new field(
									'user_id',
									'text',array(
											'id'=>'user_id',
											'value'=>"$user_id",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_3 = new field(
									'rating',
									'text',array(
											'id'=>'rating',
											'value'=>"$rating",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_4 = new field(
									'user_name',
									'text',array(
											'id'=>'user_name',
											'value'=>"$user_name",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_5 = new field(
									'comment',
									'text',array(
											'id'=>'comment',
											'value'=>"$comment",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_6 = new field(
									'provider_name',
									'text',array(
											'id'=>'provider_name',
											'value'=>"$provider_name",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_7 = new field(
									'profile_link',
									'text',array(
											'id'=>'profile_link',
											'value'=>"$profile_link",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_8 = new field(
									'created_on',
									'text',array(
											'id'=>'created_on',
											'value'=>"$created_on",
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
							$mode_field,$form_status_field,$field_0,$field_1,$field_2,$field_3,$field_4,$field_5,$field_6,$field_7,$field_8
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

	idlist = Array('id','review_id','user_id','rating','user_name','comment','provider_name','profile_link','created_on');
	iddis = Array('','','','','','','','','');
	
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
