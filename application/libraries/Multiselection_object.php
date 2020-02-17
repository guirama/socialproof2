<?php
		
		/**
		 * ******************************************************************
		 *
		 * BizyCorp/Ekwa Internal development Team
		 *
		 * @category   ~DATABASE_NAME~
		 * @package    CommonObjects - LogObject
		 * @author     Nuwan Wickramarathne
		 *
		 * ******************************************************************
		 *
		 */
		/**
		 * ******************************************************************************
		 *	@package    CommonObjects - LogObject
		 *	
		 *	
		 *	Author            :- Nuwan Wickramarathne
		 *  Creation date     :- Dec 2, 2013
		 *  Last Modified on  :- 
		 *  Last Modification :- 
		 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Multiselection_object{
	protected $legendName		='';
	protected $name				='';
	protected $selectionName	='';
	protected $selectionList	='';
	protected $selectedList 	='';
	protected $selection		='';
	
	//select list labels
	protected $selectionListLabel	='';
	protected $selectedListLabel	='';
	
	//dropdown box sorting
	protected $sorting			=false; 	
	
	//assign buttons
	protected $selectionBtn		='';
	protected $unSelectionBtn	='';
	protected $selectionAllBtn	='';
	protected $unSelectionAllBtn='';
	
	//optional properties
	protected $disabledList = array();
	protected $jsPath		='';
	protected $cssPath 		='
		<style>
			#wrapper_selection{display:inline-block;}
			#wrapper_selection #selection_buttons{padding:0 10px;}
			#wrapper_selection select{width:150px;min-height:200px;}

			#wrapper_selection input[type=button], #wrapper_selection select{-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;background-color:#fff;}
			
			#wrapper_selection select option{padding:2px 5px;}
			#wrapper_selection select option:hover{background-color:#87CEEB;color:#000;-webkit-box-shadow:-3px -5px 5px #555;-moz-box-shadow:-3px -5px 5px #555;box-shadow:-3px -5px 5px #555;border-left:2px outset #FFF;border-right:2px outset #FFF;}
			#wrapper_selection select option:disabled{background-color:#AAA;color:#FFF;}
			#wrapper_selection select option:disabled:hover{background-color:#AAA;color:#FFF;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none;border:none;}
			#wrapper_selection #selection_buttons{text-align:center; padding:0 20px;}
			
			#wrapper_selection input[type=button]{
				height:25px;
				width:110px;
				font-size:11px;
				font-weight:bold;
				margin-top:5px;
				border-width:3px;
				border-style:outset;
				border-color:#AAA;
				cursor:pointer;
			}
			
			#wrapper_selection input[type=button].selection{border-right:none;-webkit-border-radius:5px 0 0 5px;-moz-border-radius:5px 0 0 5px;border-radius:5px 0 0 5px;}
			#wrapper_selection input[type=button].unselection{border-left:none;-webkit-border-radius:0 5px 5px 0;-moz-border-radius:0 5px 5px 0;border-radius:0 5px 5px 0;}
			
			#wrapper_selection input[type=button].selection:hover{border:3px inset #AAA;border-right:none;}
			#wrapper_selection input[type=button].unselection:hover{border:3px inset #AAA;border-left:none;}
			
			#wrapper_selection .arrowRight { position: relative; float:right; margin-right:-6px;}
			#wrapper_selection .arrowRight:after, #wrapper_selection .arrowRight:before { left: 100%; top: 33%; border: outset transparent; content: " "; position: absolute;} 
			#wrapper_selection .arrowRight:after { border-left-color: #FFF; border-width: 9px; margin-top: -1px; }
			#wrapper_selection .arrowRight:before { border-left-color: #AAA; border-width: 13px; margin-top: -5px; }
			
			#wrapper_selection .arrowLeft { position: relative; float:left;margin-left:-6px;} 
			#wrapper_selection .arrowLeft:after, #wrapper_selection .arrowLeft:before { right: 100%; top: 33%; border: inset transparent; content: " "; position: absolute;} 
			#wrapper_selection .arrowLeft:after { border-right-color: #FFF; border-width: 8px; margin-top: -1px; } 
			#wrapper_selection .arrowLeft:before { border-right-color: #AAA; border-width: 12px; margin-top: -5px; }
			
			optgroup{ font-size:12px; font-weight:bold; }
			option{ margin-left:5px; }
		</style>
	';
	
	function __construct(){		
		
	}//end of construct

	
	//set methodes
	/**
	 * set_legendName function
	 * This is a public function. To set name for display
	 * @param string $legendName
	 */
	public function set_legendName($legendName){
		$this->legendName = $legendName;
	}
	
	/**
	 * set_name function
	 * This is a public function. Set name and id for output multi selection box 
	 * @param string $name
	 */
	public function set_name($name){
		$this->name = $name;
	}
	
	/**
	 * set_selectionName function
	 * This is a public function. get multi selection box id
	 * @param string $selectionName
	 */
	public function set_selectionName($selectionName){
		$this->selectionName = $selectionName;
	}
	/**
	 * set_selectionList function
	 * This is a public function. Set to get select items, dropdown link for multi-selection box from CI
	 * @param a link $selectionList
	 */
	public function set_selectionList($selectionList){
		$this->selectionList = get_contents_with_session($selectionList);
	}
	
	/**
	 * set_selectedList function
	 * This is a public function. set selected list of items, array with item number and name
	 * @param array $selectedList
	 */
	public function set_selectedList($selectedList,$name='selectedList'){
		if(is_array($selectedList) || $selectedList==''){ $this->selectedList = $this->Listbox($selectedList,$name); }
		else{ $this->selectedList = get_contents_with_session($selectedList); }
	}
	
	/**
	 * set_selectionListLabel function
	 * This is a public function. Set label for selection list box
	 * @param string $selectionListLabel
	 */
	public function set_selectionListLabel($selectionListLabel){
		$this->selectionListLabel = $selectionListLabel;
	}
	
	/**
	 * set_selectedListLabel function
	 * This is a public function. Set label for selected list box
	 * @param string $selectedListLabel
	 */
	public function set_selectedListLabel($selectedListLabel){
		$this->selectedlistLabel = $selectedListLabel;
	}
	
	/**
	 * set_selectionBtn function
	 * This is a public function. set name for singel selection button
	 * @param string $selectionBtn
	 */
	public function set_selectionBtn($selectionBtn){
		$this->selectionBtn = $selectionBtn;
	}
	
	/**
	 * set_unSelectionBtn function
	 * This is a public function. set name for singel un-selection button
	 * @param string $unSelectionBtn
	 */
	public function set_unSelectionBtn($unSelectionBtn){
		$this->unSelectionBtn = $unSelectionBtn;
	}
	
	/**
	 * set_selectionAllBtn function
	 * This is a public function. set name for all selection button
	 * @param string $selectionAllBtn
	 */
	public function set_selectionAllBtn($selectionAllBtn){
		$this->selectionAllBtn = $selectionAllBtn;
	}
	
	/**
	 * set_unSelectionAllBtn function
	 * This is a public function. set name for all un-selection button
	 * @param string $unSelectionAllBtn
	 */
	public function set_unSelectionAllBtn($unSelectionAllBtn){
		$this->unSelectionAllBtn = $unSelectionAllBtn;
	}
	
	//optional properties set methods
	/**
	 * set_disabledList function
	 * This is a public function. set disable items in selection list
	 * @param array $disabledList
	 */
	public function set_disabledList($disabledList){
		$this->disabledList = $disabledList;
	}
	/**
	 * set_jsPath function
	 * This is a public function. Set javascript path.. can added additional javascript functions to object 
	 * @param link $jsPath
	 */
	public function set_jsPath($jsPath){$this->jsPath = $jsPath;}
	/**
	 * set_cssPath function
	 * This is a public function. Set css path.. this can replace css design if pass css link default css will be remove
	 * @param link $cssPath
	 */
	public function set_cssPath($cssPath){
		$this->cssPath = '<link href="'.$cssPath.'" rel="stylesheet" type="text/css">';
	}
	
	/**
	 * set_sorting function
	 * This is a public function to set dropdox sorting status
	 * @param boolian
	 */
	public function set_sorting($sorting){
		$this->sorting = $sorting;
	}
	
	/**
	 * ListBox function
	 * This is a private function to ceate multi selection list box for selected item list
	 * @param array $listBoxType pass list box items and names to function
	 * @param string $name
	 */
	//$this->selectedList
	private function Listbox($listBoxType,$name='selectionId'){
		$createListbox;
		$createListbox = '<select name="'.$name.'[]" id="'.$name.'" multiple><option value="" >Select...</option>';
		if($listBoxType!=''){
			foreach ($listBoxType as $key=>$val){
				$dis='';
				if(isset($this->disabledList)){
					foreach ($this->disabledList as $k=>$v){
						if($key==$k){$dis='disabled';}
					}
				}
				$createListbox .= '<option value="'.$key.'" '.$dis.' >'.$val.'</option> ';
			}
		}
		$createListbox .= '</select> ';
		return $createListbox;
	}
	/**
	 * buttons function
	 * This is a private function to create buttons for object
	 * @param string $disabled passig disabled string can disabled buttons function
	 */
	private function buttons($disabled){
		$disabledOption='';
		
		if(count($this->disabledList)>0){
			foreach ($this->disabledList as $key=>$values){
				$disabledOption .= $this->name."_disableList('".$values[0]."', '".$values[1]."');";
			}
		}
		
		$selection = '<span class="arrowRight"><input '.$disabled.' type="button" name="selectionBtn" id="selectionBtn" class="selection" onclick="'.$this->name.'_Move(this,\'to\',0);'.$disabledOption.'" value="'.$this->selectionBtn.'"/></span><br />';
		$unSelection = '<span class="arrowLeft"><input '.$disabled.' type="button" name="unSelectionBtn" id="unSelectionBtn" class="unselection" onclick="'.$this->name.'_Move(this,\'from\',0);'.$disabledOption.'"  value="'.$this->unSelectionBtn.'" /></span><br /><br />';
		$selectionAll = '<span class="arrowRight"><input '.$disabled.' type="button" name="selectionAllBtn" id="selectionAllBtn" class="selection" onclick="'.$this->name.'_Move(this,\'to\',1);'.$disabledOption.'" value="'.$this->selectionAllBtn.'" /></span><br />';
		$unSelectionAll = '<span class="arrowLeft"><input '.$disabled.' type="button" name="unSelectionAllBtn" id="unSelectionAllBtn" class="unselection" onclick="'.$this->name.'_Move(this,\'from\',1);'.$disabledOption.'" value="'.$this->unSelectionAllBtn.'" /></span>';
		$button_set = ($selection.$unSelection.$selectionAll.$unSelectionAll);
		
		return $button_set;
	}
	
	/**
	 * layout function
	 * This is a private function to create layout structure for object
	 * @param string $disabled option to disabled buttons
	 */
	private function layOut($disabled){
		$layout = '<div id="wrapper_selection"><fieldset id="selection_fieldset">';
		
		$layout .= '<legend id="selection_legend">'.$this->legendName.'</legend>';
		$layout .= '<table id="selection_content"><tr valign="middle">';
		
		$layout .= '<td id="selection_list">'.$this->selectionListLabel.'<br/>'.$this->selectionList.'</td>';
		$layout .= '<td id="selection_buttons">'.$this->buttons($disabled).'</td>';
		$layout .= '<td id="selected_list">'.$this->selectedlistLabel.'<br/>'.$this->selectedList.'</td>';
		
		$layout .= '</tr></table></fieldset></div>';
		return $layout;
	}
	
	/**
	 * display function
	 * public function to get object to form
	 * @param string $disabled option to disabled buttons
	 */
	public function display($disabled=''){
		//disabled dropdown box options
		if(count($this->disabledList)>0){
			$disabledOption='';
			foreach ($this->disabledList as $key=>$values){ $disabledOption .= $this->name."_disableList('".$values[0]."', '".$values[1]."');";}
		}
		
		$output='';
		if($this->jsPath!='') $output = '<script href="'.$this->jsPath.'"></script>';
		$output .= $this->cssPath;
		$output .= $this->layOut($disabled);
		$output .= '
			<script>
				var '.$this->name.'_sourselement = "'.$this->selectionName.'";
				var '.$this->name.'_targetelement = "'.$this->name.'";
				document.getElementById('.$this->name.'_sourselement).remove(0);
			 	document.getElementById('.$this->name.'_targetelement).remove(0);
				
			 	//multy object reset function
		 		var '.$this->name.'_content = new Array();
				var '.$this->selectionName.'_content = new Array();
				
				function '.$this->name.'_reset(){
					var end_length = 0;
					var xxxx = document.getElementById("'.$this->name.'").options.length;
					for(var i=xxxx; i>=0; i--){ document.getElementById("'.$this->name.'").remove(i); }
					for(var i=0; i<'.$this->name.'_content.length; i++){ document.getElementById("'.$this->name.'").appendChild('.$this->name.'_content[i]); }
					
					var end_length = 0;
					var xxxx = document.getElementById("'.$this->selectionName.'").options.length;
					for(var i=xxxx; i>=0; i--){ document.getElementById("'.$this->selectionName.'").remove(i); }
					for(var i=0; i<'.$this->selectionName.'_content.length; i++){ document.getElementById("'.$this->selectionName.'").appendChild('.$this->selectionName.'_content[i]); }
					'.$disabledOption.'
				}
				
			 	//removing exists items from selection list
		    	function '.$this->name.'_remove_exists(){
				 	for(var i=0; i< document.getElementById('.$this->name.'_targetelement).length; i++){
				 		for(var x=0; x< document.getElementById('.$this->name.'_sourselement).length; x++){
				 			if(document.getElementById('.$this->name.'_sourselement).options[x].value == document.getElementById('.$this->name.'_targetelement).options[i].value){
				 				document.getElementById('.$this->name.'_sourselement).remove(x);
				 				break;
				 			}
				 		}
				 	}
				}
				'.$this->name.'_remove_exists();
			 	
			 	//selecting selected list
				if(document.getElementById('.$this->name.'_targetelement).length!=0){
				    for (var i = 0; i < document.getElementById('.$this->name.'_targetelement).length; i++) {
				    	document.getElementById('.$this->name.'_targetelement).options[i].selected = true;
					}
				}
				
			 	//remove empty groups form both dropdowns
				function '.$this->name.'_remove_emptygroups(){
					for(y=0;y<2;y++){
					    '.$this->name.'_SourceElement = document.getElementById('.$this->name.'_sourselement);
						'.$this->name.'_TargetElement = document.getElementById('.$this->name.'_targetelement);
						
						var optGrps1 = '.$this->name.'_SourceElement.getElementsByTagName("OPTGROUP");
						var optGrps2 = '.$this->name.'_TargetElement.getElementsByTagName("OPTGROUP");
						
						for(x=0;x<optGrps1.length;x++){
							match=false;
							for(xx=0;xx<optGrps1[x].childNodes.length;xx++){ if(optGrps1[x].childNodes[xx].nodeName=="OPTION"){ match=true; } }
							if(!match){ '.$this->name.'_SourceElement.removeChild(optGrps1[x]); }
						}
						for(x=0;x<optGrps2.length;x++){
							match=false;
							for(xx=0;xx<optGrps2[x].childNodes.length;xx++){ if(optGrps2[x].childNodes[xx].nodeName=="OPTION"){ match=true; } }
							if(!match){ '.$this->name.'_TargetElement.removeChild(optGrps2[x]); }
						}
					}
				}
				//inload removing empty groups
				'.$this->name.'_remove_emptygroups();
				
				//catching excisting dropdowns
				for(x=0;x<document.getElementById("'.$this->name.'").options.length;x++)
					'.$this->name.'_content[x] = document.getElementById("'.$this->name.'").options[x];
				
				for(x=0;x<document.getElementById("'.$this->selectionName.'").options.length;x++)
					'.$this->selectionName.'_content[x] = document.getElementById("'.$this->selectionName.'").options[x];
					
				function '.$this->name.'_Move(frm1,mode,type){
				    if(mode=="to"){objSourceElement = document.getElementById('.$this->name.'_sourselement);objTargetElement = document.getElementById('.$this->name.'_targetelement);}
					else if(mode=="from"){objSourceElement = document.getElementById('.$this->name.'_targetelement);objTargetElement = document.getElementById('.$this->name.'_sourselement);}
					    
				    var aryTempSourceOptions = new Array();
				    var objTargetElementLength = objTargetElement.length;
					var x = 0;
					var selet_options = new Array();
					var selet_group = new Array();
							
				    //looping through source element to find selected options
				    if(type==0 || type==1){
						if(type==1){
							for (var i = objSourceElement.length-1; i >=0 ; i--){
		            			if(objSourceElement.options[i].disabled!=true){
				            		objSourceElement.options[i].selected = true;
				            		x++;
				            	}
					    	}
						}
						
						x=0;
						for (var i=0; i<objSourceElement.length; i++){
					   		if (objSourceElement.options[i].selected && objSourceElement.options[i].disabled!=true){
					   			selet_options[x] = objSourceElement.options[i];
					   			if(objSourceElement.options[i].parentNode.nodeName=="OPTGROUP")
					   				selet_group[x] = objSourceElement.options[i].parentNode.label;
					   			else selet_group[x] = "";
					            x++;
					        }
					    }
					    
					    for (var i=0; i<selet_options.length; i++){
					    	if(selet_group[i]!=""){
					    		match_found=false;
					    		for(x=0;x<objTargetElement.length;x++){
					    			if(objTargetElement[x].parentNode.label==selet_group[i]){
					    				//objTargetElement.add(selet_options[i],x);
										objTargetElement[x].parentNode.appendChild(selet_options[i]);
					    				match_found=true;
					    				break;
					    			}
					    		}
					    		if(!match_found){
				    				var new_group = document.createElement("OPTGROUP");
				    				new_group.setAttribute("label",selet_group[i]);
				    				new_group.appendChild(selet_options[i]);
				    			    objTargetElement.insertBefore(new_group,objTargetElement.options[objTargetElement.options.length]);
					    		}
					    	}
					    	else{
					    		objTargetElement.add(selet_options[i],objTargetElement.options.length);
					    	}
							//removing empty groups
							'.$this->name.'_remove_emptygroups();
					    }
				    }
				    
					selectSelection = document.getElementById('.$this->name.'_targetelement);
				    if(selectSelection.length!=0){for (var i = 0; i < selectSelection.length; i++) {selectSelection.options[i].selected = true;}}
				    unselectSelection = document.getElementById('.$this->name.'_sourselement);
				    if(unselectSelection.length!=0){for (var i = 0; i < unselectSelection.length; i++){unselectSelection.options[i].selected = false;} }
				}
			</script>
		';
			
		//disabled dropdown box options
		if(count($this->disabledList)>0){
			$output .='<script>
					//desabling options in dropdown box according to anothe dropdown box
					//para sourse dropdown box id
					//para target dropdown box id
					function '.$this->name.'_disableList(sourse, target){
						//un-desable elements befor desabling items selected
						for(var x=0; x< document.getElementById(target).length; x++){
							document.getElementById(target).options[x].disabled=false;
						}
						
					 	//desabling exists items from selection list
					 	for(var i=0; i< document.getElementById(sourse).length; i++){
					 		for(var x=0; x< document.getElementById(target).length; x++){
					 			if(document.getElementById(target).options[x].value == document.getElementById(sourse).options[i].value){
					 				document.getElementById(target).options[x].disabled=true;
					 				break;
					 			}
					 		}
					 	}
					}
					setTimeout(function(){'.$disabledOption.'},1000);
					
				</script>
			';
		}
		return $output;
	}
}
