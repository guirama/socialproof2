<?php
	/**
	 * This controller facilitates the access of table spo_yoast_seo_meta
	 *
	 * @package    HOF\helpers\cigen_helper
	 * @version    1.0
	 * @copyright  2020, BizyCorp Internal Systems Development
	 * @license    private, All rights reserved
	 * @author     CIGen (Automated CI Code Generator)
	 */
	
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 *
	 * This is the cigen_helper file
	 *
	 * @package    HOF\helpers\cigen_helper
	 * @version    1.0
	 * @copyright  2020, BizyCorp Internal Systems Development
	 * @license    private, All rights reserved
	 * @author     CIGen (Automated CI Code Generator)
	 * @uses
	 * @see
	 * @created    	Jan 29, 2020
	 * @modified   	Jan 29, 2020
	 * @modification
	 *
	 */
		
if ( ! function_exists('getHeadersList'))
{		
		/**
		 * Function getHeadersList()
		 *
		 * Parses data array and return list of headers
		 *
		 * @param $one_record one record from data array
		 *
		 * @return comma separated list of headers
		 * 
		 */

         function getHeadersList($one_record)
         {
			$out = array();
			$one_record=array_slice($one_record,1);
			foreach($one_record as $h)
			{
				$out[] = $h['header'];
			}
			
			 return join(',',$out);
         }
}

if ( ! function_exists('convertHTMLTable'))
{
	/**
	 * Function convertHTMLTable()
	 *
	 * Prepares and echoes HTML table for jQuery datatables
	 *
	 * @param $data Data Array
	 *
	 * @return void
	 */
	
	function convertHTMLTable($data,$widths='',$colList = false,$styleSheet = true)
	{
		
		$widthArr = array();
		$dashBoardURL = array();
		if(is_array($widths)) $widthArr = $widths ;
		////////////////////////////////////////////////////
		$dataset = $data['dataset']['result_set'];
	
	
		$pk = explode(",",$data['dataset']['metadata']['PK']);
		
		//------------ Create headers -------------------
		$headers =array_slice($data['dataset']['metadata'],1);
		

		if($styleSheet === true ||$styleSheet ==''){
			$styleSheet = "\n".'<link rel="stylesheet" type="text/css" href="'.base_url("public/css/html_gridview.css").'" media="screen">' ;
		}else{
			$styleSheet = "\n".'<link rel="stylesheet" type="text/css" href="'.$styleSheet.'" media="screen">' ;
		}
		$tableHTML = "\n<table id='cigen_datatable' style='' class=''>\n\t~HEADERS~\n\t\n\t<tbody>~DATAROWS~\n\n\t</tbody>\n\t<tfoot><tr><td colspan='".(count($colList?$colList:$headers))."'></tr></tfoot>\n</table>";
		$headerHTML = '';
		$headerHTML .= "\n\t<colgroup>";
		foreach($headers as $key=>$h)     //Set col widths
		{
			if($h['width'] =="" || $h['width'] < "15"){
				$width="50";
			}else{
				$width=$h['width'];
			}
	
			if ($colList) {
				if (in_array($key,$colList) ) {
					if (sizeof($widthArr)>0) { //User specified column widths are active
						$width=$widthArr[$key];
					}else{
						$width='';
					}
					$headerHTML .= "\n\t\t\t<col style='width:{$width}em;' >";
				}
			}else{
				$headerHTML .= "\n\t\t\t<col style='width:{$width}em;'>";
			}
		}
		$headerHTML .= "\n\t</colgroup>\n\t<thead>";
		$headerHTML .= "\n\t\t<tr class=\"headerrow\" >";
		foreach($headers as $key=>$h)
		{
			if ($colList) {
				if (in_array($key,$colList) ) {
					$headerHTML .= "\n\t\t\t<th class=\"headercell\" style='text-align: center;'>{$h['header']}</th>";
				}
			}else{
				$headerHTML .= "\n\t\t\t<th class=\"headercell\" style='text-align: center;'>{$h['header']}</th>";
			}
		}
		$headerHTML .= "\n\t\t</tr>\n\t</thead>";
		// ----------end of headers -----------------
		
		$nrows = sizeof($dataset) ;
		$datarowHTML = '';
		for($i=1;$i<=$nrows;$i++)
		{
		$datarowHTML .= "\n\t\t<tr class=\"dararow\" >\n";
          foreach($dataset[$i] as $key=>$v)
	          {
	          if(!(isset($v))) {
	          	$thisValue = '';
	          	} else {
	          		$thisValue = $v;
	          	}
	          	if ($colList){
	          	if(in_array($key,$colList) ){
	          		$datarowHTML .= "\n\t\t\t<td class=\"datacell\">".stripslashes($thisValue)."</td>";
	          		}
	            }else {
	          		$datarowHTML .= "\n\t\t\t<td class=\"datacell\">".stripslashes($thisValue)."</td>\n";
	            }
	          		}
	          				$datarowHTML .= "\n\t\t</tr>\n";
	          }
  			 $out = str_replace('~HEADERS~',$headerHTML,(str_replace('~DATAROWS~',$datarowHTML,$tableHTML)));
	  			 return $styleSheet.$out;
	}
}

if ( ! function_exists('getArrayElements'))
{
	/**
	 * Function getArrayElements()
	 *
	 * Returns wanter array element, if exists
	 *
	 * @param $array , the array
	 *
	 * @param $key , key to be checked
	 *
	 * @return String, array element value if found, otherwise an empty string
	 */
	
	function getArrayElements($array,$key)
	{
		if(is_array($array))
		{
			if(array_key_exists($key,$array))
			{
				return $array[$key];
			}
			else
				return '';
		}
		else
			return '';
	}
	
}

	/**
	 * Function input()
	 *
	 * Prepares and echoes HTML Code for Input feilds
	 *
	 * @param $data Data Array
	 *
	 * @param $pkval , Value of the primary key field of data record, to identity record
	 *
	 * @param $field, Name of database table field
	 *
	 * @param $type Optional, type of input tag, Default Text
	 *
	 * @return void
	 */
