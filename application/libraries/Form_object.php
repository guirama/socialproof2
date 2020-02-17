<?php
/**
 * CommonObjects - Manually Developed FormObject
 *
 *
 * @package			BizyOffice\libraries\Form_object
 * @version			1.4
 * @copyright		2015, BizyCorp Internal Systems Development
 * @license			private, All rights reserved
 * @author			Mohamed Roshan
 * 
 */
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 define('MAIL_ADDRESS_VALIDATOR','/^[A-Za-z0-9._%+-]+@(?:[A-Za-z0-9-]+\.)+(?:[A-Za-z]{2}|com|org|net|edu|gov|mil|biz|info|mobi|name|aero|asia|jobs|museum)$/');
 define('TEXT_ONLY_VALIDATOR','/^[a-zA-Z :;(){}\[\]\*&\^%\!\'"=\-/><,\.]+$/') ;
 define('NUMBER_ONLY_VALIDATOR','/^[0-9\.]+$/') ;
 define('PHONE_VALIDATOR','/^[0-9 :()\-/]+$/') ;
 define('PRICE_VALIDATOR','/^\d+(\.\d{1,2})?$/') ;
 
/**
 * CommonObjects - Manually Developed FormObject
 *
 *
 * Usage :- Construct as $var = new form_object('formanme')
 * 
 * Settable porperties :- formWidth - width of form specified as px or %. If it is a percentage only the valuis to be given. No '%' sign
 * 
 *		[headerText] - A header for the form given as array of 2 params 
 * 	  	array(
 * 			'text' => 'This is form header',
 * 			'delimiter' => '<h3>,</h3>'
 * 		)
 * 		A comma seperated pare of HTML tags which will surround the text
 * 
 *		[generalMsg] - a message to be displyed on the form given as an array of
 * 	    array(
 * 			'text' = 'Message to be shown on form (may be error)', as a string
 * 	     	'delimiter' => '<div class="className">,</div>',  A comma seperated pare of HTML tags which will surround the text
 * 		)
 * 		
 *		[formOpenTag] - The opening HTML tag of form, the content is given as an array
 * 	    array(
 * 			'method' => 'post|get', - method of data submission
 * 	    	'action' => 'url', the url of the form data procssor
 * 	    	'attributes' => array('attrib01'=>'val01','attrib02'=>'val02,...) - Any other HTML attributes that can go in a FORM tag
 * 	    )
 * 
 *		[fields] - form fields specified as an array of Field_object
 *
 *		[fieldSets] - form fields specified in HTML fieldset tags
 *
 * Functions
 * 
 *		1) function init
 *		2) function prepareFieldset
 *  	3) function endFieldset
 *  	4) function createTableRows
 *  	5) function addMsgSpan
 *  	6) function set_css
 *  	7) function get_cssFile
 *  
 * @package			BizyOffice\libraries\Form_object
 * @version			1.4
 * @uses			
 * @see				
 * @copyright		2015, BizyCorp Internal Systems Development
 * @license			private, All rights reserved
 * @author			Mohamed Roshan
 * @created			Jun 12, 2013 by Mohamed Roshan
 * @modified		Nov 22, 2015 by nuwan.wickramarathne
 * @modification	header block updating
 * 
 */

class Form_object{
   /**
 	* Property Content
 	* @var $debug
 	*/
	var $debug = true;
	
	/**
	 * Property Content
	 * @var $headerText
	 */
	var $headerText = null;

	/**
	 * Property Content
	 * @var $formName
	 */
	var $formName = '';
	
	/**
	 * Property Content
	 * @var $formWidth
	 */
	var $formWidth = 90;
	
	/**
	 * Property Content
	 * @var $fieldSets
	 */
	var $fieldSets = null;
	
	/**
	 * Property Content
	 * @var $generalMsg
	 */
	var $generalMsg = null;
	
	/**
	 * Property Content
	 * @var $formOpenTag
	 */
	var $formOpenTag = null;
	
	/**
	 * Property Content
	 * @var $noOfFormColumns
	 */
	var $noOfFormColumns = 2;
	
	/**
	 * Property Content
	 * @var $fields
	 */
	var $fields = array();
	
	/**
	 * Property Content
	 * @var $csslink_array
	 */
	protected $csslink_array = array('new'=> 'application/views/css/form_object_new.css','old'=>'application/views/css/form_object_old.css');
	
