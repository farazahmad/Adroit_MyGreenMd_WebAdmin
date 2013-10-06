<?php

class Account extends AdminController
{
    function Account()
    {
        parent::AdminController();
		if(!$this->authentication->logged_in())
     		redirect('admin/login/', 'refresh');
		//load menu
		$this->load->model('menu');
		if($this->authentication->logged_in() == '1')
		$this->smarty->assign('MAIN_MENU',$this->menu->showmenu());

         $this->smarty->assign(array(
                'BASE_URL' => BASE_URL,
                'IMG_PATH' => IMG_PATH,
                'IMG_SRC' => IMG_SRC,
                'IMG_ID_PATH' => IMG_ID_PATH,
                'CSS_PATH' => CSS_PATH,
                'JS_PATH' => JS_PATH,
                'ADMIN_PATH' => ADMIN_PATH)
        );
        $this->smarty->assign('PAGETITLE' ,WEB_TITLE . ' ACCOUNT');

    }

    function index()
    {
        $this->password();
    }

    function password()
    {
        #$access_page = $this->menu->get_page_permission("Change Password");
       # $this->menu->check_write_access($access_page, "");
        
        $this->all_js->formvalidator(ADMIN_PATH.'account/change_password');
        $this->smarty->display('pages/password.html');
    }

    function change_password()
    {
        $query = $this->db->get_where('users', array('password' => md5($this->input->post('old_password')), 'user_id' => $this->session->userdata('user_id_admin')));
	$data = $query->row_array();
        if($data){
         $fields = array (
            'password'  => md5($this->input->post('new_password'))
        );
				
	$this->db->where(array('user_id' => $this->session->userdata('user_id_admin')));
        $this->db->update('users', $fields);
        //$this->smarty->display('pages/congratulation.html');
	$this->session->set_flashdata('confirmtxt',"password has been changed!");       
        }else{
            $this->session->set_flashdata('errortxt', "old password doesn't correct!");  
        }
        redirect('admin/account/password', 'refresh'); 
    }
}