function input($data,$pkval,$field,$type="text")
{

	$dataset = $data['dataset']['result_set'];
    $pk = explode(",",$data['dataset']['metadata']['PK']);
	
	$nrows = sizeof($dataset) - 1;
	for($ix=1;$ix<=$nrows;$ix++)
	{
		if($ix > 0)
		{
			unset($pk_g);
			foreach($pk as $col){
				$pk_g[] = $dataset[$i][$col];
				 
			}
			$pk_grid=join("_",$pk_g);
			unset($pk_g);
			if($pk_grid == $pkval)
			{
				echo '<input type="'.$type.'" id="'.$field.$pkval.'" name="'.$field.$pkval.'" value="'.$dataset[$ix][$field] .'">';
			}
		}
		$pk_grid="";
		$ix++;
	}
}

	/**
	 * Function dropdown()
	 *
	 * Prepares and echoes HTML/DHTMLX Code for Dropdown list
	 *
	 * @param $data - required - Data Array
	 * 
	 * @param $name - required - The name and the id of the dropdown controller.
	 * 
	 * @param $fieldName - required - The field name of the record set which is to be listed in options.
	 *
	 * @param $selectByText - optional - The option text(s) to be selected on load of the dropdown.  
	 *
	 * @param $selectByVal - optional -The option value(s) to be selected on load of the dropdown 
	 *
	 * @param $format - optional - The dropdown output format as html or xml
	 * 
	 * @param $multiple - optional - to specify either multiple select or single select option
	 * 
	 * @param $optionsOnly - optional - To specify to output only options list without select controller
	 * 
	 * @return void
	 * 
	 * Updates:
	 * 
	 * 1. Rearranged parameter list from required to optional  from left to right 
	 * 2. Removed unwanted parameters - $keyfield,$skipfield,$label
	 * 
	 *   $dataArray = array('data' => $data,
	 *   					'fieldName' => $fieldName,  (html name attrib)
	 *   					'label' => $label,
	 *   					'selectByText' => null,
	 *   					'selectByVal' => null,
	 *   					'format' => 'html',
	 *   					'multiple' => false,
	 *   					'optionsOnly' => false,
	 *   					'groupby'=>field to group by,
	 *   					'display' => field / column to display as value,
	 *						'required' => true/false, a requrired field or not ,
	 *						'codename' => group by codes to display instead of field value
	 *    );
	 * 
	 * //function dropdown($data, $name, $fieldName,$label, $selectByText=null, $selectByVal=null, $format='html', $multiple=false, $optionsOnly=false)
     *
	 * 
	 */