	/**
	 * Property Content
	 * @var $cssType
	 */
	protected $cssType ='new';
	
	/**
	 * Function __construct
	 *
	 *
	 * Multiline detail description of the file goes here. you may 
	 * give any type of details here such as usage and examples
	 *
	 * @param	None
	 * @return	void
	 * @access	public
	 * @since	1.4
	 */
	function __construct($name = null){		
		$this->formName = $name;		
	}//end of construct	
	
	
	/**
	 * Function init
	 *
	 *
	 * initiat the form contents in a table and present it as a form
	 * Echo out the form with supplied html control array.
	 *
	 * @param	None
	 * @return	void
	 * @access	public
	 * @since	1.4
	 */
	function init(){
		/*
		 * adding css links to page
		 * ADDED BY : NCW
		 * DATE ADDED : 24/12/2013
		 */ 
		//echo $this->get_cssFile();
		echo  $this->get_cssFile();
		//css for validetions
		echo '<style>
			.field_msg_div_class{
				display:none;
				color:none;
			}
			.field_msg_div_class_msg{
				display:block;
				color:red;
				font-size:12px;
			}
			span.required{ color:#F00; }
		</style>';
		
		// add form submit JS code
		//12/24/2013 js codes are modifid with in build validetion : NCW
		echo '<script>
			var assign="";
			function submitForm(assign){
				var mailReg = '.MAIL_ADDRESS_VALIDATOR.';
				var textonlyReg = '.TEXT_ONLY_VALIDATOR.';
				var numberonlyReg = '.NUMBER_ONLY_VALIDATOR.';
				var phoneReg = '.PHONE_VALIDATOR.';
				var priceReg = '.PRICE_VALIDATOR.';
				
				if(assign!=""){selectDropdown(assign);}
				
				formElements = document.getElementById("'.$this->formName.'");
				subpermit = true;
				for(i=0; i<formElements.length; i++){
					if(formElements[i].required==true){
						checkElement = formElements[i];
						msgBox = document.getElementById(checkElement.name+"_msg_div");
						fieldValue = formElements[i].value.trim();
						
						if(fieldValue!=""){
							subpermit=true;
							msgBox.innerHTML = ""; 
							msgBox.setAttribute("class","field_msg_div_class")
						}
						else{
							subpermit=false; 
							msgBox.innerHTML = "Required"; 
							msgBox.setAttribute("class","field_msg_div_class_msg");
							break;
						}
					}
					/*
					else{ 
						msgBox.innerHTML = ""; 
						msgBox.setAttribute("class","field_msg_div_class");
					}
					*/
				}
				for(i=0; i<formElements.length; i++){
					checkElement = formElements[i];
					msgBox = document.getElementById(checkElement.name+"_msg_div");
					
					if(checkElement.type!="fieldset"){
						fieldValue = checkElement.value.trim();
						if(fieldValue!=""){
							switch (checkElement.getAttribute("datatype")){
								case "email":
								    if (!checkElement.value.match(mailReg)){ msgBox.setAttribute("class","field_msg_div_class_msg"); msgBox.innerHTML = "Invalid email address"; subpermit = false; }
								break;
								case "text_only":
									if (!checkElement.value.match(textonlyReg)){ msgBox.setAttribute("class","field_msg_div_class_msg"); msgBox.innerHTML = "Invalid text entry"; subpermit = false; }
								break;
								case "number_only":
									if (!checkElement.value.match(numberonlyReg)){ msgBox.setAttribute("class","field_msg_div_class_msg"); msgBox.innerHTML = "Invalid number entry"; subpermit = false; }
								break;
								case "phone":
									if (!checkElement.value.match(phoneReg)){ msgBox.setAttribute("class","field_msg_div_class_msg"); msgBox.innerHTML = "Invalid phone entry"; subpermit = false; }
								break;
								case "price":
									if (!priceReg.test(checkElement.value)){ 
										msgBox.setAttribute("class","field_msg_div_class_msg"); msgBox.innerHTML = "Invalid price value entry"; subpermit = false; 
									}
								break;
							}
						}
					}
				}
				if(subpermit==true){
					document.forms["'.$this->formName.'"].submit();
				}
				return subpermit;
			}
			function selectDropdown(assign){
				var temSelected = assign.split(",");
				
				//selecting selected list
				for(x=0; x<temSelected.length; x++){
					if(document.getElementById(temSelected[x]).length!=0){
					    for (var i = 0; i < document.getElementById(temSelected[x]).length; i++) {
					    	document.getElementById(temSelected[x]).options[i].selected = true;
						}
					}
				}
			}
		</script>';
		
		//general info area
		if(!empty($this->generalMsg)){
			if(is_array($this->generalMsg)){
				$attrib = explode(',',$this->generalMsg['delimiter']);
				echo $attrib[0].$this->generalMsg['text'].$attrib[1];
			}
		}
		
		// header text
		if(!empty($this->headerText)){
			if(is_array($this->headerText)){				
				$attrib = explode(',',$this->headerText['delimiter']);
				echo $attrib[0].$this->headerText['text'].$attrib[1];						
			}
		}		
		
		//set form tag

		// form open tag
		echo '<form ';
		echo ($this->formOpenTag['method'] == 'post')? ' method = "post" ' :' method = "get" ';
		echo (empty($this->formOpenTag['action']))? ' action = "'.$_SERVER['PHP_SELF'].'" ':' action = "'.$this->formOpenTag['action'].'" ';
		if (!empty($this->formOpenTag['attributes'])) {
      foreach($this->formOpenTag['attributes'] as $attribute => $value){
  			echo $attribute . ' = "' . $value. '" ';
  		}
    }
		echo ' name = "'.$this->formName.'"';
		echo ' id = "'.$this->formName.'"';
		echo '>';
		
		//form fieldset
		if(isset($this->fieldSets) && is_array($this->fieldSets)){
			
			foreach($this->fieldSets as $fieldSetKey=>$val){
				
				//start fieldset tag				
				$this->prepareFieldset($val);
				
				//table begin
				echo '<table width="'.$this->formWidth.'%" id="'.$fieldSetKey.'">';
				
				if(!empty($val['fields'])){
					
					foreach($val['fields'] as $field){
							
						if(!empty($field)){
							//create rows with html elements
							$this->createTableRows($field);
						}else{
							echo 'No input field is defined or defined input is empty!';
							exit;
						}	
							
					}//end forecah
					echo '</table>';
					
					//end fieldset tab
					$this->endFieldset();
					
				}else{
					echo 'No input field is defined or defined input is empty!';
					exit;
				}
				
			}//endforeach
    }
    
    if ($this->fields && is_array($this->fields) ){
				
			//If no fieldset is defined display form items without field set
			//table begin
			echo '<table width="'.$this->formWidth.'%">';
				
			foreach($this->fields as $field){
					
				if(!empty($field)){
					//create rows with html elements
						$this->createTableRows($field);
					}else{
						echo 'No input field is defined or defined input is empty!';
						exit;
					}	
					
			}//end forecah		
			echo '</table>';
			
		}//end if fieldset check	

		//end form tab
		echo '</form>';
	}//end of init()
	
	/**
	 * Function prepareFieldset
	 *
	 *
	 * @todo	documenting
	 *
	 * @param	array $fieldSet
	 * @return	void
	 * @access	private 
	 * @since	1.4
	 */
	private function prepareFieldset($fieldSet){
		$legend = (isset($fieldSet['legend']))? $fieldSet['legend']:'';
		$attributes = (isset($fieldSet['attributes']))? $fieldSet['attributes']:null;
		$sub_fieldsets = (isset($fieldSet['sub_fieldsets']))? $fieldSet['sub_fieldsets']:null;
		
		echo '<fieldset ';
		if(!empty($attributes) && is_array($attributes)){
			foreach($attributes as $attribute => $value){
				echo $attribute .' = "'.$value.'" ';
			}
		}//end if
		echo ' >';
		echo (!empty($legend))? "<legend>$legend</legend>":'';
	}//end of function
	
	/**
	 * Function endFieldset
	 *
	 *
	 * @todo	documenting
	 *
	 * @param	None
	 * @return	void
	 * @access	private
	 * @since	1.4
	 * 
	 */
	private function endFieldset(){ echo '</fieldset>'; }//end of fucntion
	
	/**
	 * Function createTableRows
	 *
	 *
	 * @todo	documenting
	 *
	 * @param	$field
	 * @return	void
	 * @access	private
	 * @since	1.4
	 */
	private function createTableRows($field){		
		if($field->type != 'hidden'){
			echo '<tr>';
			echo '<td class="form_field_label_class">';
			if(!empty($field->settings['label'])){
				echo $field->settings['label'];
				echo ($field->settings['required_mark'])? '<span class="required">*</span>':'';
			}
				
			echo '</td>';
			echo '<td  class="form_field_class">';
			echo $field->createField();
			echo '</td>';
			echo '</tr>';
		}
		else{ echo $field->createField(); }//end if
	}//end of function
	
	/**
	 * Function addMsgSpan
	 *
	 *
	 * @todo	documenting
	 *
	 * @param	$name
	 * @param	$msg
	 * @return	void
	 * @access	private
	 * @since	1.4
	 */
	private function addMsgSpan($name,$msg){ echo '<div	id="'.$name.'_MsgDiv" class="field_msg_div_class" >'.$msg.'</div>'; }
	
	/**
	 * Function set_css
	 *
	 *
	 * This function can set which css need to use in form
	 * this function update $this->cssType variable and if pass URL this update $this->csslink_array also
	 *
	 * @param string : $cssLinks
	 * 	can pass which version of css need to use or can pass custom css link
	 * 	defualt css versions are
	 * 		1. new
	 * 		2. old
	 * 	custom css file can pass as full URL or relative URL base on base_url
	 * 
	 * @return	void
	 * @access	private
	 * @since	1.4
	 */
	public function set_css($cssLinks){
		switch ($cssLinks){
			case 'new': $this->cssType='new'; break;
			case 'old': $this->cssType='old'; break;
			default:
				$links_array = explode(',', $cssLinks);
				if(is_array($links_array)){
					$x=0;
					foreach ($links_array as $value){
						$this->csslink_array['custom'][$x] = $value;
						$x++;
					}
					$this->cssType='custom';
				}//end if
			break;
		}//end switch
	}//end set_css function
	
	/**
	 * Function get_cssFile
	 *
	 *
	 * This function get css file stor in $csslink_array and return css link tag string to init() function
	 *
	 * @param	None
	 * @return	string $links retusn string with html css link tag set base on which version
	 * @access	private
	 * @since	1.4
	 */
	private function get_cssFile(){
		$links='';
		switch ($this->cssType){
			case 'new':
				$file = $this->csslink_array['new'];
				$file = base_url().$file;
				$links = '<link rel="STYLESHEET" type="text/css" href="'.$file.'">';
			break;
			
			case 'old':
				$file = $this->csslink_array['old'];
				$file = base_url().$file;
				$links = '<link rel="STYLESHEET" type="text/css" href="'.$file.'">';
			break;
			
			case 'custom':
				foreach ($this->csslink_array['custom'] as $file){
					if(strrchr($file,'http')==''){
						$file = base_url().$file;
					}//end if
					$links .= '<link rel="STYLESHEET" type="text/css" href="'.$file.'">';
				}//end forecah
			break;
			default: $links ='Error passing css links'; break;
		}//end switch
		
		return $links;
	}//end get_cssFile() function
	
}//end of class form object

/**
 * Field class
 * 
 * 
 * Functions
 * 
 *  	1)  function createField
 *  	2)  function prepareEmptyRow
 *  	3)  function prepareTextbox
 *  	4)  function prepareTextarea
 *  	5)  function preparePassWord
 *  	6)  function prepareHiddenInput
 *  	7)  function prepareSelect
 *  	8)  function DropDown_multiple
 *  	9)  function DateField
 *  	10) function prepareCheckbox
 *  	11) function prepareRadioButtons
 *  	12) function prepareEmptyCell
 *  	13) function prepare_select_multiple
 *  	14) function display_field_msg
 * 
 * @package			BizyOffice\libraries\Form_object\Field
 * @version			1.4
 * @uses			
 * @see				
 * @copyright		2015, BizyCorp Internal Systems Development
 * @license			private, All rights reserved
 * @author			Mohamed Roshan
 * @created			Jun 12, 2013 by Mohamed Roshan
 * @modified		Nov 22, 2015 by nuwan.wickramarathne
 * @modification	header block updating
 * 
 */
 
class Field{
   /**
	* Property Content
	* @var $name
	*/
	var $name = null;
	
