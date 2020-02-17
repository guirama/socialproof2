<?php
		/**
		 * Auto Generated CI View
		 *
		 *
		 * This is the work bench implementaion script
		 *
		 * @package			HOF\view\spo_term_relationships_wb
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
	 	 *  This is the work bench implementaion script
	 	 *	
	 	 *	This script creates an instnce of the work bench object for spo_term_relationships table and 
	 	 *  facilitates the users with the table maintenence in a user friendly way.
	     *  All the call back functions are written on this page to be called by the toolbar buttons.
		 *
		 * @package      HOF\view\spo_term_relationships_wb
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
class spo_term_relationships_wb{
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

$log_create = new log_object();
$log_create->set_disable($this->config->item('log_status'));
$log_create->set_userDetails($user_name, $user_type);
$log_create->set_otherDetails(array('Mode'=>'spo_term_relationships_WB','Data'=>'-'));
$log_create->init();

?>
<style>
body{ margin:0;}
</style>

<div id="divBench" style="width:99.9%;height:98%;"></div>

<script>
//CORS handling by WCD
window.addEventListener("message", receiveMessage, false);

function receiveMessage(event)
{
  switch (event.data){
  case "setSize":
	  wbFb.getWb().setSizes();
	  break;
  }
}
//-------------------------------

       wb= new workbenchObj();

       wb.gridVarName='dataGrid';

       wb.url = '<?php echo base_url()?>index.php/spo_term_relationships/index/false/0/0/spo_term_relationships_view/XML/';
       
  	   wb.gridreloadurl = '<?php echo base_url()?>index.php/spo_term_relationships/index/true/0/0/data_feed_template/XML/';
       
       wb.workBench = document.getElementById("divBench");  

       var myform;

       wb.form = myform;

       wb.formVar = 'myform';

       //can pass properties to manuputate toolbar objects

       wb.toolBarComponent='grid'; 
       wb.toolBarIconpath='<?php echo $this->config->item('image_url');?>';
       wb.toolBarDefaultitems=true;      //add defult items
       wb.toolBarDisabled=['edit','delete'];
       wb.toolBarVar='gridtoolbar';

       wb.formBarComponent='form';    
  	   wb.formBarIconpath='<?php echo $this->config->item('image_url');?>';
       wb.formBarDefaultitems = true; 

       wb.formUrl = '<?php echo base_url()?>index.php/spo_term_relationships/loadForm/';
       wb.formdataUrl = '<?php echo base_url()?>index.php/spo_term_relationships/data_form/';
       wb.formDataUrl = '<?php echo base_url()?>index.php/spo_term_relationships/save/';
       wb.formDelUrl = '<?php echo base_url()?>index.php/spo_term_relationships/delete/';

       wb.formWidth = 450;
       wb.gridLayoutWidth = 600;




  /*======== Begin callback function list==========*/

  var doAddForm = function (){
       
      var isIdset = formBar.getPosition('save');
      
      if (debug) console.log('send position :-',isIdset);

      if(isIdset===null){

            formBar.addButton('save',0,'Save','save.gif','save_dis.gif'); 
            formBar.removeItem('delete');
  			formBar.enableItem('reset');
      }
 
      var myLayout = wb.getFormLayout();
      
      myLayout.attachURL(wb.formdataUrl+'add');
     
    return true;

  };



  var doEditForm = function () {
      
      var isIdset = formBar.getPosition('save');
      
      if (debug) console.log('send position :-',isIdset);

      if(isIdset===null){

            formBar.addButton('save',0,'Save','save.gif','save_dis.gif'); 
            formBar.removeItem('delete');
  			formBar.enableItem('reset');
      }
   	
      var search = wb.getSearch();
   	  var row_id = search.grid.getSelectedRowId();

   	  var myEdit = row_id;

   	  edit=myEdit.replace(/,/g,"~");  
      
      var myLayout = wb.getFormLayout();
      
      myLayout.attachURL(wb.formdataUrl+'edit/'+edit);
  	  if (debug) console.log('Edit form load url is :-',wb.formdataUrl+edit);
  	
      return true;

  };


  var doDeleteForm = function (){ 
       
      var isIdset = formBar.getPosition('delete');

      if (debug) console.log('send position :-',isIdset);

      if(isIdset===null){

       formBar.addButton('delete',0,'Delete','delete.png','delete_dis.png'); 
       formBar.removeItem('save');
   	   formBar.disableItem('reset');
      }

       
  	  var search = wb.getSearch();
      var row_id = search.grid.getSelectedRowId();
  	  var myEdit = row_id;

      edit=myEdit.replace(/,/g,"~"); 
      var myLayout = wb.getFormLayout();

      myLayout.attachURL(wb.formdataUrl+'delete/'+edit);

      if (debug) console.log('Delete form load url is :-',wb.formdataUrl+'delete/'+edit);

      return true;

   };
   
   var doDelete = function (){
		var myLayout = wb.getFormLayout();
		ifr = myLayout.getFrame();
		
      var search = wb.getSearch();           
      var prime_id= "object_id,term_taxonomy_id:"+search.grid.cells(search.grid.getSelectedId(),0).getValue();

		var loader = dhtmlxAjax.getSync(wb.formDelUrl+prime_id);
       
	    if (debug) console.log('formDelUrl :- ',wb.formDelUrl+prime_id);  
	    console.log('loader :- ',loader); 
	    if(loader.xmlDoc.responseText=="") {
				ifr.contentWindow.document.getElementById('info2').innerHTML= 'Record deleted successfully!.';
				setTimeout(doGridUpdate,3000);
		}else{
				ifr.contentWindow.document.getElementById('info2').innerHTML= loader.xmlDoc.responseText;
		}
	    
		
	 };
	
	 /**
	 * thhis function can be used to delete record without loading a form, 
	 * this wil ask for confirmation and proceed, 
	 * developer should updated only the delete callback to use this function
	 */
	var doDeleteWithoutForm = function (){
			
	     var search = wb.getSearch();           
	     var prime_id= "object_id,term_taxonomy_id:"+search.grid.cells(search.grid.getSelectedId(),0).getValue();
	
	     var b = (confirm('Are you sure you want to delete this record?'));
	
			if(b){
			   var loader = dhtmlxAjax.getSync(wb.formDelUrl+prime_id);
	      
		       if (debug) console.log('formDelUrl :- ',wb.formDelUrl+prime_id);  
	
		        if(loader.xmlDoc.responseText=="") {
     				ifr.contentWindow.document.getElementById('info2').innerHTML= 'Record deleted successfully!.';
     				setTimeout(doGridUpdate,3000);
     			}else{
				ifr.contentWindow.document.getElementById('info2').innerHTML= loader.xmlDoc.responseText;
				}
		       	
			}
	};

   var doSave = function (){
    
		var myLayout = wb.getFormLayout();
		ifr = myLayout.getFrame();
		
		var checking_form = "";
		checking_form = ifr.contentWindow.inputValidate();
		
	    if (checking_form == true) {  
	     
	    	var returnVal = false;
			ifr.contentWindow.document.forms[0].submit();
			setTimeout(doGridUpdate,3000);

	       	return returnVal
	       	
	    }else{
			var er =checking_form;
	  		var error_text="";
	  		for(var i=1; i<= er.length; i++){ error_text += er[i-1]+'<br />'; }
	  		console.log('error_text :-',error_text+er.length);
	  		
	  		ifr.contentWindow.document.getElementById('info2').innerHTML= error_text;
	    }
    
   }; 
 

  	var doGridUpdate = function (){
  	
  		console.log('formstatus :-',ifr.contentWindow.document.getElementById('formstatus').value); 
		if(ifr.contentWindow.document.getElementById('formstatus').value !='failure'){
	  	myLayout.collapse();
	  	search.grid.updateFromXML(wb.grid.xmlLoader.filePath,true,true)
		} 	
  	}
  	
  	var doResetForm = function (){
  	
  		var returnVal = false; 
  	  	var myLayout = wb.getFormLayout();

  		if (_isIE) {
  			 myLayout.getFrame().contentWindow.document.forms[0].reset();
  	    } else {
  			myLayout.getFrame().contentDocument.forms[0].reset();
  	    }
  		
  		return returnVal;
  	}; 

    wb.setGridAddCallback(doAddForm)   ;
    wb.setGridEditCallback(doEditForm)   ;
    wb.setGridDelCallback(doDeleteForm)   ;
  //wb.setGridDelCallback(doDeleteWithoutForm)   ;  
    wb.setFormSaveCallback(doSave)   ;
  	wb.setFormResetCallback(doResetForm);

    //search is active in toolbar

    wb.searchactive = 'enable';
    //search should be updated by the developer depend on the req
       var mySearchColumns = [
	
          {type:"filler", name:'fil1', id:'', placeholder: '',size: '',index: 1 },
          {type:"text", name: 'term_order', id: 'term_order', placeholder: 'term_order!',size: '10',index: 2 }


      ];

       wb.searchColumns=mySearchColumns;

       wb.init();

      if (debug) console.log('wb  :-',wb);
      
      var myForm = wb.getFormToolbar();
  	
      myLayout = wb.getFormLayout();
  	
      formBar =myForm.toolbar;
      
      formBar.attachEvent('onClick', function(buttonid){

             if(buttonid==='delete') {
                  doDelete();
             }
     });

</script>
