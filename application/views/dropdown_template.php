<?php
		/**
		 * Auto Generated CI View
		 *
		 *
		 * This view file is created for the dropdown component of the controllers.
		 *
		 * @package			HOF\view\dropdown_template
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
		 * 	This view file is created for the dropdown component of the controllers.
		 * 
		 * 
		 *  Cigen common helper will be accessed through this file and the dropdown controlle will be generated.
		 *  All the nesessary information for the controlle will be sent from the controller function to this file as an array
		 *  
		 *  $data is an associate array which contains the data and other information
		 *  $nameTag, field name
		 *  $label , the label to display
		 *  $selectByText, selected text	
		 *  $selectByValue, selected value
		 *  $outFormat, out put format
		 *  $isMultiple, is multiple select (true/false)
		 *  $display , display text column / field of option text
		 *  $required, true/false to set if the field is a required field / not
		 *  
		 * @package      HOF\view\dropdown_template
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
class dropdown_template{
	// Just a dummy clas for phpdoc to catch the doc header.
}

	$array = array(
		'data' => $data,
   		'fieldName' => $nameTag,
   		'label' => $label,
   		'selectByText' => $selectByText,
   		'selectByVal' => $selectByValue,
   		'format' => $outFormat,
  		'multiple' => $isMultiple,
		'display' => $display,
		'required' => $required
	);
	if(isset($selectByText)){$array['selectByText'] = $selectByText;}
	if(isset($selectByValue)){$array['selectByVal'] = $selectByValue;}
	if(isset($optionsOnly)){$array['optionsOnly'] = $optionsOnly;}
	if(isset($groupBy)){$array['groupBy'] = $groupBy;}
	if(!empty($codename)){$array['codename'] = $codename;}
	dropdown($array);
?>