function dropdown($dataArray)
{
	
	/* 
	 * following set of codes are common for both xml and html code segments. 
	 * 
	 * */
	
    	$dataset = $dataArray['data']['dataset']['result_set'];
        
    	$pk = $dataArray['data']['dataset']['metadata']['PK'];
        $grp = isset($dataArray['data']['dataset']['metadata']['cmanager'])?$dataArray['data']['dataset']['metadata']['cmanager']:null;
		$fieldName = isset($dataArray['fieldName'])? $dataArray['fieldName']: null;
		$selectByText = isset($dataArray['selectByText'])? $dataArray['selectByText']:null;
		$selectByVal = isset($dataArray['selectByVal'])? $dataArray['selectByVal']:null;
		if($selectByVal){
		$selectByVal = explode(",",$selectByVal); 
		}
		$format = isset($dataArray['format'])? $dataArray['format']:null;
		$multiple = isset($dataArray['multiple'])? $dataArray['multiple']:false;
		$optionsOnly = isset($dataArray['optionsOnly'])? $dataArray['optionsOnly']:false;
		$label = isset($dataArray['label'])? $dataArray['label']:null;
        
		$display = isset($dataArray['display'])? explode(',',$dataArray['display']):null; 
		
        $required = isset($dataArray['required'])? $dataArray['required']:null;
        $groupBy = isset($dataArray['groupBy'])? $dataArray['groupBy']:null;     
        $groupCodes = isset($dataArray['codename'])?$dataArray['codename']:null;     
        
        //set display values
 
        $display_concat_value = ',';
        if(count($display)>1){ 
        	$display_concat_value = $display[0];
        	array_splice($display,0,1);
        }
        else
        	$display = $display[0];
        
        	
         if(!empty($selectByText) && !empty($selectByVal)) $selectByText = null ;  // Choos ByVal if both provided //WCD
      		
       
		$previousValue = NULL;
            switch ($format) {
                
        
            case 'html':
   	   	
                    if (!is_array($pk)) $pk = explode(',', $pk);
                    $nrows = sizeof($dataset) ;
                    $mul = ($multiple)?'[]':'';
                    $size = ($multiple)?'5':'1';
					
                    if(!$optionsOnly) {  
                        
                        echo '<select size="'.$size.'"  id="'.$fieldName.'" name="'.$fieldName.$mul.'" label="'.$label.'" ';      
                        if($multiple) echo ' MULTIPLE ';
                        echo ' style="max-width:25em;" onmouseover="this.title=this.selectedOptions.item(this.selectedIndex.toFixed).text">',"\n"; 

                    }//end if(options)
      		
                    if(empty($selectByText) && empty($selectByVal)){
                        
                        echo "\t",'<option value="" selected="selected" >Select.... </option>',"\n";
                        
                    }else{
                        
                        echo "\t",'<option value="" >Select.... </option>',"\n";
                    }		

                    $sbt = null;
                    for($ix=1;$ix<=$nrows;$ix++) {
        	
                       if($ix > 0) {

                              $val='';
                              
                            //for composite keys construct the composit value with '_'
                            //suffix

                            foreach($pk as $key){
                                    $val .= $dataset[$ix][$key].'_';
                                    
                            }
                            

                            $val=trim($val,'_');
                            $selectedAttrib = null;
                            $foundText= false; $foundVal=false;

                            if(!empty($selectByText) || !empty($selectByVal)){
                            	
                            	if(is_array($display)){
                            		foreach ($display as $key=>$value){
                            			
	                            		if(!empty($selectByText) && !empty($dataset[$ix][$display[$key]])){
	                                        $sbt = explode(',',$selectByText);
	                                        $foundText = in_array($dataset[$ix][$display[$key]],$sbt);
	
	                                    }else{ 
											$foundText = false;
	                                    }
                            		}
                            	}else{
									
									if(!empty($selectByText) && !empty($dataset[$ix][$display])){
									
									$sbt = explode(',',$selectByText);
									$foundText = in_array($dataset[$ix][$display],$sbt);
									
									}else{ 
										$foundText = false;
									}

								}
                                    if(!empty($selectByVal) && !empty($val)){

											$foundVal = in_array($val,$selectByVal) ; 

                                    }else{ 

                                            $foundVal = false;
                                    }			

                          }//end if(!empty($selectByText)

                            if($foundText !== false || $foundVal !== false ) {

                                    $selectedAttrib = 'selected="selected"';									
                          }
                          
                          if($groupBy){
                              $grp_val = formatString($dataset[$ix][$groupBy]);
                              $grp_code = $grp_val;
                              if($groupCodes){
                                  $flag = 0;
                                  foreach ($groupCodes as $k => $v) {
                                       switch($grp_val){
                                            case $k: 
                                                $grp_code = $v; 
                                                $flag = 1;
                                                break;     
                                    }
                                    if($flag == 1) break;
                                     
                                  }
                                   
                              }
                                 
                                 if ($previousValue == NULL ) {
                                        
                                        echo '<optgroup label="'.$grp_code.'">';
                                        
                                 }
                                 if ($previousValue != $grp_val && $previousValue!= null) {
                                        echo '</optgroup>';
                                        echo '<optgroup label="'.$grp_code.'">';
                                 }
                                
                          }
                          //creating html option tag for selection 
                          	
                          	if(is_array($display)){
                          		$display_value_array;
                          		foreach ($display as $key=>$value){
                          			if(isset($dataset[$ix][$value])){
                          				$display_value_array[$key] = $dataset[$ix][$value]; 
                          			}
                          		}
                          		$display_value = implode($display_concat_value,$display_value_array);
                          	}
                          	else{
                          		if(isset($dataset[$ix][$display])){
                          			$display_value = $dataset[$ix][$display]; 
                          		}
                          	}
                          	echo "\t",'<option value="'.$val.'" '.$selectedAttrib.' >'.$display_value.'</option>',"\n";
                          	
                            
                              if($groupBy){
                                   $previousValue = $grp_val;
                                   
                              }
			
                    }//end if(ix)
      		   
                    }//end for     

                    if(!$optionsOnly) {

                          if($groupBy)  echo '</optgroup>';
                          echo '</select>',"\n";
                    }
      
                      			
    break;
				
    case 'xml':
        	
        	
        	if (!is_array($pk)) $pk = explode(',', $pk);
        	
        	$nrows = sizeof($dataset);
        	
        	if($multiple) { $type='multiselect'; } else { $type='select';}
                if($required) { $validate='NotEmpty'; } 
        	 
        	               	
            if(!$optionsOnly) {
                        if($required) {
                        echo '<item type="'.$type.'" name="'.$fieldName.'" id="'.$fieldName.'" label="'.$label.'" validate="NotEmpty" required="true">';  
                        }else {    
        		echo '<item type="'.$type.'" name="'.$fieldName.'" id="'.$fieldName.'" label="'.$label.'">';     
                        }   	
        	}

        	if(empty($selectByVal)&& empty($selectByText)){
        		echo "\n\t",'<option value=""  selected="true"  label="Select...."  >Select....</option>';
        	}else{
        		echo "\n\t",'<option value="" label="Select...."  >Select....</option>';
        	}
        	
        	$sbt = null;
        	for($ix=1;$ix<=$nrows;$ix++){ 
        		
          	if($ix > 0)
          		{
          			$val='';
          			foreach($pk as $key){
          				$val .= $dataset[$ix][$key].'_';
          			}
          	
          			$val=trim($val,'_');        
          			
                  	$foundText= false; $foundVal=false;				
                  
                  	if(!empty($selectByVal)|| !empty($selectByText)){

                  		
						if(is_array($display)){
                        	foreach ($display as $key=>$value){
                            
	                        	if(!empty($selectByText) && !empty($dataset[$ix][$display[$key]])){
	                            	
	                                $sbt = explode(',',$selectByText);
	                                $foundText = in_array($dataset[$ix][$display[$key]],$sbt);
								}else{ 
									$foundText = false;
	                           	}
                            }
						}else{
									if(!empty($selectByText) && !empty($dataset[$ix][$display])){
									
									$sbt = explode(',',$selectByText);
									$foundText = in_array($dataset[$ix][$display],$sbt);
									
									}else{ 
										$foundText = false;
									}

								}
						
						
                  			
                  		if(!empty($selectByVal) && !empty($val)){
                  			
							$foundVal = in_array($val,$selectByVal) ;
                  		}else{
                  			$foundVal = false;
                  		}	
             
                  }//endif
                  
        	      if($foundText !== false || $foundVal !== false ) {
         		  		$selectedAttrib = 'selected="true"';
        		  }else{
        				$selectedAttrib = '';
        		  }        				
          		
        		  //creating option tag for selection 
                	
                	if(is_array($display)){
                		$display_value_array;
                	    foreach ($display as $key=>$value){
                	    	if(isset($dataset[$ix][$value])){
                	        	$display_value_array[$key] = $dataset[$ix][$value]; 
                	        }
						}
                	    $display_value = implode($display_concat_value,$display_value_array);
					}
                	else{
                		if(isset($dataset[$ix][$display])){
               		     	$display_value = $dataset[$ix][$display]; 
                	    }
					}
					echo "\n\t",'<option value="'.$val.'" '.$selectedAttrib.' label="'.$display_value.'" >'.$display_value.'</option>';
        			
          		}//end if(ix)
        		
        	}//end for
        	
            if(!$optionsOnly) {
        		echo "\n\t",'</item>';
            }
           	
         break;            
        case 'list':
            //to do
            break;
        
        case 'json':
            //todo
            break;          
            
   }//end switch case
   
}//end of dropdown();


function formatString($string) {
            
           $string = str_replace ( '&', '&amp;', $string );

           return $string;
}