	/**
	 * Property Content
	 * @var $type
	 */
	var $type = null;
	
	/**
	 * Property Content
	 * @var $settings
	 */
	var $settings = null;
	
	/**
	 * Property Content
	 * @var $options
	 */
	var $options = array();
	
	/**
	 * Property Content
	 * @var $selectedOptions
	 */
	var $selectedOptions = array();
	
	/**
	 * Function __construct
	 *
	 * 
   	 * @param string $name - Name of the input 
	 * @param string $type - Type of the input (text/select/textarea/hidden)
	 * @param array $settings  - this is an associative array using this array you can set the status of the input. array keys are as follows,
   	 *			'value'=>'' - To set value for the input
	 *			'label'=>'' - To set field label on left side of the input
	 *			'before_field' =>'' - To print/add html elements (ex:<br>) or texts befor the element,
	 *			'after_field' => '' - To print/add html elements (ex:<br>) or texts after the element,
	 *			'required_mark'=>true - To show '*' mark after the field label to indicate required field. accepts only boolion true/false
	 *			'field_msg'=>'' - To set error messages or any messages below the input field
	 *			'style' => 'class = "template_name_class"' - To set CSS styling string ,
	 *			'disabled' => false - To set the field disabled. By default all fields are enabled 
	 *
	 * @param array $options - To pass <option> listing as an array in <select> element. Accepts array('value' => 'option text') format array
	 * @param array $selectedOptions - To pass selected <option> listing in multi select element. Accept array('val1','val2','val3') type of array
	 * 
	 *  ex:-
	 *	for hidden field 
	 *	$tp_id = new Field('tp_id','hidden',array('value'=>$tp_id,'label'=>'','before_field' =>'','after_field' => '','required_mark'=>null,'field_msg'=>''));
	 *    
	 *	for textbox
	 *	$tp_name = new Field('tp_name','text',	array('value'=>$tp_name,'label'=>'Template Name','before_field' =>'','after_field' => '','required_mark'=>true,'field_msg'=>'','style' => 'class = "template_name_class"','disabled' => true));
	 *
	 *	for select
	 *	$options = array('client' => 'Client','project' => 'Project','staff'=>'Staff');
	 *	$tp_type = new Field('tp_type','select',array('label'=>'Template Type','before_field' =>'','after_field' => '','required_mark'=>true,'field_msg'=>'','style' => 'class = "template_type_class"','disabled' => true),$options,$selectedValue );
	 *
	 *	for textarea
     *	$template = new Field('template','textarea',array('value'=>$template,'label'=>'Template','before_field' =>'','after_field' => '','required_mark'=>true,'field_msg'=>'','style' => 'class = "template_type_class"','disabled' => true,'cols' => 30,'rows' => 5));
	 *
	 * @return	void
	 * @access	private
	 * @since	1.4
	 */
	function __construct($name,$type,$settings,$options=null,$selectedOptions=null){
		$this->name = $name;
		$this->type = $type;
		$this->settings = $settings;
		$this->options = $options;
		$this->selectedOptions = $selectedOptions;
    	$this->settings['field_msg'] = empty($settings['field_msg'])? '': $settings['field_msg'];
	}//end of construct
	
