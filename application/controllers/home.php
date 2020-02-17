<?php

		/**
		 * ******************************************************************************
		 * BizyCorp/Ekwa Internal development Team
		 *
		 * @category   cigen
		 * @package    Auto-Generated CI Controller
		 * @author     CIGen (Automated CI Code Generator)
		 * @version    1.0
		 * @deprecated None
		 *
		 */
		
		/**
		 * ******************************************************************************
		 *
		 *	@package    Auto-Generated CI Controller
		 *
		 *	This controller facilitates the access of table spo_yoast_seo_meta
		 *
		 *  Usage:-
		 *			1) function index() 
		 *			2) function authentication() , used to authenticate the user
		 *			3) function dbExistanceCheck() , used to check the existance of th database
		 *
		 *	Creation date     :-Jan 29, 2020
		 *  Last Modified on  :-Jan 29, 2020
		 *  Last Modification :-
		 */

class Home extends CI_Controller {
	
	public function __construct(){
		parent::__construct();	

	}
	
        /**
         * Function index()
         * of default controller
         * loads client listing
         * has reused code from Thuwans code (previous version)
         * also new code by indunil
         * 
         * Supports uploading  of Dr. photo, Business Image & Thumbnail creation
         * Supports defining linkages with GMR and DCA
         * 
         * @author Indunil Ramadasa
         * @param none
         * @return void
         * 
         */
	public function index(){
		
		//$this->dbExistanceCheck();
		//$this->authentication();
            
            $this->load->model('spo_users_model'); 
            $this->load->model('spo_hof_model'); 
            $data['clients'] = $this->spo_users_model->get_clients();
            $ids = array();
            foreach($data['clients'] as $client)
            {
                $data['clients'][$client['ID']]['hof'] = $this->spo_hof_model->get_hof($client['ID']);
                $ids[] = $client['ID'];
            }
            $data['ids'] = join(',',$ids);
          //  var_dump($data['ids']);
           // echo getcwd();
           // var_dump($_POST);
           $dr_image_uploaded = false;// Added by Indunil
           $dr_logo_uploaded = false; // Added by Indunil
           $linkages_updated = false; // Added by Indunil
           
           if(isset($_POST['gmr_connection']))
           {               
                $this->spo_hof_model->update_linkages($this->input->post('gmr_connection'),$this->input->post('dfm_connection'),$this->input->post('linkage_client_id'));
           
                $linkages_updated = true;
           }
            if(isset($_FILES['dr-img']))
            {
                
                // Start of Thuwan's original code 01
                if ( move_uploaded_file($_FILES["dr-img"]["tmp_name"], $this->config->item('hof_base_path').'upload_pic/'.$_FILES["dr-img"]["name"]) )
                {
                    $image = imagecreatefromjpeg($this->config->item('hof_base_path').'images/pic_bg.jpg');
                    // Transparent background output
                    imageSaveAlpha($image, true);
                    ImageAlphaBlending($image, true);
                    
                    $pro_pic = $this->config->item('hof_base_path').'upload_pic/'.$_FILES["dr-img"]["name"];
                    if ($pro_pic!='') {
			    $badge_img = $pro_pic;
			    if (file_exists($badge_img)) {
					$file_parts = pathinfo($pro_pic);
					if ($file_parts['extension']==='png') {
						$badge = imagecreatefrompng($badge_img);
					} else if ($file_parts['extension']==='jpg') {
						$badge = imagecreatefromjpeg($badge_img);
					} else if ($file_parts['extension']==='gif') {
						$badge = imagecreatefromgif($badge_img);
					} else {
						$badge = imagecreatefromjpeg($badge_img);
					}
			        $badge_width  = imagesx($badge);
			        $badge_height = imagesy($badge);
			        if ($badge_width<$badge_height) {
			        	$badge_newheight = 165/$badge_width*$badge_height;
			        	imagecopyresampled($image, $badge, 0, 0, 0, 0, 165, $badge_newheight, $badge_width, $badge_height);
			        } else if ($badge_width>$badge_height) {
			        	$badge_newwidth = 165/$badge_height*$badge_width;
			        	imagecopyresampled($image, $badge, 0, 0, 0, 0, $badge_newwidth, 165, $badge_width, $badge_height);
			        } else {
			        	imagecopyresampled($image, $badge, 0, 0, 0, 0, 165, 165, $badge_width, $badge_height);
			        }
			    }
				// Save image
                            ///addition by Indunil - start //
                            $target_base  = $this->config->item('hof_profiles_path').$this->input->post('dr_id').'/';
                            @mkdir($target_base);
                            //addition by Indunil - end //
				imagepng($image, $target_base.'dr_img.png');
				}
				// ------------- !END - Add Profile Image -----------------
                                
                    $dr_image_uploaded = true; // Added by Indunil
                }
                // end of Thuwan's original code 01
            }
            if(isset($_FILES['dr-logo']))
            {
                // Start of Thuwan's original code 02
                if ( move_uploaded_file($_FILES["dr-logo"]["tmp_name"], $this->config->item('hof_base_path').'upload_pic/'.$_FILES["dr-logo"]["name"]) )
                {
                    $filename = $this->config->item('hof_base_path').'upload_pic/'.$_FILES["dr-logo"]["name"];

                    // Get new sizes
                    list($width, $height) = getimagesize($filename);
                    $newwidth = 63/$height * $width;
                    $newheight = 63;

                    // Load
                    $thumb = imagecreatetruecolor($newwidth, $newheight);
                    $file_parts = pathinfo($filename);
                    if ($file_parts['extension']==='png') {
                            $white = imagecolorallocate($thumb, 255, 255, 255); 
                            imagefill($thumb,0,0,$white); 
                            $source = imagecreatefrompng($filename);
                    } else if ($file_parts['extension']==='jpg') {
                            $source = imagecreatefromjpeg($filename);
                    } else if ($file_parts['extension']==='gif') {
                            $white = imagecolorallocate($thumb, 255, 255, 255); 
                            imagefill($thumb,0,0,$white); 
                            $source = imagecreatefromgif($filename);
                    } else {
                            $source = imagecreatefromjpeg($filename);
                    }

                    // Resize
                    imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                    // Output
                    $target_base  = $this->config->item('hof_profiles_path').$this->input->post('dr_id').'/';
                    @mkdir($target_base);
                    imagepng($thumb, $target_base.'dr_logo.png');
                    $dr_logo_uploaded = true; // Added by Indunil
                }
                // End of Thuwan's original code 02
            }
            //Start of GMR connections
            $data['gmr_connections'] = array();
            $xml=simplexml_load_file("https://www.growmyreviews.com/dashboard/wpvn_db_clients/index/true/0/0/data_feed_template/XML/client_id:client_name/?cdb&client_status_equal=active");
            foreach ($xml->row as $key => $value) {
                if(isset($value->cell[1]))
                {
                    $data['gmr_connections'][(string)$value->cell[0]] = $value->cell[1];
                }
            }
            // End of GMR Connection
            //Start of GMR connections
            $data['dfm_connections'] = array();
            $xml=simplexml_load_file("https://doneformesocial.com/admin/index.php/client_controller/index/true/0/0/data_feed_template/XML/client_id:client_name:practice_name:client_email/?cdb");
            foreach ($xml->row as $key => $value) {
                if(isset($value->cell[1]))
                {
                    $data['dfm_connections'][(string)$value->cell[0]] = $value->cell[2];
                }
            }
            // End of GMR Connection
            $data['dr_image_uploaded'] = $dr_image_uploaded;
            $data['dr_logo_uploaded'] = $dr_logo_uploaded;
            $data['linkages_updated'] = $linkages_updated;
            
            $this->load->view('home',$data);
	}
	
