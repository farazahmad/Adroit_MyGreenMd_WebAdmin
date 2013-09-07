<?php 

class Initial extends AdminController
{
	
	function Initial()
	{
        parent::AdminController();
        //load menu
		$this->load->model('menu');
		if($this->authentication->logged_in() == '1')
		$this->smarty->assign('MAIN_MENU',$this->menu->showmenu());
                $this->access_page = $this->menu->get_all_page_permission();
		 $this->smarty->assign(array(
                'BASE_URL' => BASE_URL,
                'IMG_PATH' => IMG_PATH,
                'IMG_SRC' => IMG_SRC,
                'IMG_ID_PATH' => IMG_ID_PATH,
                'CSS_PATH' => CSS_PATH,
                'JS_PATH' => JS_PATH,
                'ADMIN_PATH' => ADMIN_PATH,
                'access_page' => $this->access_page)
        );
		
	}
	
	function index()
	{
        if($this->authentication->logged_in() == '1')
            redirect('admin/login', 'refresh');
            
        $this->dashboard();
	}
	function dashboard()
	{
         if(!$this->authentication->logged_in())
            redirect('admin/login', 'refresh');

        //$this->_check_menu('home');
		//$this->menu->check('home');		
			
        $this->smarty->assign('PAGETITLE' ,WEB_TITLE . ' DASHBOARD ');
        $this->smarty->display('pages/home.html');
	}
    function login()
    {
        if($this->authentication->logged_in() == '1'){
            redirect('admin/home', 'refresh');
		}
		$BASE_URL=BASE_URL;
        $user = $this->input->post('username');
        $password = $this->input->post('password');
        $check_ip = $this->authentication->check_ip();
				
        if($this->authentication->login($user, $password))
        {
            //redirect('admin/home', 'refresh');
			echo "success"; die();			
        }
        else
        {
            if($this->input->post('login'))
            {
                $this->smarty->assign('warning', TRUE);
            }
			//$this->smarty->append("add_JS",$this->all_js->addJS("php_js"));
			//$this->smarty->append("add_JS",$this->all_js->addJS("boxy"));
			$InlineJS=<<<END
		$(document).ready(function() {				
			$("#username,#password").click(function(){
				$(this).val("");
			});
			$("#username,#password").keypress(function (e) {
				if(e.which==13){
					$("#do_login").click();
				}
			});
			$('#do_login').click(function(){
				$('#title_message').hide();
				if($("#username,#password").val()==""){
					$('#title_message').css('color','red');
					$('#title_message').html('Please fill username and password!');
					$('#title_message').fadeIn();
				}else
				{
				//ajax login here
						$('#title_message').css('color','green');
						$('#title_message').removeClass('title_message');
						$('#title_message').addClass('title_message2');
						$('#title_message').html('Loading..');
						$('#title_message').fadeIn();
						var str = $("#flogin").serialize();	
						$.ajax({
						   type: "POST",
						   url: "{$BASE_URL}admin/login.html",
						   data: str,
						   success: function(msg){							
						     if(msg=='success'){
								$('#title_message').html('Accepted, redirecting to dashboard..');
								window.location='home.html';
							 }else
							 {
								$('#title_message').removeClass('title_message2');
								$('#title_message').addClass('title_message');
								$('#title_message').css('color','red');
								$('#title_message').html("Login failed, wrong username or password!");
							 }
						   }
						 });
				}	
			});					
		});
END;
			$this->smarty->append('InlineJS',$InlineJS);
			$this->smarty->assign('BLOCKED',$check_ip);
            $this->smarty->assign('PAGETITLE' ,WEB_TITLE . ' ADMIN LOGIN ');
            $this->smarty->assign('header_menu', 'disabled');
            $this->smarty->display('pages/login.html');
        }
    }

    function home()
    {
        if(!$this->authentication->logged_in())
            redirect('admin/login', 'refresh');

        //$this->_check_menu('home');
		//$this->menu->check('home');		
			
        $this->smarty->assign('PAGETITLE' ,WEB_TITLE . ' DASHBOARD ');
        $this->smarty->display('pages/home.html');
    }

    function logout()
    {
        $this->authentication->logout();
		redirect('admin/login', 'refresh');
    }
    
    function settings()
    {
        $access_page = $this->menu->get_page_permission("Settings");
        $this->menu->check_write_access($access_page, "");
        $query = $this->db->get_where('settings', array('id' => 1));
        $data=$query->row_array();
	$this->smarty->assign($data);
        $this->all_js->formvalidator(ADMIN_PATH.'do_settings');  
        $this->smarty->assign('PAGETITLE' ,WEB_TITLE . ' Settings ');
        $this->smarty->display('pages/settings.html');
    }
    
    function do_settings()
    {
        $this->db->where('id', 1);
        $this->db->update('settings', $this->input->post('data'));
        $this->session->set_flashdata('confirmtxt',"data has been updated!");       
        redirect('admin/settings', 'refresh');
    }
    
    function setlang($page,$lang="")
    {
       
		//save session lang with this page
		if(empty($lang)){
			//$this->session->set_flashdata('confirmtxt',"new data has been added!");
			$deflang=explode(",",DEF_LANG);
			$lang=$deflang[1];
		} 
		//echo $page." - ".$lang;
		$this->session->set_userdata('lang_'.$page,$lang);
		header("location: ".$this->agent->referrer());
		
    }
	
	function upload($uid)
	{
		if (!empty($_FILES)) {
			//$path = $_SERVER['DOCUMENT_ROOT'] . $this->config->item('path') . '/upload/'.$uid.'/';
			//$this->createDir($path);
			$extension = pathinfo($_FILES['doc']['name']);
			$extension = $extension['extension'];
			
			if($extension=="flv"){
				$path = MM_PATH."video/";
				$status=2;
			}else{
				$path = MM_PATH."foto/";
				$status=1;
			}
			
			$file_temp = $_FILES['doc']['tmp_name'];
			$file_name_ori = basename($_FILES['doc']['name']);
			$filecount = count(glob($path . "*.*"));
			$file_name_tm =explode(".",$file_name_ori);
			if(count($file_name_sv)<2){
				$file_name_sv=$file_name_tm[0];
			}else{
				$file_name_sv=$file_name_ori;
			}
			
			$file_name = $uid.$filecount.date('Ymdhis').'.'.$extension;
			$targetFile = str_replace('//','/',$path) . $file_name;
			@move_uploaded_file($file_temp, $targetFile);
			
			$fields = array (
        	'multimedia_path'  => $file_name,
            'title'        	=> $file_name_sv,
            'description'     => "no Description",
            'status'    => $status,
            'sort'    => '0'
	        );
	
	       	$this->db->insert('medias', $fields);
		}
		echo '1';
	}
	
	function createDir($wd)
	{
		do {
			$dir = $wd;
			while (!is_dir($dir)) {
				$basedir = dirname($dir);
				if ($basedir == '/' || is_dir($basedir))
					mkdir($dir,0777);
				else
					$dir=$basedir;
			}
		} while ($dir != $wd);
	}
	
}
