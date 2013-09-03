<?php

class Pages extends AdminController {

    function Pages()
    {
        parent::AdminController();
		$this->load->model('pagnav');
		//load menu
		$this->load->model('menu');
		$this->load->model('thumbnail');
		if($this->authentication->logged_in() == '1')
		$this->smarty->assign('MAIN_MENU',$this->menu->showmenu());
		if(!$this->authentication->logged_in())
     		redirect('login/', 'refresh');

        $this->smarty->assign(array(
                'BASE_URL' => BASE_URL,
                'IMG_PATH' => IMG_PATH,
                'IMG_SRC' => IMG_SRC,
                'IMG_ID_PATH' => IMG_ID_PATH,
                'CSS_PATH' => CSS_PATH,
                'JS_PATH' => JS_PATH,
                'PATH_UPLOAD' => BASE_URL.'static/images/',
                'ADMIN_PATH' => ADMIN_PATH)
        );
        $this->smarty->assign('PAGETITLE' ,WEB_TITLE . ' ADMIN - Pages');
    }
    
    function about_us()
   {
        $query = $this->db->get_where('pages', array('url' => "about_us"));
	$this->smarty->assign($query->row_array());
        $this->smarty->display('pages/show.html');
   }   

   function terms()
   {
        $query = $this->db->get_where('pages', array('url' => "terms"));
	$this->smarty->assign($query->row_array());
        $this->smarty->display('pages/show.html');
   } 
   
   function privacy()
   {
        $query = $this->db->get_where('pages', array('url' => "privacy"));
	$this->smarty->assign($query->row_array());
        $this->smarty->display('pages/show.html');
   } 

   function edit( $id )
   {
        $query = $this->db->get_where('pages', array('id' => $id));
		$this->smarty->assign($query->row_array());
		$data=$query->row_array();
        $this->all_js->tinymce('content');
		$this->all_js->formvalidator(ADMIN_PATH.'pages/do_edit');  
        $this->smarty->display('pages/edit.html');
   }    

    function do_edit()
    {
        // save the object
        $fields = array (
            'content'        	=> $this->input->post('content'),
            'meta_keywords'        	=> $this->input->post('meta_keywords'),
                'meta_description'        	=> $this->input->post('meta_description')
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('pages', $fields);
        
        $query = $this->db->get_where('pages', array('id' => $this->input->post('id')));
        $data=$query->row_array();
        $this->session->set_flashdata('confirmtxt',"data has been updated!");       
        redirect('pages/'.$data["url"], 'refresh');
    }
}
