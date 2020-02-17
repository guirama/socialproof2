<?php
		/**
		 * Auto Generated CI View
		 *
		 *
		 * This is main view file of spo_options management. 
		 *
		 * @package			HOF\view\spo_options_view
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
		 *  This is main view file of spo_options management. 
		 *  
		 *  
		 *  It contains the front end (view) of that. Its
		 *  created with dhtmlx grid component.
		 *  Usage :- controller function pass parameters to view to implement the view. 
		 *
		 * @package      HOF\view\spo_options_view
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
class spo_options_view{
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

$log_create = new log_object();
$log_create->set_disable($this->config->item('log_status'));
$log_create->set_userDetails($user_name, $user_type);
$log_create->set_otherDetails(array('Mode'=>'spo_options_View','Data'=>'-'));
$log_create->init();
 
?>
<div id="info" style="width: 550px; padding: 3px; margin: 3px; text-align: center; font-family:Arial; font-size:13px; font-style:italic; color:red; display:none;"></div>
<div id="toolbarObj"></div>
<div id="gridbox" style="width:100%;height:95%;"></div>
<div id="recinfoArea"></div>
<script>

var wb;
var dataGrid;
var debug = true;

function createdataGrid(griddiv) {
    
    if (debug) console.log('parent.wb :-',wb);

    dataGrid= new dhtmlXGridObject(griddiv);
    dataGrid.setImagePath("<?php echo $this->config->item('image_url');?>");
    dataGrid.enableMultiline(true); 

	dataGrid.setHeader(",,,");
	dataGrid.setInitWidths("75,75,75,75");
	dataGrid.setEditable("false,false,false,false");
	//dataGrid.setColTypes("ro,ro");
	//dataGrid.setColSorting("int,str");
	//dataGrid.setColumnsVisibility("false,false");

    dataGrid.enableMultiline(true); 

    dataGrid.attachEvent("onRowSelect", function(id,ind){ 

			row_id = id;  //Set a global var with the selected id or this.selectedRow
						
			wb.toolBarVar.enableItem('edit');
			wb.toolBarVar.enableItem('delete');

    });

   dataGrid.attachEvent("onXLE",function() {wb.workBench.progressOff();});

   dataGrid.attachEvent("onXLS", function() {
		dataGrid.clearSelection();
		wb.toolBarVar.disableItem('edit');
		wb.toolBarVar.disableItem('delete');
        wb.workBench.progressOn();

        });

    
    dataGrid.init();
    dataGrid.enablePaging(true, 25, 3, "recinfoArea");
    dataGrid.setPagingSkin("toolbar", "dhx_skyblue");
    dataGrid.setSkin("dhx_skyblue");
    
    wsGridURL=wb.gridreloadurl ;
	
	dataGrid.loadXML(wsGridURL);

    wb.grid=dataGrid;   

    var mySearch = wb.getSearch();
    mySearch.grid = dataGrid;
    
}
//Set proper grid height dynamicaly
<?php if (ENVIRONMENT == 'development') { ?>
  document.getElementById('gridbox').style.height=wb.getGridLayout().getHeight()-(wb.toolBarVar.cont.clientHeight);
<?php }else{ ?>
  document.getElementById('gridbox').style.height=wb.getGridLayout().getHeight()-(wb.toolBarVar.cont.clientHeight * 2);
<?php } ?>

createdataGrid('gridbox');

</script>