	/**
	 * Function createField
	 *
	 *
	 * @todo	documenting
	 *
	 * @param	None
	 * @return	void
	 * @access	private
	 * @since	1.4
	 */
	public function createField(){
		switch ($this->type){
			case 'text': return $this->prepareTextbox(); break;
			case 'password': return $this->preparePassWord(); break;
			case 'hidden': return $this->prepareHiddenInput(); break;
			case 'select': return $this->prepareSelect(); break;
			case 'textarea': return $this->prepareTextarea(); break;
			case 'empty': return $this->prepareEmptyRow(); break;
      		case 'date': return $this->DateField(); break;
			case 'checkbox': return $this->prepareCheckbox(); break;
			case 'radio': return $this->prepareRadioButtons(); break;
			case 'htmlField': return $this->prepareEmplyCell(); break;
			case 'select_multiple': return $this->prepare_select_multiple(); break;
		}//end switch
	}//end of function
	
	/**
	 * Function prepareEmptyRow
	 *
	 *
	 * Prepares empty field 
	 * This funciton will echo html code to display a text input element
	 *
	 * @param	None
	 * @return	void
	 * @access	private
	 * @since	1.4
	 */
	private function prepareEmptyRow(){
		echo (isset($this->settings['before_field']))? $this->settings['before_field']:null;
		echo (isset($this->settings['id']))? 'id = "'.$this->settings['id'].'" ':null;
		
		echo (isset($this->settings['datatype']))? 'datatype = "'.$this->settings['datatype'].'" ':null;
		echo($this->settings['required_mark'])? ' required ':null;
		
		echo (isset($this->settings['value']))? 'value = "'.$this->settings['value'].'" ':null;
		echo (isset($this->settings['style']))? $this->settings['style']:null;
		echo (isset($this->settings['disabled']) && $this->settings['disabled'])? 'disabled="disabled"':null;	
		echo (isset($this->settings['after_field']))? $this->settings['after_field']:null;
	}//end of function
	
