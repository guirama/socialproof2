<?php
		/**
		 * Auto Generated CI View
		 *
		 *
		 * This file handles all functions for workbench object for Bugzilla CI library UI
		 *
		 * @package			CIGEN\view\bugs_reporter_view
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
		 *  This file handles all functions for workbench object for Bugzilla CI library UI
		 *  
		 *  
		 *  It contains the front end (view) of that. Its
		 *  created with dhtmlx grid component.
		 *  Usage :- controller function pass parameters to view to implement the view. 
		 *
		 * @package      CIGEN\view\bugs_reporter_view
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
class bugs_reporter_view{
	// Just a dummy clas for phpdoc to catch the doc header.
}

?>
<style>
html,body{ margin:0;}
td{ vertical-align:top;}
</style>    

<div id="toolbarObj"></div>
<div id="divGrid" style="width:99.9%;height:99.9%;"></div>
<div id="recinfoArea"></div>

<script>
var rowid;
var bugs_grid;

function create_Bugs_Grid(griddiv) {

	bugs_grid = new dhtmlXGridObject(griddiv);
    bugs_grid.setImagePath("<?php echo $this->config->item('image_url');?>");            // _Changed_
   // bugs_grid.enableCellIds(true);
    //bugs_grid.setInitWidths("30,150,150");
    bugs_grid.enableMultiline(true);
    //What more should be here WCD
    
  
    bugs_grid.attachEvent("onRowSelect", function(id,ind){      
        rowid = id;         
        if (debug) console.log('selected grid row id in index page :-',id);       
    });


    bugs_grid.attachEvent("onXLS", function() {	   
        wb.workBench.progressOn();
    });  
  
    
    bugs_grid.attachEvent("onXLE",function() {
        //To turn off Tooltips
        var colNum=bugs_grid.getColumnsNum();
        var colstring = '';
        for (var i=0; i<colNum; i++) {
          colstring += 'false,';
        }
        colstring.substr(0,colstring.length - 2);
        bugs_grid.enableTooltips(colstring);        
        
        //To Handle grid load status
        wb.workBench.progressOff();        
     });
    
    bugs_grid.init();
        
    bugs_grid.setSkin("<?php echo $this->config->item('dhtmlx_grid_skin')?>"); // _Changed_    
    if(typeof wb !== 'undefined'){	
    	wb.grid=bugs_grid;   //Edited by WCD
    	var mySearch = wb.getSearch();
    	mySearch.grid = bugs_grid;
    }

    bugs_grid.loadXML('<?php echo site_url('/bugs_reporter_ctr/index/false/10/0/bugs_gridfeed/XML')?>');
    //bugs_grid.loadXML(wb.gridreloadurl);  // Use WB property to load the data. WCD _Changed_
	
}//end of function

//---------------------------------                    _Changed_
//Set proper grid height dynamicaly Allow room for paging toolbar if applicable
<?php if (ENVIRONMENT == 'development') { ?>
  document.getElementById('divGrid').style.height=wb.getGridLayout().getHeight()-(wb.toolBarVar.cont.clientHeight);
<?php }else{ ?>
  document.getElementById('divGrid').style.height=wb.getGridLayout().getHeight()-(wb.toolBarVar.cont.clientHeight * 2);
<?php } ?>
//----------------------------------

create_Bugs_Grid('divGrid');
</script>