if ( ! function_exists('converDHTMLXGrid')) {

	 /**
	  * Function converDHTMLXGrid()
	  *
	  * Prepares and echoes XML for DHTMLX Data Grid
	  *
	  * @param $data Data Array
	  *
	  * @param $sr Optional, Enable/Disable Smart Rendering, Boolean TRUE/FALSE,
	  *  Default false
	  *
	  * @param $start Optional, Start Position of data included in XML, Default 0
	  *
	  * @param $nnrows Optional, Number of data rows to included in XML, Default 20
	  *
	  * @param $includeHeaders   boolean, optional, use true to have headers included
	  *  in XML, otherwise keep it false
	  *
	  * @param $widths , array of column widths, optional (e.g. array(100,150,200); ) 
	  *
	  * @param $cellStyles , array of CSS styles, optiona (e.g. array('color:red;font-
	  * weight:bold;','color:#00ff00'); )
	  *
	  * @param $colList , array of columns to  display, optional (e.g. array('col1','col2','col3'); ) table column names  
	  * @return String, Grid XML
	  */
	
  function converDHTMLXGrid($data,$sr = false, $start=0,$nnrows=20,$includeHeaders=false,$widths='',$cellStyles='',$colList = false,$visibilityList='') {
	  	
  		$widthStr = '';
	    $widthArr = array();
	    $rowStyleStr = '';
	    $rowStylesArr = array();
	    $sidx = 0;
	    
	  	// For debuging 
	    //log_message('debug',"DATA ARRAY :- ".serialize($data));	 
	    if(is_array($widths))
	    {	
	
	      $widthArr = $widths ;		 
	    }
	    if(is_array($cellStyles))
	    {	
	    foreach($cellStyles as $rsty)
	      {
	      	$rowStylesArr[] = $rsty;
	      }			 
	    }
	    $dataset = $data['dataset']['result_set'];
	    $pk = explode(",",$data['dataset']['metadata']['PK']);
	
	    $headers =array_slice($data['dataset']['metadata'],1);
	    $nrows = sizeof($dataset);
	    $nnrows = ($nrows < $nnrows)?$nrows:$nnrows;     
		
	    //manual pagination related code 
	    $totrows 	= $data['dataset']['total_rows'];
	    $nnrows 	= ($nrows < $nnrows)?$nrows:$nnrows;
	    $limit 		= $data['dataset']['limit'];
	    $offset 	= $data['dataset']['offset'];
	    $tot_recs 	= $totrows;
	    if($limit>0) $tot_pages = ceil($tot_recs/$limit); else $tot_pages = 1;
	    
	    //set header for XML Using DOM to do a clean job
	    $doc = new DOMDocument('1.0', 'UTF-8');
	
	    //Set Row data for XML
	    $myrows = $doc->createElement("rows");
	    //Following for smart rendering. Does not work with paging--
		if ($sr)   {
	    	$myrows->setAttribute('pos', $start);
	      	$myrows->setAttribute('rec_count', $nrows);
	      	
	      	//manual pagination related code
	      	$myrows->setAttribute('total_rec', $tot_recs);
	      	$myrows->setAttribute('limit', $limit);
	      	$myrows->setAttribute('offset', $offset);
	      	$myrows->setAttribute('tot_pages', $tot_pages);
	    }
	    //Smart rendering End ---------------------------------------
		
	    $doc->appendChild($myrows);
		
		if($data['dataset']['total_rows'] !=0){
	    //Following needed for paging ------------------
	    //Put Paging code here (Not needed for DHTMLX Enterprice version)
	    //Paging End -----------------------------------
	    
	    //-----For column Headers---------
	    $listCols = is_array($colList) ?  $colList :  $headers;
	    if($includeHeaders)
	    {  
	        $myhead = $doc->createElement("head");
	        $myrows->appendChild($myhead);
	        $hix = 0;
	  		foreach($headers as $key=>$h)
	  		{
	        if ($colList) {
	          if (in_array($key,$colList)){
	            $mycolumn = $doc->createElement("column");
	            $mycolumn->setAttribute('type', 'ro');
	            $mycolumn->setAttribute('align', 'center');
				
				if($headers[$key]["type"] == "int" || $headers[$key]["type"] == "decimal"){
	            	$sort_type= "int";
	            
	            }elseif($headers[$key]["type"] == "varchar" || $headers[$key]["type"] == "text" || $headers[$key]["type"] == "mediumtext" || $headers[$key]["type"] == "longtext"){
	            	$sort_type= "str";
	            
	            }elseif($headers[$key]["type"] == "datetime" || $headers[$key]["type"] == "date"){
	            	$sort_type= "date";
	            
	            }else{
					$sort_type=$headers[$key]["type"];
				}
				
				if($sort_type !=""){
	            $mycolumn->setAttribute('sort', $sort_type);
				}
				
				if(!empty($visibilityList) && !$visibilityList[$key]){
				$mycolumn->setAttribute('hidden', 'true');
				}
	
	            //TODO The following code should be modified to get the header width
	            // as the minimum width if a width is not specified by user. WCD
	            if (sizeof($widthArr)>0) { //User specified column widths are active
	              $width=$widthArr[$key];
	            }else{ //User not specified column widths so use header stuff
	              if($h['width'] =="" || $h['width'] < "15"){
	              	$width="50";
	              
	              }else{
	              	$width=$h['width'];
	              	
	              }
	            }
	            $mycolumn->setAttribute('width', $width);
	   		    $mycolumn->appendChild($doc->createTextNode('<div style="text-align:center;">'.$h['header'].'</div>')); 
	            $myhead->appendChild($mycolumn);
	            unset ($mycolumn);
	            $hix++;
	          }
	        } else {
	          $mycolumn = $doc->createElement("column");
	          $mycolumn->setAttribute('type', 'ro');
	          $mycolumn->setAttribute('align', 'center');
	          		  
			  	if($headers[$key]["type"] == "int" || $headers[$key]["type"] == "decimal"){
	            	$sort_type= "int";
	            
	            }elseif($headers[$key]["type"] == "varchar" || $headers[$key]["type"] == "text" || $headers[$key]["type"] == "mediumtext" || $headers[$key]["type"] == "longtext"){
	            	$sort_type= "str";
	            
	            }elseif($headers[$key]["type"] == "datetime" || $headers[$key]["type"] == "date"){
	            	$sort_type= "date";
	            
	            }else{
					$sort_type=$headers[$key]["type"];
				}
				
				if($sort_type !=""){
	            $mycolumn->setAttribute('sort', $sort_type);
				}
	          		  
			  if(!empty($visibilityList) && !$visibilityList[$key]){
			  $mycolumn->setAttribute('hidden', 'true');
			  }
	
	          //TODO The following code should be modified to get the header width
	          // as the minimum width if a width is not specified by user. WCD
	          if (sizeof($widthArr)>0) { //User specified column widths are active
	            $width=$widthArr[$key];
	          }else{ //User not specified column widths so use header stuff
	            if($h['width'] =="" || $h['width'] < "15"){
	            	$width="50";          
	            }else{
	            	$width=$h['width'];
	            }
	          }
	          $mycolumn->setAttribute('width', $width);
	  	      $mycolumn->appendChild($doc->createTextNode('<div style="text-align:center;">'.$h['header'].'</div>')); 
	          $myhead->appendChild($mycolumn);
	          unset ($mycolumn);
	          $hix++;
	        }
	  		}
	    } // End of Header construction
	    
	    $type_array=array("char","varchar","tinytext","text","mediumtext","longtext","mediumblob","tinyblob","blob","longblob");
	    $datarowHTML = '';
	    for($i=($start+1);$i<=($start+$nnrows);$i++)
	    {
	      $pk_grid="";
	      unset($pk_g);
	      foreach($pk as $col){
	      	$pk_g[] = $dataset[$i][$col];
	      
	      }
	      
	      $pk_grid=join("_",$pk_g);
	      unset($pk_g);
	      
	      $sidx = 0; 
	      $myrow = $doc->createElement("row");
	      
	      $myrow->setAttribute('id',$pk_grid);
	      $myrows->appendChild($myrow);
	      $si=0;
	      foreach($dataset[$i] as $key=>$v)
	      {
	      	if(!(isset($v))){
	      	 	$thisValue = '-';
	      	}else {
	      		$thisValue = $v;
	        }
	        if (is_array($colList)) {
	          if (in_array($key,$colList)) {
	            $mycell = $doc->createElement("cell");
	            $mycell->setAttribute('style',getArrayElements($rowStylesArr,$si));
				$mycell->setAttribute('fieldName',$key);
				if(in_array($headers[$key]["type"],$type_array)){
					$mycell->appendChild($doc->createCDATASection(stripslashes($thisValue)));
				
				}else{
					$mycell->appendChild($doc->createTextNode(stripslashes($thisValue)));
				}
	            $myrow->appendChild($mycell);
				$si++;
	          }
	        }else {
	          $mycell = $doc->createElement("cell");
	          $mycell->setAttribute('style',getArrayElements($rowStylesArr,$si));
			  $mycell->setAttribute('fieldName',$key);
			  if(in_array($headers[$key]["type"],$type_array)){
			  	$mycell->appendChild($doc->createCDATASection(stripslashes($thisValue)));
			  
			  }else{
			  	$mycell->appendChild($doc->createTextNode(stripslashes($thisValue)));
			  }
	          //$mycell->appendChild($doc->createTextNode(stripslashes($thisValue))); 
	          $myrow->appendChild($mycell);
			  $si++;
	        } 
	        unset ($mycell,$thisValue);
	        unset($pk_g);
	        $pk_grid="";
			
	      }
	    	$sidx++;
	      unset ($myrow);
	      
	    }
		}else{
		/////////////
		  $myrow = $doc->createElement("row");
	      $myrow->setAttribute('id','0');
	      $myrows->appendChild($myrow);
		  
		  $mycell = $doc->createElement("cell");
	      $mycell->setAttribute('style','');
		  $mycell->setAttribute('fieldName','result');
	      $mycell->appendChild($doc->createTextNode("")); 
	      $myrow->appendChild($mycell);
			    
		  $mycell = $doc->createElement("cell");
	      $mycell->setAttribute('style','');
		  $mycell->setAttribute('fieldName','result');
	      $mycell->appendChild($doc->createTextNode('No Result Found!.')); 
	      $myrow->appendChild($mycell);
	
		/////////////
		}
		$myXML=$doc->saveXML();
	    
	    return $myXML;
  }

} //-------------------End of  converDHTMLXGrid() -------------------

  /**
   * 
   * Function staff_object()
   * 
   * This function fetches the staff data from the xmlfeed and creates a 
   * session var with it. If the feched data is existing it just returns it
   * if not it will fetch the data from the server. This way it will only 
   * pull the data once per application
   * 
   * @todo Seee if performace can be improved by passing var by referance
   * 
   * @return - $staff_xml session var converted to ekwa_xml_feed object which
   *           is an extension of simpleXmlElement class (See below)
   *            
   * @author    Channa Dewamitta
   * @created   16/08/2013
   * @modified  30/10/2015 by WCD
   * @modification 
   * 
   **/   
  
  function staff_object(){
  
   $CI =&get_instance();

    	//Load staff data
	    if (! isset($_SESSION['staff_xml']) || ! $_SESSION['staff_xml']) {
	    	$cachestat='';
	      try{      	
	      	$cachestat ='STAFF CACHE MISSED!- SESSION IS:-'.session_id();
	        $_SESSION['staff_xml'] = get_content($CI->config->item('staff_feed_url').'staff/index/true/0/0/data_feed_template/XML/staff_id:full_name:time_difference?staff/status_equal=1');//_Change_        
	      } catch (Exception $e){
	        show_error('Sorry Could not connect to Server for Staff data!' );
	      }
	    }
	    try{
	    	$cachestat = ($cachestat =='')? 'STAFF CACHE HIT SUCCESS': $cachestat;
	    	if(ENVIRONMENT != 'production') log_message('info',$cachestat);
	        //return new SimpleXMLElement($_SESSION['staff_xml']);
	        return  simplexml_load_string($_SESSION['staff_xml'],"ekwa_xml_feed");
	      } catch (Exception $e){
	        show_error('Sorry Could not connect to Server for Staff data!' );
	      }
  
  }// End of staff_object ----------------

  /**
   * 
   * Function clients_object()
   * 
   * This function fetches the client data from the xmlfeed and creates a
   * session var with it. If the feched data is existing it just returns it
   * if not it will fech the data from the server. This way it will only
   * pull the data once per application
   *
   * @todo Seee if performace can be improved by passing var by referance
   *
   * @return  $client_xml session var converted to ekwa_xml_feed object which
   *           is an extension of simpleXmlElement class (See below)
   *
   * @author Channa Dewamitta
   * @created    16/08/2013
   * @modified   30/10/2015 by WCD        
   * @modification 
   *
   **/
  
  function clients_object(){
	  	//Get the Client data and meke it availabe as a simpleXMLObject
	  	
	  	if (! isset($_SESSION['clients_xml']) || ! $_SESSION['clients_xml']) {
	  		try{
	  			$_SESSION['clients_xml'] = file_get_contents(CLIENT_FEED_URL.'client_master/index/true/0/0/client_master_gridview/XML/cid:cfname:cbizname:cweb:clientstatus');  //_Change_
	  		} catch (Exception $e){
	  			show_error('Sorry Could not connect to Server for client data!' );
	  		}
	  	}
	  	try{
	  		//return new SimpleXMLElement($_SESSION['clients_xml']);
	  		return  simplexml_load_string($_SESSION['clients_xml'],"ekwa_xml_feed");
	  	} catch (Exception $e){
	  		show_error('Sorry Could not connect to Server for client data!' );
	  	}
  	
  } // End of Client_object ----------------
  
  /**
   * Function get_content()
   * 
   * This function getts the data from a URL using CURL facility
   * 
   * @param string $url - the URL fro which the data to be feched
   * @param string $user - User ID if the URL needs authentication
   * @param string $pass - User password if the URL needs authentication
   * @param int $transfer - should CURL transfer the data direct. This same
   *                        effect is achieved with ob_start by the function
   *                        however the php way is to handle it through CURL
   *                        param. Both does not work.
   * 
   * @return $client_xml session var which eeds to be converted to 
   *            simpleXml
   *            
   * @author Channa Dewamitta
   * @created 15/08/2013
   * @modified           
   * @modification       
   * 
   * 
   **/ 
	
	function get_content($url,$user=null,$pass=null,$transfer=0)
  	{
      $ch = curl_init();
      
      curl_setopt ($ch, CURLOPT_URL, $url);
      curl_setopt ($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, $transfer);
      if($user){
        curl_setopt($ch, CURLOPT_USERPWD, "$user:$pass");  
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
      }
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);   
      curl_setopt($ch, CURLOPT_COOKIESESSION, true);
  
      ob_start();
  
      curl_exec ($ch);
      curl_close ($ch);
      $string = ob_get_contents();
  
      ob_end_clean();
      
      return $string;     
  	}//End of get content 

  	/**
  	 * 
  	 * Function get_contents_with_session()
  	 * 
  	 * This function gets the contents of a file or stream while establishing the
  	 * same session. Unlike "get_content()" function hich opens a ne session hen
  	 * the file is accessed this preserves the surrent session. Especialy used to
  	 * get contents from within CI in dropdowns and other pre-built componants.
  	 *
  	 *
  	 * @return the content of the file as a string.
  	 * @author Channa Dewamitta
  	 * @created 13/12/2013
     * @modified           
     * @modification  
  	 * 
  	 *
  	 **/
  	
  	function get_contents_with_session($url){
  		 
  		$opts = array( 'http'=>array( 'method'=>"GET",
  				'header'=>"Accept-language: en\r\n" .
  				"Cookie: ".session_name()."=".session_id()."\r\n" ) );
  		$context = stream_context_create($opts);
  		session_write_close();   // this is the key
  		try {
  			$contents = file_get_contents( $url, false, $context);
  			return  $contents;
  		}catch (Exception $e)  {
  			show_error("Sorry! An error occoured while fetching data from server");
  			return false;
  		}
  	} // End of get_contents_with_session
  	