	/**
	 * Function prepareTextbox
	 *
	 *
	 * Prepares text input element
	 * This funciton will echo html code to display a text input element
	 *
	 * @param	None
	 * @return	void
	 * @access	private
	 * @since	1.4
	 */
	private function prepareTextbox(){
		echo (isset($this->settings['before_field']))? $this->settings['before_field']:null;
		echo '<input type="text" ';
		echo 'name = "'.$this->name.'" ';
		echo (isset($this->settings['id']))? 'id = "'.$this->settings['id'].'" ':null;
		
		echo (isset($this->settings['datatype']))? 'datatype = "'.$this->settings['datatype'].'" ':null;
		echo($this->settings['required_mark'])? ' required ':null;
		
		echo (isset($this->settings['value']))? 'value = "'.$this->settings['value'].'" ':null;
		echo (isset($this->settings['style']))? $this->settings['style']:null;
		echo (isset($this->settings['disabled']) && $this->settings['disabled'])? 'disabled="disabled"':null;	
		echo ' />';
		echo (isset($this->settings['after_field']))? $this->settings['after_field']:null;
		echo $this->display_field_msg($this->name, $this->settings['field_msg']);
	}//end of function
	
	/**
	 * Function prepareTextarea
	 *
	 *
	 * Prepares textarea input element
	 * This funciton will echo html code to display a textarea input element
	 *
	 * @param	None
	 * @return	void
	 * @access	private
	 * @since	1.4
	 */
	private function prepareTextarea(){
	
		echo (isset($this->settings['before_field']))? $this->settings['before_field']:null;
		echo '<textarea ';
		echo 'name = "'.$this->name.'" ';
		echo (isset($this->settings['id']))? 'id = "'.$this->settings['id'].'" ':null;
		
		echo (isset($this->settings['datatype']))? 'datatype = "'.$this->settings['datatype'].'" ':null;
		echo($this->settings['required_mark'])? ' required ':null;
		
		echo (isset($this->settings['style']))? $this->settings['style']:null;
		echo (isset($this->settings['disabled']) && $this->settings['disabled'])? 'disabled="disabled"':null;
		echo (isset($this->settings['cols']))? ' cols="'.$this->settings['cols'].'"':'cols="40" ';
		echo (isset($this->settings['rows']))? ' rows="'.$this->settings['rows'].'"':'rows="5" ';
		echo ' >';
		echo (isset($this->settings['value']))? $this->settings['value']:null;
		echo '</textarea>';
		echo (isset($this->settings['after_field']))? $this->settings['after_field']:null;
		echo $this->display_field_msg($this->name, $this->settings['field_msg']);
	
	}//end of function
	
