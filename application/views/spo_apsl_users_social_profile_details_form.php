<?php
		/**
		 * Auto Generated CI View
		 *
		 *
		 * This view file generates the add / edit form in HTML format using the forms object
		 *
		 * @package			HOF\view\spo_apsl_users_social_profile_details_form 
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
		 * @package      HOF\view\spo_apsl_users_social_profile_details_form 
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
class spo_apsl_users_social_profile_details_form{
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
$user_id = isset($user_id)? $user_id: "";
$provider_name = isset($provider_name)? $provider_name: "";
$identifier = isset($identifier)? $identifier: "";
$unique_verifier = isset($unique_verifier)? $unique_verifier: "";
$email = isset($email)? $email: "";
$email_verified = isset($email_verified)? $email_verified: "";
$first_name = isset($first_name)? $first_name: "";
$last_name = isset($last_name)? $last_name: "";
$profile_url = isset($profile_url)? $profile_url: "";
$website_url = isset($website_url)? $website_url: "";
$photo_url = isset($photo_url)? $photo_url: "";
$display_name = isset($display_name)? $display_name: "";
$description = isset($description)? $description: "";
$gender = isset($gender)? $gender: "";
$language = isset($language)? $language: "";
$age = isset($age)? $age: "";
$birthday = isset($birthday)? $birthday: "";
$birthmonth = isset($birthmonth)? $birthmonth: "";
$birthyear = isset($birthyear)? $birthyear: "";
$phone = isset($phone)? $phone: "";
$address = isset($address)? $address: "";
$country = isset($country)? $country: "";
$region = isset($region)? $region: "";
$city = isset($city)? $city: "";
$zip = isset($zip)? $zip: "";



$log_create = new log_object();
$log_create->set_disable($this->config->item('log_status'));
$log_create->set_userDetails($user_name, $user_type);
$log_create->set_otherDetails(array('Mode'=>"spo_apsl_users_social_profile_details_Form-$mode",'Data'=>$id));
$log_create->init();


$fieldset_title ="Spo_apsl_users_social_profile_details (".ucfirst($mode).")";
?>
<div id="info2" style="width: 100%; padding: 3px; margin: 3px; text-align: center; font-family:Arial; font-size:13px; font-style:italic; color:red;">
<?php if(isset($message['msgText'])) echo $message['msgText']; ?>
</div>
<div id="toolbarObj"></div>
<div id="formbox" style="width:100%;height:100%; font-family:Arial; font-size:12px; overflow:scroll;">

<?
//Create new form
$myForm = new form_object('spo_apsl_users_social_profile_details_form') ;

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
$field_2 = new field(
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
$field_3 = new field(
									'identifier',
									'text',array(
											'id'=>'identifier',
											'value'=>"$identifier",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_4 = new field(
									'unique_verifier',
									'text',array(
											'id'=>'unique_verifier',
											'value'=>"$unique_verifier",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_5 = new field(
									'email',
									'text',array(
											'id'=>'email',
											'value'=>"$email",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_6 = new field(
									'email_verified',
									'text',array(
											'id'=>'email_verified',
											'value'=>"$email_verified",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_7 = new field(
									'first_name',
									'text',array(
											'id'=>'first_name',
											'value'=>"$first_name",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_8 = new field(
									'last_name',
									'text',array(
											'id'=>'last_name',
											'value'=>"$last_name",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_9 = new field(
									'profile_url',
									'text',array(
											'id'=>'profile_url',
											'value'=>"$profile_url",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_10 = new field(
									'website_url',
									'text',array(
											'id'=>'website_url',
											'value'=>"$website_url",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_11 = new field(
									'photo_url',
									'text',array(
											'id'=>'photo_url',
											'value'=>"$photo_url",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_12 = new field(
									'display_name',
									'text',array(
											'id'=>'display_name',
											'value'=>"$display_name",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_13 = new field(
									'description',
									'text',array(
											'id'=>'description',
											'value'=>"$description",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_14 = new field(
									'gender',
									'text',array(
											'id'=>'gender',
											'value'=>"$gender",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_15 = new field(
									'language',
									'text',array(
											'id'=>'language',
											'value'=>"$language",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_16 = new field(
									'age',
									'text',array(
											'id'=>'age',
											'value'=>"$age",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_17 = new field(
									'birthday',
									'text',array(
											'id'=>'birthday',
											'value'=>"$birthday",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_18 = new field(
									'birthmonth',
									'text',array(
											'id'=>'birthmonth',
											'value'=>"$birthmonth",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_19 = new field(
									'birthyear',
									'text',array(
											'id'=>'birthyear',
											'value'=>"$birthyear",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_20 = new field(
									'phone',
									'text',array(
											'id'=>'phone',
											'value'=>"$phone",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_21 = new field(
									'address',
									'text',array(
											'id'=>'address',
											'value'=>"$address",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_22 = new field(
									'country',
									'text',array(
											'id'=>'country',
											'value'=>"$country",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_23 = new field(
									'region',
									'text',array(
											'id'=>'region',
											'value'=>"$region",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_24 = new field(
									'city',
									'text',array(
											'id'=>'city',
											'value'=>"$city",
											'label' => '',
											'required_mark' => TRUE,
											'style' => '',
											'field_msg'=>'',
											'disabled' =>$mode=="delete"?true:false
									)
							);
$field_25 = new field(
									'zip',
									'text',array(
											'id'=>'zip',
											'value'=>"$zip",
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
							$mode_field,$form_status_field,$field_0,$field_1,$field_2,$field_3,$field_4,$field_5,$field_6,$field_7,$field_8,$field_9,$field_10,$field_11,$field_12,$field_13,$field_14,$field_15,$field_16,$field_17,$field_18,$field_19,$field_20,$field_21,$field_22,$field_23,$field_24,$field_25
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

	idlist = Array('id','user_id','provider_name','identifier','unique_verifier','email','email_verified','first_name','last_name','profile_url','website_url','photo_url','display_name','description','gender','language','age','birthday','birthmonth','birthyear','phone','address','country','region','city','zip');
	iddis = Array('','','','','','','','','','','','','','','','','','','','','','','','','','');
	
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
