<?php
		/**
		 * Auto Generated CI View
		 *
		 *
		 * This file creates a form to report bug details
		 *
		 * @package			HOF\view\add_bug_form 
		 * @version			1.0
		 * @uses
		 * @see
		 * @copyright		2020, BizyCorp Internal Systems Development
		 * @license			private, All rights reserved
		 * @author			Mohamed Ruzaik Mohamed Roshan <roshan@ekwa.com>
		 *
		 */
		
		if ( ! defined('BASEPATH')) exit('No direct script access allowed');

		/**
		 * This file creates a form to report bug details
		 *
		 * @package      HOF\view\add_bug_form 
		 * @version      1.0
		 * @copyright    2020, BizyCorp Internal Systems Development
		 * @license      private, All rights reserved
		 * @author       Mohamed Ruzaik Mohamed Roshan <roshan@ekwa.com>
		 * @uses
		 * @see
		 * @created    	Jan 29, 2020
		 * @modified   	Jan 29, 2020
		 * @modification
		 */
class add_bug_form{
	// Just a dummy clas for phpdoc to catch the doc header.
}
?>
<head>

<style>
body{	font-family: Tahoma;	font-size:10pt;}
table{	font-family: Tahoma;	font-size:10pt;}
.form_field_label_class{ 	width:30%;	background:#E3EFFF;	font-size:11pt;}
.form_field_class{ 	width:70%;	background:#E3EFFF;	}
.fieldset_class{ 	width:90%;	}
#formContent{	overflow: auto;	width:100%;	height:100%;	}
</style>

</head>
<body>
<!-- Div wrapper to display scollbars when form gets lengthy -->
<div id="formContent">
<script>
</script>
<?php 

$form = new Form_object('bugForm');
$form->formWidth = 100; 
	$mode='add';
	$hederText = 'Add New Bug Details';
	
	$bug_id = null;
	$product = null;
	$summary = null;
	$component = null;
	$version = null;
	$bug_severity = null;
	$description  = null;
	$priority = null;
	$op_sys = null;
	$rep_platform = null; 
	
	$form->headerText = array(
			'text' => $hederText,
			'delimiter'=>'<h3>,</h3>'
	);
	$form->generalMsg = array(
			'text' => '',
			'delimiter'=>'<div class="gen_msg_class" id="div_gen_msg">,</div>');
	$form->formOpenTag = array(
			'method' => 'post',
			'action' => site_url('bugs_reporter_ctr/add_bug') ,//
			'attributes' => array(
					'accept-charset' => 'utf-8',
					'enctype' => 'multipart/form-data',
					'onsubmit' => ''
			)
	);
	
	// step 6:
	//define field objects (form fields)
	/*
	$bug_id = new Field(
			'bug_id',
			'hidden',
			array(
					'id'=>'bug_id',
					'value'=>$bug_id,
					'label'=>'',
					'before_field' =>'',
					'after_field' => '',
					'required_mark'=>null,
					'field_msg'=>''
					)
			);
	
	$product = new Field(
			'product',
			'hidden',
			array(
					'id'=>'product',
					'value'=>$product,
					'label'=>'',
					'before_field' =>'',
					'after_field' => '',
					'required_mark'=>null,
					'field_msg'=>''
					)
			);
	*/
	$summary = new Field(
			'summary',
			'text',
			array(
					'id'=>'summary',
					'value'=>$summary,
					'label'=>'Summary',
					'before_field' =>'',
					'style' => ' style ="width:100%" ',
					'after_field' => '',
					'required_mark'=>true,
					'field_msg'=>''
					)
			);
	
	
	$omponent_options = array('' => 'Please select');
	
	foreach($components as $comp){
		$component_options[$comp['name']] = $comp['name'];
	}
	
	$component = new Field('component','select',array('id'=>'component','label'=>'Component',
			'before_field' =>'',
			'after_field' => '',
			'required_mark'=>true,
			'field_msg'=>'',
			'style' => 'class = "" onchange=""',
			'disabled' => false),$component_options,$component );
		
	foreach($versions as $vir){
		$versions_options[$vir['name']] = $vir['name'];
	}
	
	$version = new Field('version','select',array('id'=>'version','label'=>'Version',
			'before_field' =>'',
			'after_field' => '',
			'required_mark'=>true,
			'field_msg'=>'',
			'style' => 'class = "" onchange=""',
			'disabled' => false),$versions_options,$version );
	
	
	$bug_severity_options = array(
			'' => 'Please select',		
			'blocker' =>'blocker',
			"critical"=>"critical",
			"major"=>"major",
			"normal"=>"normal",
			"minor"=>"minor",
			"trivial"=>"trivial",
			"enhancement"=>"enhancement"		
	);
	$bug_severity = new Field('bug_severity','select',array('id'=>'severity','label'=>'Severity',
			'before_field' =>'',
			'after_field' => '',
			'required_mark'=>true,
			'field_msg'=>'',
			'style' => 'class = "" onchange=""',
			'disabled' => false),$bug_severity_options,$bug_severity );
	
	$priority_options = array(
			'' => 'Please select',
			"Highest" =>"Highest",
			"High"=>"High",
			"Normal"=>"Normal",
			"Low"=>"Low",
			"Lowest"=>"Lowest",
			"---"=>"---"			
	);
	
	$priority = new Field('priority','select',array('id'=>'priority','label'=>'Priority',
			'before_field' =>'',
			'after_field' => '',
			'required_mark'=>true,
			'field_msg'=>'',
			'style' => 'class = "" onchange=""',
			'disabled' => false),$priority_options,$priority );
	
	$op_sys_options = array(
			'' => 'Please select',
			"All" =>"All",
			"Windows"=>"Windows",
			"Mac OS"=>"Mac OS",
			"Linux"=>"Linux",
			"Other"=>"Other"		
	);
	$op_sys = new Field('op_sys','select',array('id'=>'os','label'=>'OS',
			'before_field' =>'',
			'after_field' => '',
			'required_mark'=>true,
			'field_msg'=>'',
			'style' => 'class = "" onchange=""',
			'disabled' => false),$op_sys_options,$op_sys );
	

	$rep_platform_options = array(
			'' => 'Please select',
			"All" =>"All",
			"PC"=>"PC",
			"Macintosh"=>"Macintosh",			
			"Other"=>"Other"
	);
	$rep_platform = new Field('rep_platform','select',array('id'=>'rep_platform','label'=>'Hardware',
			'before_field' =>'',
			'after_field' => '',
			'required_mark'=>true,
			'field_msg'=>'',
			'style' => 'class = "" onchange=""',
			'disabled' => false),$rep_platform_options,$rep_platform );
	
	$description  = new Field(
			'description',
			'textarea',	
			array(
					'id'=> 'description',					
					'value'=>'',
					'label'=>'Description',
					'before_field' =>'',
					'after_field' => '',
					'required_mark'=>true,
					'field_msg'=>'',
					'style' => 'style="width:300px;"',
					'disabled' => false));
	
	$attachment = new Field(
			'empty',
			'empty',
			array(
					'required_mark'=>false,
					'label'=>'Attachment',
					'before_field' =>
					'<input type="file" name="attachment" accept="image/*">'
			)
	);
	
	
		$form->fieldSets = array(
			'add_bug' => array(
					'legend'=>'Report Bug  Details',
					'attributes' => array('class' => '','id'=>''),
					'fields' =>  array(							
							$component,
							$version,
							$priority,
							$summary,
							$bug_severity,
							$op_sys,
							$rep_platform,
							$description,
							$attachment
		 				)
			)
	);

	$form->init();

?>
</div>
</body>
<script>
var debug = false;
function formSubmit(){

	var inputs = document.getElementsByTagName("input"); 
    for (var i = 0; i < inputs.length; i++) { 

        if(inputs[i].name != 'attachment'){
	        if(inputs[i].value == ''){
				//alert('Please fill in/select all required fields')	
				messagehandler('Please fill in/select all required fields', 'failure');		
				return false;
	        }
        }
    } 
    var selects = document.getElementsByTagName("select");
    for (var i = 0; i < selects.length; i++) {
        if(selects[i].value == ''){
			//alert('Please fill in/select all required fields')
			messagehandler('Please fill in/select all required fields', 'failure');			
			return false;
        }
    
    }
    var textareas = document.getElementsByTagName("textarea"); 
    for (var i = 0; i < textareas.length; i++) { 
        if(textareas[i].value == ''){
			//alert('Please fill in/select all required fields')
			messagehandler('Please fill in/select all required fields', 'failure');			
			return false;
        }
    
    }
	document.forms['bugForm'].submit();
	return true;		
	
}//end of function submitForm()



/**
 * This function clears all input values of the form
 */
function clearAllFields(){
	
	var totInputs = document.forms[0].elements.length;
	for(var s =0 ; s<totInputs;s++){
		var curElement = document.forms[0].elements[s];		

		//if current element is a text box
		if(curElement.type == 'text' || curElement.type == 'textarea'){		
			curElement.value = '';		
		}		
	}//end for
	
}//end of function

function reset_form(){
	document.forms['bugForm'].reset();
	//clearAllFields();
} 


function disableAll(){

	var inputs = document.getElementsByTagName("input"); 
    for (var i = 0; i < inputs.length; i++) { 
        inputs[i].disabled = bDisabled;
    } 
    var selects = document.getElementsByTagName("select");
    for (var i = 0; i < selects.length; i++) {
        selects[i].disabled = bDisabled;
    }
    var textareas = document.getElementsByTagName("textarea"); 
    for (var i = 0; i < textareas.length; i++) { 
        textareas[i].disabled = bDisabled;
    }
    var buttons = document.getElementsByTagName("button");
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].disabled = bDisabled;
    }
}

