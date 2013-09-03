<?php

class Rooms extends AdminController {

    function Rooms()
    {
        parent::AdminController();
		$this->load->model('pagnav');
		//load menu
		$this->load->model('menu');
		$this->load->model('thumbnail');
		if($this->authentication->logged_in() == '1')
		
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
                'ADMIN_PATH' => ADMIN_PATH,
                'access_page' => $this->access_page)
        );
        $this->smarty->assign('PAGETITLE' ,WEB_TITLE . ' ADMIN - Rooms');
    }

    function index()
    {
        $this->data_list();

    }

	function data_list()
    {
        //search var session, make session with this var
		$searchVar['session']="rooms";
		//use search sql method here and use {searchVar} for input
		$searchVar['query']="name LIKE '%{searchVar}%'";
		$this->pagnav->addSearch($searchVar);
		$getData=$this->pagnav->pagination("","","rooms","","","",ADMIN_PATH."rooms/page/","",$searchVar);		
		$this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
		$this->smarty->assign('list', $rows);
		$this->smarty->assign('data_show', $getData['num_row_total']);
        $this->smarty->display('rooms/list.html');

    }
	
	function page($noPage="1")
    {
        //search var session, make session with this var
		$searchVar['session']="rooms";
		//use search sql method here and use {searchVar} for input
		$searchVar['query']="name LIKE '%{searchVar}%'";
		$this->pagnav->addSearch($searchVar);
		$getData=$this->pagnav->pagination($noPage,"","rooms","","","",ADMIN_PATH."rooms/page/","",$searchVar);			
		$this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
		$this->smarty->assign('list', $rows);
		$this->smarty->assign('data_show', $getData['num_row_total']);
        $this->smarty->display('rooms/list.html');
    }
	
 	function add()
    {
        $this->all_js->tinymce('description');
		$this->all_js->formvalidator(ADMIN_PATH.'rooms/do_add');
         $this->smarty->display('rooms/add.html');
    }

   function edit( $id )
   {
        $query = $this->db->get_where('rooms', array('id' => $id));
		$this->smarty->assign($query->row_array());
		$data=$query->row_array();
        $this->all_js->tinymce('description');
		$this->all_js->formvalidator(ADMIN_PATH.'rooms/do_edit');  
        $this->smarty->display('rooms/edit.html');
   }    
	
    function view( $id  )
    {
        $query  = $this->db->get_where('rooms', array('id ' => $id ));
		$this->smarty->assign('item',$query->row_array());
        $this->smarty->display('rooms/view.html');
    }	
			
	function delete($id){
		$this->db->delete('rooms', array('id' => $id));
		$this->session->set_flashdata('errortxt',"data has been deleted!");
		redirect('rooms', 'refresh');
	}


    function do_add()
    {
        // save the object
        $fields = array (
            'name'  => $this->input->post('name'),
            'description' => $this->input->post('description')
        );

        $this->db->insert('rooms', $fields);
        $this->session->set_flashdata('confirmtxt',"new data has been added!");       
        redirect('rooms/', 'refresh');
    }

    function do_edit()
    {
        // save the object
        $fields = array (
            'name'        	=> $this->input->post('name'),
            'description'     => $this->input->post('description')
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('rooms', $fields);
        $this->session->set_flashdata('confirmtxt',"data has been updated!");       
        redirect('rooms/', 'refresh');
    }
}
