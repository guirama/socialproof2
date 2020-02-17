<?php
		/**
		 * Auto Generated CI View
		 *
		 *
		 * This file produces DHTMLX grid feed for pb listing using a function called 'converDHTMLXGrid()'
 		 *  Which is located in CIGen helper file  
		 *
		 * @package			CIGEN\view\bugs_gridfeed
		 * @version			1.0
		 * @uses
		 * @see
		 * @copyright		2016, BizyCorp Internal Systems Development
		 * @license			private, All rights reserved
		 * @author			Mohamed Ruzaik Mohamed Roshan <roshan@ekwa.com>
		 *
		 */
		
		if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		
		
		/**
		 * This is a view template for bugs table of bugzilla app.
		 *
		 *
		 * This file produces DHTMLX grid feed for pb listing using a function called 'converDHTMLXGrid()'
 		 *  Which is located in CIGen helper file  
		 *
		 *  Usage :- returns data in specified format xml/html
		 *
		 * @package      CIGEN\view\bugs_gridfeed
		 * @version      1.0
		 * @copyright    2016, BizyCorp Internal Systems Development
		 * @license      private, All rights reserved
		 * @author       Mohamed Ruzaik Mohamed Roshan <roshan@ekwa.com>
		 * @uses
		 * @see
		 * @created    	Jan 29, 2020
		 * @modified   	Jan 29, 2020
		 * @modification
		*/
class bugs_gridfeed{
	// Just a dummy clas for phpdoc to catch the doc header.
}


$order   = array("\r\n", "\n", "\r");
$colList = array('id','component','summary','assigned_to','status','creator');

if($format=='XML') {
  
  if ($searchOn == 'true') {
    $gridFeed = converDHTMLXGrid($data, true, 0,500,false,null,'',$colList);
  } else { 
    $gridFeed = converDHTMLXGrid($data, true, 0,500,true,null,'',$colList);
  }
}
$gridFeed = str_replace($order, '',$gridFeed);
header("Content-type:text/xml");
echo $gridFeed;

?>