	/**
	 * Function preparePassWord
	 *
	 *
	 * Prepares password input element
	 * This funciton will echo html code to display a textarea input element
	 *
	 * @param	None
	 * @return	void
	 * @access	private
	 * @since	1.4
	 */
	private function preparePassWord(){
	
		echo (isset($this->settings['before_field']))? $this->settings['before_field']:null;
		echo '<input type="password" ';
		echo 'name = "'.$this->name.'" ';
		echo (isset($this->settings['id']))? 'id = "'.$this->settings['id'].'" ':null;
		
		echo (isset($this->settings['datatype']))? 'datatype = "'.$this->settings['datatype'].'" ':null;
		echo($this->settings['required_mark'])? ' required ':null;
		
		echo (isset($this->settings['value']))? 'value = "'.$this->settings['value'].'" ':null;
		echo (isset($this->settings['style']))? $this->settings['style']:null;
		echo (isset($this->settings['disabled']) && $this->settings['disabled'])? 'disabled="disabled"':null;	
		echo ' />';
		echo (isset($this->settings['after_field']))? $this->settings['after_field']:null;
		echo $this->display_field_msg($this->name, $this->settings['field_msg']);
	
	}//end of function
	
	/**
	 * Function prepareHiddenInput
	 *
	 *
	 * Prepares hidden input element
	 * This funciton will echo html code to include a hidden text input element
	 *
	 * @param	None
	 * @return	void
	 * @access	private
	 * @since	1.4
	 */
	private function prepareHiddenInput(){
	  echo (isset($this->settings['before_field']))? $this->settings['before_field']:null;  //Aded by WCD
		echo '<input type="hidden" ';
		echo 'name = "'.$this->name.'" ';
		echo (isset($this->settings['id']))? 'id = "'.$this->settings['id'].'" ':null;
		echo (isset($this->settings['value']))? 'value = "'.$this->settings['value'].'" ':null;
    	echo (isset($this->settings['style']))? $this->settings['style']:null; //Aded by WCD
		echo ' />';
		echo (isset($this->settings['after_field']))? $this->settings['after_field']:null;  //Aded by WCD	
	}//end of function

