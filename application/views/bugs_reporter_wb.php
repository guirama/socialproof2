<?php
		/**
		 * Auto Generated CI View
		 *
		 *
		 * This is the work bench implementaion script
		 *
		 * @package			CIGEN\view\bugs_reporter_wb
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
		 *  This is the work bench implementaion script
		 *
		 *	This file handles all functions for workbench object for Bugzilla CI library UI and
		 *  facilitates the users with the table maintenence in a user friendly way.
		 *  All the call back functions are written on this page to be called by the toolbar buttons.
		 *
		 * @package      CIGEN\view\bugs_reporter_wb
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
		class bugs_reporter_wb{
			// Just a dummy clas for phpdoc to catch the doc header.
		}


/**
 * Include the common header file
 */

require_once('js-css-loader.php');
?>   
<style>body{ margin:0;}</style>
<div id="divBench" style="width:99.9%;height:99.9%;"></div>

<script>

var wbContainer;
var wb;
var bugGrid;
var rowid;
var myLayout;
var e = null;

//create the page main layout
//wbContainer = new dhtmlXLayoutObject("divBench", "1C");
//wbContainer.cells('a').hideHeader();

//now initiate work bench and attache it to page layout.
wb = new workbenchObj();
wb.workBench = document.body;
//wb.workBench = document.getElementById("divBench"); //assigning wb container of this page to wb object

//just load with one record query so we avoid the dual loading of data. WCD _Changed_
wb.url = '<?php echo site_url()?>/bugs_reporter_ctr/index/false/10/0/bugs_reporter_index/XML';

//this will ensure the full loading of data to grid WCD          _Changed_
wb.gridreloadurl = '<?php echo site_url()?>/bugs_reporter_ctr/index/false/10/0/bugs_gridfeed/XML';


//https://ekwa.com/Progressbar/resources/img/common/imgs/reset.png
wb.toolBarIconpath = '<?php echo $this->config->item('image_url');?>';
wb.formBarIconpath = '<?php echo $this->config->item('image_url');?>';
wb.formVar = 'myform';

//can pass properties to manuputate toolbar objects
wb.gridLayoutWidth = 100;
wb.toolBarComponent='grid'; 
wb.toolBarDefaultitems= true;      //add defult items
wb.toolBarVar='gridtoolbar';
wb.toolBarNotSet="search";
wb.toolBarNotSet=['edit','delete'];//'edit','add','delete'

//form related variables
wb.formBarComponent='form';    
wb.formBarDefaultitems = true; 
wb.formBarNotSet=['save'];
wb.formUrl = '<?php echo site_url('/bugs_reporter_ctr/add_bug')?>';
wb.formDataUrl = '<?php echo site_url('/bugs_reporter_ctr/add_bug')?>';

wb.formWidth = 500;
wb.searchOnEnter = true;


/*======== Begin callback function list==========*/
 
// callback functions to load in wb 
var doAddForms = function (){
	
	var debug = false;
	if (debug) console.log('Add form url:-',wb.formUrl);	
	myLayout = wb.getFormLayout();
	myLayout.attachURL(wb.formUrl,false); 
	myLayout = wb.getFormLayout();
	ifr = myLayout.getFrame();

	//to add custome buttons to form toolbar
	var myForm = wb.getFormToolbar();
	formBar = myForm.toolbar;
		
	var isAddset = formBar.getPosition('save');
	
	if (debug) console.log('ID position :-',isAddset);
	
	if(isAddset==null){
		formBar.addButton('save',1,'Save','save.gif','save_as_dis.png'); 
	}
	
	formBar.showItem('save');	
	formBar.showItem('reset');   
	
	return true;	
};//End of doAddForms

var doSaveForm = function (){

	myLayout = wb.getFormLayout();	
	ifr = myLayout.getFrame();	
	//ifr.contentWindow.submitForm();
	return ifr.contentWindow.formSubmit();
	
};//End of doSaveForm  

var doEditForm = function () {
	return true;		
};//end of doEditForm

var doDeleteForm = function (){
	return true; 
};//End of doDeleteTMForm

var doResetForm = function(){

	myLayout = wb.getFormLayout();	
	ifr = myLayout.getFrame();  	
  	ifr.contentWindow.reset_form();  	
  	return true;
  	
};//end of doResetForm


/*========End of callback function list==========*/

/*
 * following callback function variables must be declared befor passing to wb. 
 * otherwise it will return undifiend error 
 */

wb.setGridAddCallback(doAddForms);
wb.setGridEditCallback(doEditForm);
wb.setFormSaveCallback(doSaveForm);
wb.setFormResetCallback(doResetForm);



//search is active in toolbar7ee
//http://bizydads.com/roshan/Progressbar/Progressbar/index.php/pb_ms/index/true/10/0/pb_ms_gridfeed/XML/48?MS_id_equal=0&ms_status_equal=3&filtersOn=true
wb.searchactive = 'disable';//'enable';
var mySearchColumns = [];
wb.searchColumns=mySearchColumns;
//after setting up all wb properties finallay initiat wb.
wb.init();
//<?php echo $reporter; ?>
</script>
