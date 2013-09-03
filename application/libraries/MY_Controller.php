<?php

/**
 * InitialDesign Controller class
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Extends the CodeIgniter Controller class
 */
class MY_Controller extends Controller
{
    
    var $curr_user_id;
    var $curr_roles;
    var $logged_in;
	var $curr_lang;
    var $_data;
    
    function MY_Controller()
    {
        parent::Controller();
        
        $this->output->enable_profiler(FALSE);
        
        $this->load->library('authentication');
        
        $this->logged_in    = $this->authentication->logged_in();
        $this->curr_user_id = $this->authentication->get_user_id();
        $this->curr_roles   = $this->authentication->get_user_roles();
		
        @define('WEB_TITLE', "Adroit - My Green Md");
        @define('WEB_LOGO', "Adroit - My Green Md");
		@define('BASE_URL', $this->config->item('base_url'));
    }

}

/**
 * Extends the MY_Controller class
 */
class AdminController extends MY_Controller
{
    
    var $is_admin = FALSE;
    var $curr_theme = 'default';
    
    function AdminController()
    {
        parent::MY_Controller();
        
        if (count($this->curr_roles) > 0)
        {
            foreach($this->curr_roles as $role)
            {
                if ($role['name'] == 'admin')
                {
                    $this->is_admin = TRUE;
                }
            }
        }
        
        //$this->curr_theme = $this->utility->get_current_themes();
        define('IMG_SRC', BASE_URL . TPLPATH . $this->curr_theme.'/admin/images/');
        define('ADMIN_PATH',  BASE_URL);
        
        define('JS_PATH', BASE_URL . 'static/js/');
        define('IMG_PATH_UPLOAD', BASE_URL . 'static/images/');
        define('PATH_UPLOAD', ROOTPATH . 'static/images/');
        define('MM_PATH', ROOTPATH . 'static/multimedia/');
        define('CSS_PATH', BASE_URL . TPLPATH . $this->curr_theme.'/admin/css/');
        define('IMG_PATH', BASE_URL . TPLPATH . $this->curr_theme.'/admin/images/');
        define('IMG_ID_PATH', BASE_URL . TPLPATH . $this->curr_theme.'/admin/images/');
		$this->smarty->assign('BASE_URL', BASE_URL);
		
		$this->smarty->assign('IMG_PATH', IMG_PATH);		
		$this->smarty->assign('IMG_PATH_UPLOAD', IMG_PATH_UPLOAD);
        $this->smarty->template_dir = TPLPATH . $this->curr_theme."/admin/html/";
        $this->smarty->compile_dir = TPLPATH . $this->curr_theme."/admin/tmp/";
		
		$BASE_URL=BASE_URL;
		$JS_PATH=JS_PATH;
        $thisPage=$this->uri->segment(1);
		$this_basePage=base_url().$this->uri->segment(1)."/";

        $this->smarty->assign("MAIN_TPL_HEADER", 'header.html');
        $this->smarty->assign("MAIN_TPL_NON_HEADER", 'non_header.html');
        $this->smarty->assign("MAIN_TPL_FOOTER", 'footer.html');
        $this->smarty->assign("user_full_name", $this->authentication->get_user_fullname());
        $this->smarty->assign("role_full_name", $this->authentication->get_role_fullname());
        $this->smarty->append("CSS",CSS_PATH."base.css");
		$this->smarty->assign("CSS_PATH",CSS_PATH);
                if($this->uri->segment(1) == "member_statistics"){
                  $this->smarty->append("add_JS",$this->all_js->addJS("jquery_161"));                    
                }else{
                  $this->smarty->append("add_JS",$this->all_js->addJS("jquery"));
                }
		
		$InlineJS=<<<END
		var Js_base_site="$BASE_URL";
		var Js_base_Page="$thisPage";
		var Js_PATH="$JS_PATH";
			function goto_page(page){
				window.location=page;
			}
			function ismaxlength(obj){
				var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : ""
				if (obj.getAttribute && obj.value.length>mlength){
					obj.value=obj.value.substring(0,mlength);
					alert('sorry, maximal '+mlength+' chars..');
				}	
			}
			function deleteconfirm(xvar){	
				new Boxy('<div id="confirm_on">'+
				'are you sure to delete this data?'+
				'<div class="confirm_button"><br/><br/>'+
				'		<a class="buttonLink2 button_okL" onclick="goto_page(\''+xvar+'\')">Yes</a> &nbsp; '+
				'		<a class="buttonLink2 button_deleteL" onclick="Boxy.get(this).hide(); return false">Cancel</a>'+
				'</div></div>',
				{title: 'Confirmation',modal:true,center:true,closeText:'Close'});
			}
			function deletedata(xvar){
				window.location=xvar;
			}

END;
			$this->smarty->append('InlineJS',$InlineJS);
			
			$confirmtxt=$this->session->flashdata('confirmtxt');
			if(!empty($confirmtxt)){			
				$confirmtxt=<<<END
				$(document).ready(function() {
					$('.confirmtxt').html("$confirmtxt");
					$('.confirmtxt').slideDown('slow');
				});
END;
			}
			$errortxt=$this->session->flashdata('errortxt');
			if(!empty($errortxt)){			
				$errortxt=<<<END
				$(document).ready(function() {
					$('.errortxt').html("$errortxt");
					$('.errortxt').slideDown('slow');
				});
END;
			}
                        
         $query_setting = $this->db->get_where('settings', array('id' => 1));
	 $this->smarty->assign("settings", $query_setting->row_array());
         
			$this->smarty->append('InlineJS',$confirmtxt);
			$this->smarty->append('InlineJS',$errortxt);
			$this->smarty->assign("WEB_TITLE", WEB_TITLE);
			
    }
    
    function _mail_config()
    {
	    $this->load->library('email');
	    //$this->load->helper('email');

	    //Mail-Config
//        $config['protocol'] = 'smtp';
        //$config['smtp_host'] = $this->smtp_host;
        //$config['smtp_user'] = $this->smtp_user;
        //$config['smtp_password'] = $this->smtp_pass;
//        $config['smtp_host'] = SMTP_HOST;
//        $config['smtp_user'] = SMTP_USER;
//        $config['smtp_password'] = SMTP_PASS;
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['mailtype'] = 'text/html';
        $this->email->initialize($config);
    }

}



?>
