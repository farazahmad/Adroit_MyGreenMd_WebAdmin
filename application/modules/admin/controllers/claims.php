<?php

class Claims extends AdminController {

    function Claims()
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
        $this->smarty->assign('PAGETITLE' ,WEB_TITLE . ' ADMIN - Claims');
    }

    function index()
    {
        $this->data_list();

    }

	function data_list()
    {
        //search var session, make session with this var
		$searchVar['session']="claims";
		//use search sql method here and use {searchVar} for input
		$searchVar['query']="name LIKE '%{searchVar}%' OR username LIKE '%{searchVar}%' OR email LIKE '%{searchVar}%'";
		$this->pagnav->addSearch($searchVar);
		$getData=$this->pagnav->pagination("","","claims","","","",ADMIN_PATH."claims/page/","",$searchVar);		
		$this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
		$this->smarty->assign('list', $rows);
		$this->smarty->assign('data_show', $getData['num_row_total']);
        $this->smarty->display('claims/list.html');

    }
	
	function page($noPage="1")
    {
        //search var session, make session with this var
		$searchVar['session']="claims";
		//use search sql method here and use {searchVar} for input
		$searchVar['query']="name LIKE '%{searchVar}%' OR username LIKE '%{searchVar}%' OR email LIKE '%{searchVar}%'";
		$this->pagnav->addSearch($searchVar);
		$getData=$this->pagnav->pagination($noPage,"","claims","","","",ADMIN_PATH."claims/page/","",$searchVar);			
		$this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
		$this->smarty->assign('list', $rows);
		$this->smarty->assign('data_show', $getData['num_row_total']);
        $this->smarty->display('claims/list.html');
    }
	
 	function add()
    {
		$this->all_js->formvalidator(ADMIN_PATH.'claims/do_add');
         $this->smarty->append("add_JS",$this->all_js->addJS("uicalendar"));
        $this->smarty->append("InlineJS", '
        $(document).ready(function(){
                $("#date").datepicker({dateFormat: \'yy-mm-dd\'});
        });					
        '); 
         $this->smarty->display('claims/add.html');
    }

   function edit( $id )
   {
        $query = $this->db->get_where('claims', array('id' => $id));
		$this->smarty->assign($query->row_array());
		$data=$query->row_array();
		$this->all_js->formvalidator(ADMIN_PATH.'claims/do_edit');  
        $this->smarty->append("add_JS",$this->all_js->addJS("uicalendar"));
        $this->smarty->append("InlineJS", '
        $(document).ready(function(){
                $("#date").datepicker({dateFormat: \'yy-mm-dd\'});
        });					
        '); 
        $this->smarty->display('claims/edit.html');
   }    
	
    function view( $id  )
    {
        $query  = $this->db->get_where('claims', array('id ' => $id ));
		$this->smarty->assign('item',$query->row_array());
        $this->smarty->display('claims/view.html');
    }	
			
	function delete($id){
		$this->db->delete('claims', array('id' => $id));
		$this->session->set_flashdata('errortxt',"data has been deleted!");
		redirect('claims', 'refresh');
	}
        
        
        function approve($id){
            $this->db->where('id', $id);
            $this->db->update('claims', array ('is_approved' => 1));
	    $this->session->set_flashdata('confirmtxt',"Claim Approved!");
	    redirect('claims', 'refresh');
	}

        function reject($id){
            $this->db->where('id', $id);
            $this->db->update('claims', array ('is_approved' => 0));
	    $this->session->set_flashdata('errortxt',"Claim Rejected!");
	    redirect('claims', 'refresh');
	}

    function do_add()
    {
        // save the object
        $fields = array (
            'name'  => $this->input->post('name'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'date' => $this->input->post('date'),
        );

        $this->db->insert('claims', $fields);
        $this->session->set_flashdata('confirmtxt',"new data has been added!");       
        redirect('claims/', 'refresh');
    }

    function do_edit()
    {
        // save the object
        $fields = array (
            'name'        	=> $this->input->post('name'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'date' => $this->input->post('date'),
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('claims', $fields);
        $this->session->set_flashdata('confirmtxt',"data has been updated!");       
        redirect('claims/', 'refresh');
    }
}
