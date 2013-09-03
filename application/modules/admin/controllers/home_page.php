<?php

class Home_page extends AdminController
{
    function Home_page()
    {
        parent::AdminController();
		
        if(!$this->authentication->logged_in())redirect('admin/login/', 'refresh');
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
		$this->smarty->assign('PAGETITLE' ,WEB_TITLE . '- HOME PAGE');

    }

    function index()
    {
        if($this->input->post('save')){
			$data = $this->input->post('data');			

			$this->db->where('page_url ', "home");
			$this->db->update('page', $data);
			redirect("admin/home_page");
		}
		$query  = $this->db->get_where('page', array('page_url' => 'home'));
		$this->smarty->assign('item',$query->row_array());
		
		$this->all_js->tinymce('page_description');
		$this->all_js->formvalidator(ADMIN_PATH.'home_page');
		
		$this->smarty->display('pages/home_page.html');
    }

      
}
