<?php
		/**
		 * Auto Generated CI View
		 *
		 *
		 * This is a view template for all tables. 
		 *
		 * @package			HOF\view\data_feed_template
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
		 * This is a view template for all tables. 
		 * 
		 * 
		 * It supports to crate a xml / html feed of data.
		 * the result can be used on grid / html table listing of data based on the format.
		 *
		 *  Usage :- returns data in specified format xml/html
		 *
		 * @package      HOF\view\data_feed_template
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
class data_feed_template{
	// Just a dummy clas for phpdoc to catch the doc header.
}
		
	$order   = array("\r\n", "\n", "\r");
	if($format=='XML') {
	  if ($searchOn == 'true') {
	    $objXML = converDHTMLXGrid($data, true, 0,sizeof($data['dataset']['result_set']),false, $widths ,$cellStyles ,$collist,$visibilityList);
	    
	  } else { 
	    $objXML = converDHTMLXGrid($data, true, 0,sizeof($data['dataset']['result_set']),true,$widths ,$cellStyles ,$collist,$visibilityList);
	    
	  }
	
	$objXML = str_replace($order, '',$objXML);
	header("Content-type:text/xml");
	echo $objXML;
	
	}else{
		
	  if ($htmlCss !== false && strlen($htmlCss)>0) $htmlCss = base_url("public/css/$htmlCss.css");
		
	  $objHTML = convertHTMLTable($data,$widths,$collist,$htmlCss);
	   echo $objHTML;
	}


?>