if ( ! function_exists('converDHTMLXGridTree')) {

	/**
	  * Function converDHTMLXGridTree() 
	  *
	  * Prepares and echoes XML for DHTMLX Data Grid
	  *
	  * @param $data Data Array
	  *
	  * @param $sr Optional, Enable/Disable Smart Rendering, Boolean TRUE/FALSE,
	  *  Default false
	  *
	  * @param $start Optional, Start Position of data included in XML, Default 0
	  *
	  * @param $nnrows Optional, Number of data rows to included in XML, Default 20
	  *
	  * @param $includeHeaders   boolean, optional, use true to have headers included
	  *  in XML, otherwise keep it false
	  *
	  * @param $widths , array of column widths, optional (e.g. array(100,150,200); ) 
	  *
	  * @param $cellStyles , array of CSS styles, optiona (e.g. array('color:red;font-
	  * weight:bold;','color:#00ff00'); )
	  *
	  * @param $colList , array of columns to  display, optional (e.g. array('col1','col2','col3'); ) table column names
	  * @param $title , name for inherit list (tree list title)
	  * @param $root , name for Root of grid tree.. root id is root
	  * 
	  * @return String, Grid XML
	  * 
	  */
  
	function converDHTMLXGridTree($data,$sr = false, $start=0,$nnrows=20,$includeHeaders=false, $widths='',$cellStyles='', $colList=false, $title='Hierarchy list', $root='Root') {

    $widthStr = '';
    $widthArr = array();
    $rowStyleStr = '';
    $rowStylesArr = array();
    $sidx = 0;
    
  	// For debuging WCD
    log_message('debug',"DATA ARRAY :- ".serialize($data));	 
    if(is_array($widths)) $widthArr = $widths ;
    
    if(is_array($cellStyles)){	
    	foreach($cellStyles as $rsty)
    		$rowStylesArr[] = $rsty;
    }
    
    $dataset = $data['dataset']['result_set'];
    $pk = array_unique(explode(",",$data['dataset']['metadata']['PK']));
    
    $headers =array_slice($data['dataset']['metadata'],1);
    $nrows = count($dataset);;
    $nnrows = ($nrows < $nnrows)?$nrows:$nnrows;
	
  	if (is_array($colList)) {
		$columnTitle = array_reverse(explode(",",array_shift($colList)));
		foreach($columnTitle as $columnId)
			array_unshift($colList,$columnId);
  	}
    
    //set header for XML Using DOM to do a clean job
    $doc = new DOMDocument('1.0', 'UTF-8');

    //Set Row data for XML
    $myrows = $doc->createElement("rows");
    //Following for smart rendering. Does not work with paging--
    if ($sr)   {
    	$myrows->setAttribute('parent',0);
    	$myrows->setAttribute('pos', $start);
    	$myrows->setAttribute('rec_count', $data['dataset']['total_rows']);
    }
    //Smart rendering End ---------------------------------------
	
    $doc->appendChild($myrows);
	
    if($data['dataset']['total_rows'] !=0){
    	//Following needed for paging ------------------
    	// Put Paging code here (Not needed for DHTMLX Enterprice version)
    	//Paging End -----------------------------------
    	
    	//-----For column Headers---------
    	
    	if($includeHeaders){
	    	 
	        $myhead = $doc->createElement("head");
        	$myrows->appendChild($myhead);
        	$hix = 0;
        	
//********** Creating tree colum ************************************************************//
        	$mycolumn = $doc->createElement("column");
            $mycolumn->setAttribute('type','tree');
            $mycolumn->setAttribute('align', 'center');
            $mycolumn->setAttribute('sort', 'str');
            
            //setting Tree column width
            $mycolumn->setAttribute('width', (is_array($widthArr)?array_shift($widthArr):250));
   		    $mycolumn->appendChild($doc->createTextNode('<div style="text-align:center;">'.$title.'</div>')); 
            $myhead->appendChild($mycolumn);
            unset ($mycolumn);
//*******************************************************************************************//
            
//********** creating column headers ********************************************************//
  			foreach($headers as $key=>$h)
  			{
        		if ($colList) {
          			if (in_array($key,$colList)){
            			$mycolumn = $doc->createElement("column");
            			$mycolumn->setAttribute('type', 'ro');
            			$mycolumn->setAttribute('align', 'center');
            			$mycolumn->setAttribute('sort', 'str');
            			if (sizeof($widthArr)>0) { //User specified column widths are active
              				$width=$widthArr[$key];
            			}
            			else{ //User not specified column widths so use header stuff
              				if($h['width'] =="" || $h['width'] < "15"){
              					$width="50";
              				}
              				else{
              					$width=$h['width'];
              				}
            			}
            			$mycolumn->setAttribute('width', $width);
   		    			$mycolumn->appendChild($doc->createTextNode('<div style="text-align:center;">'.$h['header'].'</div>')); 
            			$myhead->appendChild($mycolumn);
            			unset ($mycolumn);
            			$hix++;
          			}
        		}
        		else {
          			$mycolumn = $doc->createElement("column");
          			$mycolumn->setAttribute('type', 'ro');
          			$mycolumn->setAttribute('align', 'center');
          			$mycolumn->setAttribute('sort', 'str');
          			//$mycolumn->setAttribute('width', getArrayElements($widthArr,$hix));
          			//TODO The following code should be modified to get the header width
          			// as the minimum width if a width is not specified by user. WCD
          			if (sizeof($widthArr)>0) { //User specified column widths are active
            			$width=$widthArr[$key];
          			}
          			else{ //User not specified column widths so use header stuff
            			if($h['width'] =="" || $h['width'] < "15"){
            				$width="50";          
            			}
            			else{
            				$width=$h['width'];
            			}
          			}
          			$mycolumn->setAttribute('width', $width);
  	      			$mycolumn->appendChild($doc->createTextNode('<div style="text-align:center;">'.$h['header'].'</div>')); 
          			$myhead->appendChild($mycolumn);
          			unset ($mycolumn);
          			$hix++;
        		}
			}
    	} // End of Header construction
//*******************************************************************************************//
    
    	$datarowHTML = '';
    	
//********** creating root for gridtree ****************************************************//
		$rootmyrow = $doc->createElement("row");
		$rootmyrow->setAttribute('id','root');

      	$rootmyrow->setAttribute('open',0);
      	$myrows->appendChild($rootmyrow);
      		$rootcell = $doc->createElement("cell");
            $rootcell->appendChild($doc->createTextNode(stripslashes($root)));
            $rootcell->setAttribute('align', 'left');
        	$rootcell->setAttribute('width', 250); 
            $rootmyrow->appendChild($rootcell);
//*******************************************************************************************//
		    createRow($dataset,$pk,$doc,$rootmyrow,$rowStylesArr,$colList);
            
	}
	else{
	/////////////
	  $myrow = $doc->createElement("row");
      $myrow->setAttribute('id','0');
      $rootmyrow->appendChild($myrow);
	  $mycell = $doc->createElement("cell");
      $mycell->setAttribute('style','');
	  $mycell->setAttribute('fieldName','result');
      $mycell->appendChild($doc->createTextNode('No Result Found!.')); 
      $myrow->appendChild($mycell);
	/////////////
	}
	$myXML=$doc->saveXML();
    
    return $myXML;
  } //-------------------End of  converDHTMLXGridTree() -------------------

}

