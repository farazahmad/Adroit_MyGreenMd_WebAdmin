<?php

class Packages extends AdminController {

    function Packages()
    {
        parent::AdminController();
		$this->load->model('pagnav');
		//load menu
		$this->load->model('menu');
		$this->load->model('thumbnail');
		if($this->authentication->logged_in() == '1')
		$this->smarty->assign('MAIN_MENU',$this->menu->showmenu());
		if(!$this->authentication->logged_in())
     		redirect('admin/login/', 'refresh');

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
        $this->smarty->assign('PAGETITLE' ,WEB_TITLE . ' ADMIN - Packages');
    }

    function index()
    {
        $this->data_list();

    }

	function data_list()
    {
        //search var session, make session with this var
		$searchVar['session']="packages";
		//use search sql method here and use {searchVar} for input
		$searchVar['query']="name LIKE '%{searchVar}%' OR description LIKE '%{searchVar}%'";
		$this->pagnav->addSearch($searchVar);
		$getData=$this->pagnav->pagination("","","packages","","","",ADMIN_PATH."packages/page/","",$searchVar);		
		$this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
		$this->smarty->assign('list', $rows);
		$this->smarty->assign('data_show', $getData['num_row_total']);
        $this->smarty->display('packages/list.html');

    }
	
	function page($noPage="1")
    {
        //search var session, make session with this var
		$searchVar['session']="packages";
		//use search sql method here and use {searchVar} for input
		$searchVar['query']="name LIKE '%{searchVar}%' OR description LIKE '%{searchVar}%'";
		$this->pagnav->addSearch($searchVar);
		$getData=$this->pagnav->pagination($noPage,"","packages","","","",ADMIN_PATH."packages/page/","",$searchVar);			
		$this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
		$this->smarty->assign('list', $rows);
		$this->smarty->assign('data_show', $getData['num_row_total']);
        $this->smarty->display('packages/list.html');
    }
	
 	function add()
    {
        $this->all_js->tinymce('description');
		$this->all_js->formvalidator(ADMIN_PATH.'packages/do_add');
         $this->smarty->display('packages/add.html');
    }

   function edit( $id )
   {
        $query = $this->db->get_where('packages', array('id' => $id));
		$this->smarty->assign($query->row_array());
		$data=$query->row_array();
        $this->all_js->tinymce('description');
		$this->all_js->formvalidator(ADMIN_PATH.'packages/do_edit');  
        $this->smarty->display('packages/edit.html');
   }    
	
    function view( $id  )
    {
        $query  = $this->db->get_where('packages', array('id ' => $id ));
		$this->smarty->assign('item',$query->row_array());
        $this->smarty->display('packages/view.html');
    }	
			
	function delete($id){
		$this->db->delete('packages', array('id' => $id));
		$this->session->set_flashdata('errortxt',"data has been deleted!");
		redirect('admin/packages', 'refresh');
	}


    function do_add()
    {
        // save the object
        $fields = array (
            'name'  => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'duration' => $this->input->post('duration'),
            'price' => $this->input->post('price')
        );

        $this->db->insert('packages', $fields);
        $this->session->set_flashdata('confirmtxt',"new data has been added!");       
        redirect('admin/packages/', 'refresh');
    }

    function do_edit()
    {
        // save the object
        $fields = array (
            'name'        	=> $this->input->post('name'),
            'description'     => $this->input->post('description'),
            'duration' => $this->input->post('duration'),
            'price' => $this->input->post('price')
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('packages', $fields);
        $this->session->set_flashdata('confirmtxt',"data has been updated!");       
        redirect('admin/packages/', 'refresh');
    }
}
