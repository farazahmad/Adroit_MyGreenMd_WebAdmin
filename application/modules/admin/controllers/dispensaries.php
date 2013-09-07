<?php

class Dispensaries extends AdminController {

    function Dispensaries()
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
        $this->smarty->append("add_JS",$this->all_js->addJS("rating"));
        $this->smarty->append("InlineJS", '
        $(document).ready(function(){
           $("input.star").rating();
        });					
        '); 
        $this->smarty->assign('PAGETITLE' ,WEB_TITLE . ' ADMIN - Dispensaries');
    }

    function index()
    {
        $this->data_list();

    }

	function data_list()
    {
        //search var session, make session with this var
		$searchVar['session']="dispensaries";
		//use search sql method here and use {searchVar} for input
		$searchVar['query']="name LIKE '%{searchVar}%' OR description LIKE '%{searchVar}%'";
		$this->pagnav->addSearch($searchVar);
		$getData=$this->pagnav->pagination("","","dispensaries","","","",ADMIN_PATH."dispensaries/page/","",$searchVar);		
		$this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
		$this->smarty->assign('list', $rows);
		$this->smarty->assign('data_show', $getData['num_row_total']);
        $this->smarty->display('dispensaries/list.html');

    }
	
	function page($noPage="1")
    {
        //search var session, make session with this var
		$searchVar['session']="dispensaries";
		//use search sql method here and use {searchVar} for input
		$searchVar['query']="name LIKE '%{searchVar}%' OR description LIKE '%{searchVar}%'";
		$this->pagnav->addSearch($searchVar);
		$getData=$this->pagnav->pagination($noPage,"","dispensaries","","","",ADMIN_PATH."dispensaries/page/","",$searchVar);			
		$this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
		$this->smarty->assign('list', $rows);
		$this->smarty->assign('data_show', $getData['num_row_total']);
        $this->smarty->display('dispensaries/list.html');
    }
	
 	function add()
    {
	$this->all_js->formvalidator(ADMIN_PATH.'dispensaries/do_add');
        $this->smarty->display('dispensaries/add.html');
    }

   function edit( $id )
   {
        $query = $this->db->get_where('dispensaries', array('id' => $id));
		$this->smarty->assign($query->row_array());
		$data=$query->row_array();
		$this->all_js->formvalidator(ADMIN_PATH.'dispensaries/do_edit');  
        $this->smarty->display('dispensaries/edit.html');
   }    
	
    function view( $id  )
    {
        $query  = $this->db->get_where('dispensaries', array('id ' => $id ));
		$this->smarty->assign('item',$query->row_array());
        $this->smarty->display('dispensaries/view.html');
    }	
			
	function delete($id){
		$this->db->delete('dispensaries', array('id' => $id));
		$this->session->set_flashdata('errortxt',"data has been deleted!");
		redirect('admin/dispensaries', 'refresh');
	}
        
    function highlight($id, $value){
        $this->db->where('id', $id);
        $data = 0;
        if($value == "true"){
         $data =1;   
        }
        $this->db->update('dispensaries', array ('highlight' => $data));
        $this->session->set_flashdata('confirmtxt',"data has been updated!");
        redirect('admin/dispensaries', 'refresh');
    }
    
    function featured($id, $value){
        $this->db->where('id', $id);
        $data = 0;
        if($value == "true"){
         $data =1;   
        }
        $this->db->update('dispensaries', array ('featured' => $data));
        $this->session->set_flashdata('confirmtxt',"data has been updated!");
        redirect('admin/dispensaries', 'refresh');
    }


    function do_add()
    {
        $filename='';
        if(!empty($_FILES['uploadImg']['name'])){
            $config['upload_path'] = PATH_UPLOAD."dispensaries/";
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $config['max_size']	= 0;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('uploadImg')){
                    $add_error=$this->upload->display_errors();
            }else
            {
                    $dataUpload=$this->upload->data();
                    $filename=$dataUpload["file_name"];
            }
        }
        // save the object
        $fields = array (
            'name'  => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'zip_code' => $this->input->post('zip_code'),
            'email' => $this->input->post('email'),
            'website' => $this->input->post('website'),
            'description' => $this->input->post('description'),
            'timing' => $this->input->post('timing'),
            'open_time' => $this->input->post('open_time'),
            'close_time' => $this->input->post('close_time'),
            'phone' => $this->input->post('phone'),
            'rating' => $this->input->post('rating'),
            'picture'     => $filename
        );

        $this->db->insert('dispensaries', $fields);
        $this->session->set_flashdata('confirmtxt',"new data has been added!");       
        redirect('admin/dispensaries/', 'refresh');
    }

    function do_edit()
    {
        $filename =$this->input->post('picture');
    	if(!empty($_FILES['uploadImg']['name'])){
                $config['upload_path'] = PATH_UPLOAD."events/";
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;
                $config['max_size']	= 0;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('uploadImg')){
                        $add_error=$this->upload->display_errors();
                }else
                {
                        @unlink(PATH_UPLOAD."events/".$filename);
                        $dataUpload=$this->upload->data();
                        $filename=$dataUpload["file_name"];
                }
        }
        // save the object
        $fields = array (
            'name'  => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'zip_code' => $this->input->post('zip_code'),
            'email' => $this->input->post('email'),
            'website' => $this->input->post('website'),
            'description' => $this->input->post('description'),
            'timing' => $this->input->post('timing'),
            'open_time' => $this->input->post('open_time'),
            'close_time' => $this->input->post('close_time'),
            'phone' => $this->input->post('phone'),
            'rating' => $this->input->post('rating'),
            'picture'     => $filename
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('dispensaries', $fields);
        $this->session->set_flashdata('confirmtxt',"data has been updated!");       
        redirect('admin/dispensaries/', 'refresh');
    }
}