	public function authentication(){
		$this->load->library('Uaacs_authentication');
		$mySession = session_id();
		
		if(isset($_POST['user_role'])){
			$_SESSION['user_role'] 	= $_POST['user_role'];
		
		}else if(!isset($_SESSION['user_role'])){
			$_SESSION['user_role'] = isset($_COOKIE["defRoleId_".$this->config->item('UAACS_APPID')])? $_COOKIE["defRoleId_".$this->config->item('UAACS_APPID')]: $this->config->item('role_staff') ;  //Set default
		}
		
		$roleId = $_SESSION['user_role'];
		
		//Authentication via UAACS -----------------------------------
		$uaacs = new Uaacs_authentication ;
		$uaacs->setLandingPage(base_url());
		$uaacs->setAccessKey($this->config->item('UAACS_ACCESS_KEY'));
		$uaacs->setSecurityKey($this->config->item('UAACS_SEC_KEY')) ;
		$uaacs->setAppId($this->config->item('UAACS_APPID')) ;
		$uaacs->setRoleId($roleId) ;
		
		//Following are optional
		$uaacs->setLogoutUrl($this->config->item('UAACS_LOGOUT_URL'));
		$uaacs->setLoginUrl($this->config->item('UAACS_LOGIN_URL'));
		$uaacs->setLgnCheckUrl($this->config->item('UAACS_LOGIN_CHECK_URL'));
		$uaacs->authenticate();
		
		$functions = array();
		foreach ($uaacs->getAllowedFunctions() as $key=>$value){ $functions[] = $key; }
		
		$myRoles 	= $uaacs->getAllowedRoles();      //An array
		$roleId 	= $uaacs->getActiveRole();
		$data 		= $uaacs->getUserData();          //simpleXMLObject
		
		
		$_SESSION['application_valid_login']=true;
		$_SESSION['user_functions']	= $functions ; log_message('info', "\$functions :-".serialize($functions));//An array
		$_SESSION['roleId'] 		= $roleId;
		$_SESSION['active_role'] 	= $roleId;
		$_SESSION['user_role'] 		= $roleId;
		$_SESSION['user_id'] 		= (string) $data->DATALIST->USER->UID ;
		$_SESSION['user_name'] 		= (string) $data->DATALIST->USER->NAME;
		$_SESSION['user_email'] 	= (string) $data->DATALIST->USER->EMAIL;
		$_SESSION['last_login'] 	= (string) $data->DATALIST->USER->LOGIN_DATE_TIME;
		$_SESSION['user_type'] 		= (string) $myRoles[$roleId]['NAME'];
		
		$_SESSION['myRoles'] = $myRoles ;

		
		//Following added to save the default role if other thn CC. WCD 22/06/12
		if (!isset($_COOKIE["defRoleId_".$this->config->item('UAACS_APPID')])) setcookie("defRoleId_".$this->config->item('UAACS_APPID'),$roleId,time()+604800,"/", "{$_SERVER['SERVER_NAME']}");
		
		//Load the main UI
		$this->load->view("mainUserLayout");
	}//end of index
	