function createRow($dataset,$pk,$doc,$rootmyrow,$rowStylesArr,$colList){

	//********** Creating gridtree *************************************************************//
	for($i=1;$i<=count($dataset);$i++){
		$pk_grid="";

		//var_dump($pk);
		foreach($pk as $col){
			if(isset($dataset[$i][$col]))
				$pk_grid[] = $dataset[$i][$col];
		}

		$colListFilter = $colList;
		for($ix=1; $ix<count($pk_grid); $ix++){
			array_shift($colListFilter);
		}
		$pk_grid=join("_",$pk_grid);

		$myrow = $doc->createElement("row");
		$myrow->setAttribute('id',$pk_grid);
		$myrow->setAttribute('open',1);
		$rootmyrow->appendChild($myrow);
		reset($rowStylesArr);

		foreach($dataset[$i] as $key=>$value){
			$thisValue = isset($value)?$value:'';
			$thisValue = $thisValue;
			 
			if (! is_array($value)) {
				if (is_array($colListFilter)) {
					
					if (in_array($key,$colListFilter)){
						$mycell = $doc->createElement("cell");
						$mycell->setAttribute('style',current($rowStylesArr));
						$mycell->setAttribute('fieldName',$key);
						$mycell->appendChild($doc->createTextNode(stripslashes($thisValue)));
						$myrow->appendChild($mycell);
						next($rowStylesArr);
					}
				}
				else{
					$mycell = $doc->createElement("cell");
					$mycell->setAttribute('style',current($rowStylesArr));
					$mycell->setAttribute('fieldName',$key);
					$mycell->appendChild($doc->createTextNode(stripslashes($thisValue)));
					$myrow->appendChild($mycell);
					next($rowStylesArr);
				}
			}
			else{
				createRow($value,$pk,$doc,$myrow,$rowStylesArr,$colList);
			}
			unset($mycell,$thisValue);
		}
		unset ($myrow);
	}
}//-------------------End of  createRow() -------------------