	/**
	 * Function prepareSelect
	 *
	 *
	 * Prepares select input element
	 * This funciton will echo html code to prepare a select element
	 *
	 * @param	None
	 * @return	void
	 * @access	private
	 * @since	1.4
	 */
	private function prepareSelect(){
	
		$selectedOption = $this->selectedOptions;
		$selected = '';
		
		echo '<select ';
		echo 'name = "'.$this->name.'" ';
		echo (isset($this->settings['id']))? 'id = "'.$this->settings['id'].'" ':null;
		
		echo (isset($this->settings['datatype']))? 'datatype = "'.$this->settings['datatype'].'" ':null;
		echo($this->settings['required_mark'])? ' required ':null;
		
		echo (isset($this->settings['style']))? $this->settings['style']:null;
		echo (isset($this->settings['disabled']) && $this->settings['disabled'])? 'disabled="disabled"':null;	
		echo ' >';
		foreach($this->options as $option=>$optionText){
			
			if($selectedOption == $option){
				$selected = 'selected="selected"';
			}else{
				$selected = '';
			}//end if
			
			echo '<option value="'.$option.'" '.$selected.'>'.$optionText.'</option>';
			
		}//end foreach
		echo ' </select>';
    	echo (isset($this->settings['after_field']))? $this->settings['after_field']:null;  //Aded by WCD	
		echo $this->display_field_msg($this->name, $this->settings['field_msg']); // added by CD on 19/08/2013	
	}//end of function
	
	/**
	 * Function DropDown_multiple
	 *
	 *
	 * This funciton will echo html code to prepare a multiple select element
	 *
	 * @param	None
	 * @return	void
	 * @access	private
	 * @since	1.4
	 */
	private function DropDown_multiple($data) {
		echo '<select ';
		foreach($data['attributes'] as $attribute => $value){
			echo $attribute .'= "'. $value;
			echo ($attribute == 'name')? '[]':'';
			echo '" ';
		}
		echo ' multiple>';
	
		foreach($data['options'] as $optionVal => $optionText){
			echo '<option value ="'.$optionVal.'" ';
			echo (in_array( $optionVal,$data['selected_vals'])) ? 'selected = "selected"' :'';
			echo '>'. $optionText. '</option>';
		}
		echo '</select>';
		$this->addMsgSpan($data['attributes']['name'],$data['field_msg']);
	}
	
	/**
	 * Function DateField
	 *
	 *
	 * Prepares DHTMLX calander attached text field
	 *
	 * @param	None
	 * @return	void
	 * @access	private
	 * @since	1.4
	 */
	private function DateField(){
		echo (isset($this->settings['before_field']))? $this->settings['before_field']:null;
		echo '<input type="text" ';
		echo 'name = "'.$this->name.'" ';
		echo (isset($this->settings['id']))? 'id = "'.$this->settings['id'].'" ':null;
		echo (isset($this->settings['value']))? 'value = "'.$this->settings['value'].'" ':null;
		
		echo (isset($this->settings['datatype']))? 'datatype = "'.$this->settings['datatype'].'" ':null;
		echo($this->settings['required_mark'])? ' required ':null;
		
		echo (isset($this->settings['style']))? $this->settings['style']:null;
		echo (isset($this->settings['disabled']) && $this->settings['disabled'])? 'disabled="disabled"':null;
		echo ' />';
		echo (isset($this->settings['after_field']))? $this->settings['after_field']:null;
		echo $this->display_field_msg($this->name, $this->settings['field_msg']);
		echo '
		<script>
			var calendar_'.$this->name.';
			calendar_'.$this->name.' = new dhtmlXCalendarObject(["'.$this->settings['id'].'"]);
		</script>';
	}
	