	public function dbExistanceCheck(){
		
		$dbObj = new dbcreator();
		
		if(!$dbObj->checkExistance()){
			
			 
			//Create Db
			$dbObj->createDb();
			 
			//Create User
			$dbObj->createUser();
			 
			//Add user to DB - ALL Privileges
			$dbObj->addUserToDb('&ALL=ALL');
			 
			//$dbObj->createTables();
			 
			//Add user to DB - SELECTED PRIVILEGES
			//addUserToDb('cPanelUsername','cPanelPass','dbUsername','dbName','&CREATE=CREATE&ALTER=ALTER');
		}
		
		
	}
        
        function get_current_linkages()
        {
            $this->load->model('spo_hof_model'); 
            $client_ids = explode(',',$_POST['ids']);
            $out = array();
            foreach ($client_ids as $client_id)
            {
                $linkages = $this->spo_hof_model->get_hof($client_id);
                if(is_array($linkages) && (sizeof($linkages) > 0))
                {
                    $linkages = $linkages[0];
                    $this_item = $linkages['hof_id'].','.$linkages['gmr_id'].','.$linkages['dfm_id'];
                }
                else
                    $this_item =  "0,0,0";
                
                $out[] = $client_id.','.$this_item;
            }
            $out = join('::',$out);
            echo $out;
        }
}

?>
