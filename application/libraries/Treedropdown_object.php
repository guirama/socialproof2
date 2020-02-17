<?php
/**
 * ******************************************************************************
 *
 * BizyCorp/Ekwa Internal development Team
 *
 * @category   ~DATABASE_NAME~
 * @package    CommonObjects - Treedropdown_object
 * @author     Nuwan Wickramarathne
 *
 * ******************************************************************************
 */

/**
 *******************************************************************************
 *	@package    CommonObjects - Treedropdown_object
 *
 *	Usage :-
 *
 *	Following functions are available with in this class
 *		1) set_structure
 *		2) set_treexml
 *		3) set_gridxml
 *		4) set_imagePath
 *		5) set_defaultText
 *		6) set_objectName
 *		7) get_structure
 *		8) init
 *
 *		Creation date		:-	Apr 17, 2015
 *		Last Modified on  	:-	
 *		Last Modification 	:-	
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Treedropdown_object{
	protected $tree_xml		= '';
	protected $grid_xml		= '';
	protected $imagePath	= 'http://www.bizydads.com/frameworks/dhtmlx/dhtmlxTree/codebase/imgs/';
	protected $defaultText	= '';
	protected $name			= 'default';
	protected $structure	= '';
	
	function __construct(){ }//end of construct
	
	/**
	 * set_structure function
	 * This is a protected function. To set structure
	 */
	protected function set_structure(){
		$this->structure .= '<div id="'.$this->name.'_treeView" style="width:150px; height:200px; padding:0; margin:0;">';
		$this->structure .= '<input type="text" id="'.$this->name.'_tree_name" onkeyup="'.$this->name.'_search_name(this,event);" onclick="'.$this->name.'_drop_dropdown();" style="width:100%;" />';
		$this->structure .= '<div id="'.$this->name.'_treeBox" onmouseleave="'.$this->name.'_drop_close();" style="width:250px; height:300px; display:none; position:fixed; overflow:auto; border:3px inset #D3D3D3; z-index:1000000; background:#FFF;"></div>';
		$this->structure .= '</div>';
	}
	
	/**
	 * set_treexml function
	 * This is a public function. To set tree dropdown xml path
	 * @param string $tree_xml
	 */
	public function set_treexml($tree_xml){
		$this->tree_xml = $tree_xml;
	}
	
	/**
	 * set_treexml function
	 * This is a public function. To set grid xml path
	 * @param string $grid_xmlPath
	 */
	public function set_gridxml($grid_xml){
		$this->grid_xml = $grid_xml;
	}
	
	/**
	 * set_imagePath function
	 * This is a public function. Set dhtmlx image path
	 * @param string $imagePath
	 */
	public function set_imagePath($imagePath){
		$this->imagePath = $imagePath;
	}
	
	/**
	 * set_defaultText function
	 * This is a public function. Set default text to selected
	 * @param a link $defaultText
	 */
	public function set_defaultText($defaultText){
		$this->defaultText = $defaultText;
	}
	
	/**
	 * set_objectName function
	 * This is a public function. Set object Name
	 * @param a link $objectName
	 */
	public function set_objectName($objectName){
		$this->name = $objectName;
	}
	
	/**
	 * get_structure function
	 * public function to get structure
	 */
	public function get_structure(){
		$this->set_structure();
		return $this->structure;
	}
	
	/**
	 * init function
	 * public function to get js functions to wb
	 */
	public function init(){
		$output = '
			<script>
				var '.$this->name.'_tree = new dhtmlXTreeObject("'.$this->name.'_treeBox","100%","100%",0);
				var '.$this->name.'_treeBox = document.getElementById("'.$this->name.'_treeBox");
				var '.$this->name.'_tree_name = document.getElementById("'.$this->name.'_tree_name");
				'.$this->name.'_tree.setImagePath("'.$this->imagePath.'");
				'.$this->name.'_tree.loadXML("'.$this->tree_xml.'");
				
				var '.$this->name.'_tree_active = false;
				function '.$this->name.'_drop_dropdown(){
					if('.$this->name.'_tree_active == false) '.$this->name.'_treeBox.style.display = "block";
					else '.$this->name.'_treeBox.style.display = "none";
					
					'.$this->name.'_tree.focusItem('.$this->name.'_tree.findItemIdByLabel('.$this->name.'_tree_name.value));
					'.$this->name.'_tree.selectItem('.$this->name.'_tree.findItemIdByLabel('.$this->name.'_tree_name.value));
					'.$this->name.'_tree_active = !'.$this->name.'_tree_active;
				}
				
				function '.$this->name.'_drop_close(){ '.$this->name.'_treeBox.style.display = "none"; '.$this->name.'_tree_active = false; }
				
				//search dropdown when typing name
				function '.$this->name.'_search_name(object,event_key){
					object.style.color = "#000";
					var code = (event_key.keyCode ? event_key.keyCode : event_key.which);
    				if(code == 13){//Enter keycode
        				'.$this->name.'_object_string = object.value.toLocaleLowerCase();
        				'.$this->name.'_dropdown_string = '.$this->name.'_tree.getItemText('.$this->name.'_tree.getSelectedItemId()).toLocaleLowerCase();
        				'.$this->name.'_match_string = '.$this->name.'_dropdown_string.search('.$this->name.'_object_string);
        				
        				if('.$this->name.'_match_string != -1 && object.value!=""){
            				'.$this->name.'_tree.findItem('.$this->name.'_tree.getItemText('.$this->name.'_tree.getSelectedItemId()),0,1);
						}
        				else{ object.style.color = "red"; object.value = "No Matching!"; }
    				}
    				
					if(object.value!=""){
						'.$this->name.'_tree.focusItem('.$this->name.'_tree.findItemIdByLabel(object.value));
						'.$this->name.'_tree.selectItem('.$this->name.'_tree.findItemIdByLabel(object.value));
					}
				}
				
				//onloading displaying logged name and highlighting name in dropdown
				'.$this->name.'_tree_name.value = "'.$this->defaultText.'";
				
				'.$this->name.'_tree.attachEvent("onClick",function('.$this->name.'_id){
					if (search.toggleState) search.toggleSearch();
					'.$this->name.'_tree_name.value = '.$this->name.'_tree.getItemText('.$this->name.'_id);
					'.$this->name.'_select_id = '.$this->name.'_id.split("_");
					wb.gridreloadurl = "'.$this->grid_xml.'"+'.$this->name.'_select_id['.$this->name.'_select_id.length-1];
					dataGrid.clearAndLoad(wb.gridreloadurl);
					'.$this->name.'_drop_dropdown();
				});
			</script>
		';
		return $output;
	}
}
?>