if ( ! function_exists('converDropdownTree')) {

	/**
	 * Function converDropdownTree()
	 *
	 * @param $data Data Array
	 * @param $pk_names primary keys list to merge to item id, Array,
	 * @param $manager_name root name for tree
	 * @param $manager_id root staff ID
	 *
	 * @return String, Grid XML
	 */

	function converDropdownTree($data,$pk_names,$manager_name, $manager_id) {
		$doc = new DOMDocument('1.0', 'UTF-8');//set header for XML Using DOM to do a clean job
			
		$myrows = $doc->createElement("tree");//Set tree for XML
		$myrows->setAttribute('id',0);
		$doc->appendChild($myrows);
			
		if(count($data)!=0){
			//********** creating root for gridtree ********//
			$rootmyrow = $doc->createElement("item");
			$rootmyrow->setAttribute('text',$manager_name);
			$rootmyrow->setAttribute('id',$manager_id);
			$rootmyrow->setAttribute('child',0);
			$rootmyrow->setAttribute('open',1);
			$myrows->appendChild($rootmyrow);
			//*********************************************//
			createStaffItems($data,$pk_names,$doc,$rootmyrow);
		}
		else{
			//********** creating root for gridtree ********//
			$rootmyrow = $doc->createElement("item");
			$rootmyrow->setAttribute('text','No Result Found!.');
			$rootmyrow->setAttribute('id',0);
			$rootmyrow->setAttribute('child',0);
			$rootmyrow->setAttribute('open',1);
			$myrows->appendChild($rootmyrow);
			//*********************************************//
		}
		$myXML = $doc->saveXML();
		return $myXML;
	}//-End of converDHTMLXGridTree()--------------------//

}

	/**
	 * Function createStaffItems()
	 *
	 * @param $dataset Data Array
	 * @param $pk_names primary keys list to merge to item id, Array,
	 * @param $doc root
	 * @param $rootmyrow
	 *
	 * @return String, XML
	 */