	/**
	 * Function prepareCheckbox
	 *
	 *
	 * Prepares checkbox element
	 * This funciton will echo html code to prepare checkbox element(s)
	 *
	 * @param	None
	 * @return	void
	 * @access	private
	 * @since	1.4
	 */
	private function prepareCheckbox(){
		$selectedOption = $this->selectedOptions;
		$value = $this->settings['value'];
		$selected = '';
		if($selectedOption == $value){ $selected = 'checked="checked"'; }
		else{ $selected = ''; }//end if
		echo '<input type="checkbox" ';
		echo 'name = "'.$this->name.'" ';
		echo (isset($this->settings['id']))? 'id = "'.$this->settings['id'].'" ':null;
		echo (isset($this->settings['style']))? $this->settings['style']:null;
		echo (isset($this->settings['disabled']) && $this->settings['disabled'])? 'disabled="disabled"':null;
		echo $selected;
		echo ' >'.$optionText.'<br>';
	}//end of function
	
	/**
	 * Function prepareRadioButtons
	 *
	 *
	 * Prepares radio input element
	 * This funciton will echo html code to prepare radio button element(s)
	 *
	 * @param	None
	 * @return	void
	 * @access	private
	 * @since	1.4
	 */
	private function prepareRadioButtons(){
		$selectedOption = $this->selectedOptions;
		$optionsArray =  (array)$this->options;
		$selected = '';
	
		foreach($optionsArray as $option=>$optionText){
			if($selectedOption == $option){ $selected = ' checked '; }
			else{ $selected = ''; }//end if
				
			echo '<input type = "radio" ';
			echo ' name = "'.$this->name.'" ';
			echo (isset($this->settings['id']))? ' id = "'.$this->settings['id'].'" ':null;
			echo (isset($this->settings['style']))? $this->settings['style']:null;
			echo (isset($this->settings['disabled']) && $this->settings['disabled'])? ' disabled="disabled" ':null;
			echo ' value = "'.$option.'" ';
			echo $selected;
			echo ' >'.$optionText.'<br>';
		}//end foreach
	}//end of function
	
	/**
	 * Function prepareEmplyCell
	 *
	 *
	 * Prepares empty cell
	 * This funciton will echo html code to prepare empty cell
	 *
	 * @param	None
	 * @return	void
	 * @access	private
	 * @since	1.4
	 */
	private function prepareEmplyCell(){
		echo (isset($this->settings['style']))? "<div ".$this->settings['style'].">":null;
		echo (isset($this->settings['value']))? $this->settings['value']:null;
		echo (isset($this->settings['style']))? "</div>":null;
		echo $this->display_field_msg($this->name, $this->settings['field_msg']);
	}
	
	/**
	 * Function prepare_select_multiple
	 *
	 *
	 * Prepares multiple select input element
	 * This funciton will echo html code to prepare a multiple select element
	 *
	 * @param	$field
	 * @return	void
	 * @access	private
	 * @since	1.4
	 */
	private function prepare_select_multiple() {
		$selectedOption = $this->selectedOptions;
		echo '<select ';
		echo 'name = "'.$this->name.'" multiple ' ;
		echo (isset($this->settings['id']))? 'id = "'.$this->settings['id'].'" ':null;
		echo (isset($this->settings['style']))? $this->settings['style']:null;
		echo (isset($this->settings['disabled']) && $this->settings['disabled'])? 'disabled="disabled"':null;
		echo ' >';
		foreach($this->options as $option=>$optionText){
			if($selectedOption == $option){ $selected = 'selected="selected"'; }
			else{ $selected = ''; }//end if
				
			echo '<option value ="'.$option.'" ';
			echo (in_array( $option,$selectedOption)) ? 'selected = "selected"' :'';
			echo '>'. $optionText.'</option>';
		}//end foreach
		echo '</select>';
	}
	
	/**
	 * Function display_field_msg
	 *
	 *
	 * Prepares field error message div.
	 * This function will return
	 *
	 * @param	string $name
	 * @param 	string $msg
	 * @return	string A generated HTML <DIV> element with supplied string
	 * @access	private
	 * @since	1.4
	 */
	private function display_field_msg($name,$msg){
		return '<div id="'.$name.'_msg_div" class="field_msg_div_class" >'.$msg.'</div>';		
	}//end of function
}//end of Fields();
?>