function messagehandler(message, type){
  switch (type){
    case 'confirmation':
      document.getElementById('div_gen_msg').innerHTML=message;
      document.getElementById('div_gen_msg').setAttribute('class','confirm confirm-active');
      <?php if(isset($message['gridHandler']) && ($message['gridHandler']== 'update' || $message['gridHandler']== 'updateAndClose') ){ ?>
        //parent.dataGrid.updateFromXML(parent.dataGrid.xmlLoader.filePath,true,true);
      <?php } ?>
      setTimeout(function(){document.getElementById('div_gen_msg').setAttribute('class','');
      document.getElementById('div_gen_msg').innerHTML='';
      <?php if (isset($message['gridHandler']) && ($message['gridHandler']== 'close' || $message['gridHandler']== 'updateAndClose')) { ?>
      parent.wb.getFormLayout().collapse();
      <?php } ?>
      },4800);
      break;
    case 'failure':
      document.getElementById('div_gen_msg').innerHTML=message;
      document.getElementById('div_gen_msg').setAttribute('class','failed failed-active');
      setTimeout(function(){document.getElementById('div_gen_msg').setAttribute('class','');
                document.getElementById('div_gen_msg').innerHTML='';},4800);
      break;
    default:
    
  }
}


<?php if($savestatus == 1){ ?>
	messagehandler('<?php echo $msg?>', 'confirmation');
	parent.bugs_grid.updateFromXML(
			parent.bugs_grid.xmlLoader.filePath,true,true
			);
	setTimeout(function(){
		parent.myLayout.collapse();},4000
		);
	
<?php } ?>			
</script>




</html>