function createStaffItems($dataset,$pk_names,$doc,$rootmyrow){
	//********** Creating gridtree ******************//
	for($i=1;$i<=count($dataset);$i++){

		$staff_id = array();
		for($ix=0; $ix<count($pk_names); $ix++){
			$staff_id[] = $dataset[$i][$pk_names[$ix]];
		}
		$staff_id = implode("_",$staff_id);

		$myrow = $doc->createElement("item");
		$myrow->setAttribute('text',$dataset[$i]['full_name']);
		$myrow->setAttribute('id',$staff_id);
		$myrow->setAttribute('child',0);
		$myrow->setAttribute('open',1);
		$rootmyrow->appendChild($myrow);

		foreach($dataset[$i] as $key=>$value){
			if (is_array($value)) {
				createStaffItems($value,$pk_names,$doc,$myrow);
			}
			unset($mycell,$thisValue);
		}
		unset ($myrow);
	}
}//-End of createStaffItems() ----------------------------//

/**
 * 
 *  
 * This class creates a simple object to access data fields in any of our
 * XML feeds coming from INDEX methods.
 *
 *
 * It creates a extended simpleXMLElement object with all the fields on the
 * root node. so you can just use the standard object notation like
 * obj->field_name to access the field values.
 * The getRecords method returns all the records as an iteratable object 
 * indexed with the row id.
 *
 * @package web2call\common
 * @author Channa Dewamitta
 * @license Ekwa Internal Systems Development
 * @version 1.0
 *
 *
 */
Class ekwa_xml_feed extends SimpleXMLElement
{
	/**
	 * 
	 * Function init()
	 * 
	 * The main method that select the appropriate record from the records set
	 * and create the public properties as per the XML feed
	 * 
	 *
	 * @package web2call\common\ekwa_xml_feed
	 * @method init($v,[TRUE|FALSE]) selects the row with the given ID
	 * @param mix $v ithe row ID of the XML feed to be selected
	 * @param bool $iterate - Allows the property traversing for the selected row
	 * 						by removing the original row object and leaving
	 * 						only the selected row's data.
	 * 						NOTE:- Once this
	 * 						is done if you need data of any other row you
	 * 						need to recreate the object.
	 */
	public	function init($v, $iterate = false)
	{
		$prop2bunset = array();
		$fields = $this->xpath("//row[@id=$v]/cell");
		if ($fields){
			foreach($fields as $field){
				$this->{(string) $field['fieldName']} = (string) $field;
			}
			if ($iterate) unset($this->row);
		}else{ //remove any existing properties
			foreach($this as $propname => $propval){
				//echo "<pre>",var_dump($propname)."</pre><br/>";
				if ($propname != "row") $prop2bunset[]=$propname;
			}
			foreach ($prop2bunset as $prop){
				unset($this->$prop);
			}
		}
	}
	
	/**
	 * 
	 * Function getRecords()
	 * 
	 * Methosd retrieves all data records as a standard data object with the
	 * row 'id' as the key if no params are specified.
	 *
	 *
	 * The method is at present imlementation does not accept any params and just
	 * returns all the data records as a standard data object. The usage is as follows;
	 *
	 * $obj = xmlfeed->getResords() and the $obje can be used as follows;
	 * $obj->id->field_name
	 *
	 * @package web2call\common\ekwa_xml_feed
	 * @method init($v,[TRUE|FALSE]) selects the row with the given ID
	 * @param mix $v ithe row ID of the XML feed to be selected
	 * @param bool $iterate - Allows the property traversing for the selected row
	 * 						by removing the original row object and leaving
	 * 						only the selected row's data.
	 * 						NOTE:- This method does not create properties rather
	 * 							retuns astandard object with properties and 
	 * 							indexed with row id value. 
	 * @return StdClass obect with the xml feed's data fields as properties
	 * @todo Implement the filter param functionality
	 */
	public function getRecords($filterField=FALSE,$value=FALSE)
	{
		if(($filterField && trim($filterField) =='') && ($value && $value =='')) return FALSE;
		else {
			//$records = array();
			$records = new StdClass;
			$rows = $this->row;
			foreach($rows as $row){
				$id = (string) $row['id'];
				$records->{$id} = new StdClass;
				foreach($row as $key => $val)
				{
					$records->{$id}->{(string) $val['fieldName']} = (string) $val;
				}
			}
		}
		return $records;
	}
}// end class ekwa_xml_feed
?>
