<?php

class Deals extends AdminController {

    function Deals()
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
        $this->smarty->assign('PAGETITLE' ,WEB_TITLE . ' ADMIN - Deals');
    }

    function index()
    {
        $this->data_list();

    }

	function data_list()
    {
        //search var session, make session with this var
		$searchVar['session']="deals";
		//use search sql method here and use {searchVar} for input
		$searchVar['query']="name LIKE '%{searchVar}%' OR description LIKE '%{searchVar}%'";
		$this->pagnav->addSearch($searchVar);
		$getData=$this->pagnav->pagination("","","deals","","","",ADMIN_PATH."deals/page/","",$searchVar);		
		$this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
		$this->smarty->assign('list', $rows);
		$this->smarty->assign('data_show', $getData['num_row_total']);
        $this->smarty->display('deals/list.html');

    }
	
	function page($noPage="1")
    {
        //search var session, make session with this var
		$searchVar['session']="deals";
		//use search sql method here and use {searchVar} for input
		$searchVar['query']="name LIKE '%{searchVar}%' OR description LIKE '%{searchVar}%'";
		$this->pagnav->addSearch($searchVar);
		$getData=$this->pagnav->pagination($noPage,"","deals","","","",ADMIN_PATH."deals/page/","",$searchVar);			
		$this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
		$this->smarty->assign('list', $rows);
		$this->smarty->assign('data_show', $getData['num_row_total']);
        $this->smarty->display('deals/list.html');
    }
	
 	function add($type_name="", $type_id="")
    {
         $this->smarty->assign('type_name', $type_name);
         $this->smarty->assign('type_id', $type_id);
	 $this->all_js->formvalidator(ADMIN_PATH.'deals/do_add');
         $this->smarty->display('deals/add.html');
    }

   function edit( $id )
   {
        $query = $this->db->get_where('deals', array('id' => $id));
		$this->smarty->assign($query->row_array());
		$data=$query->row_array();
		$this->all_js->formvalidator(ADMIN_PATH.'deals/do_edit');  
        $this->smarty->display('deals/edit.html');
   }    
	
    function view( $id  )
    {
        $query  = $this->db->get_where('deals', array('id ' => $id ));
		$this->smarty->assign('item',$query->row_array());
        $this->smarty->display('deals/view.html');
    }	
			
	function delete($id){
		$this->db->delete('deals', array('id' => $id));
		$this->session->set_flashdata('errortxt',"data has been deleted!");
		redirect('admin/deals', 'refresh');
	}


    function do_add()
    {
        // save the object
        $fields = array (
            'type_name'  => $this->input->post('type_name'),
            'type_id'  => $this->input->post('type_id'),
            'name'  => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'expiry' => $this->input->post('expiry')
        );

        $this->db->insert('deals', $fields);
        $this->session->set_flashdata('confirmtxt',"new data has been added!"); 
        if($this->input->post('type_name')!=''){
            redirect('admin/deals/'.$this->input->post('type_name').'/'.$this->input->post('type_id'), 'refresh');
        }else{
          redirect('admin/deals/', 'refresh');
        }
    }

    function do_edit()
    {
        // save the object
        $fields = array (
            'name'        	=> $this->input->post('name'),
            'description'     => $this->input->post('description'),
            'expiry' => $this->input->post('expiry')
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('deals', $fields);
        $this->session->set_flashdata('confirmtxt',"data has been updated!");       
        redirect('admin/deals/', 'refresh');
    }
    
    function dispensary($id)
    {
        //search var session, make session with this var
	$searchVar['session']="deals";
	//use search sql method here and use {searchVar} for input
	$searchVar['query']="name LIKE '%{searchVar}%' OR description LIKE '%{searchVar}%'";
	$this->pagnav->addSearch($searchVar);
	$getData=$this->pagnav->pagination("","","deals","","type_id=$id And type_name='dispensary'","",ADMIN_PATH."deals/page/","",$searchVar);			
	$this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
	$this->smarty->assign('list', $rows);
	$this->smarty->assign('data_show', $getData['num_row_total']);
        $query = $this->db->get_where('business', array('id' => $id));
	$data = $query->row_array();
        $this->smarty->assign('deal_title', $data["name"]);
        $this->smarty->assign('type_name', "dispensary");
        $this->smarty->assign('type_id', $id);
        $this->smarty->display('deals/list.html');
    }
    
    function doctor($id)
    {
        //search var session, make session with this var
	$searchVar['session']="deals";
	//use search sql method here and use {searchVar} for input
	$searchVar['query']="name LIKE '%{searchVar}%' OR description LIKE '%{searchVar}%'";
	$this->pagnav->addSearch($searchVar);
	$getData=$this->pagnav->pagination("","","deals","","type_id=$id And type_name='doctor'","",ADMIN_PATH."deals/page/","",$searchVar);			
	$this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
	$this->smarty->assign('list', $rows);
	$this->smarty->assign('data_show', $getData['num_row_total']);
        $query = $this->db->get_where('business', array('id' => $id));
	$data = $query->row_array();
        $this->smarty->assign('deal_title', $data["name"]);
        $this->smarty->assign('type_name', "doctor");
        $this->smarty->assign('type_id', $id);
        $this->smarty->display('deals/list.html');
    }
    
    function smoke_shop($id)
    {
        //search var session, make session with this var
	$searchVar['session']="deals";
	//use search sql method here and use {searchVar} for input
	$searchVar['query']="name LIKE '%{searchVar}%' OR description LIKE '%{searchVar}%'";
	$this->pagnav->addSearch($searchVar);
	$getData=$this->pagnav->pagination("","","deals","","type_id=$id And type_name='smoke_shop'","",ADMIN_PATH."deals/page/","",$searchVar);			
	$this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
	$this->smarty->assign('list', $rows);
	$this->smarty->assign('data_show', $getData['num_row_total']);
        $query = $this->db->get_where('business', array('id' => $id));
	$data = $query->row_array();
        $this->smarty->assign('deal_title', $data["name"]);
        $this->smarty->assign('type_name', "smoke_shop");
        $this->smarty->assign('type_id', $id);
        $this->smarty->display('deals/list.html');
    }
}
