<?php

class Smoke_shops extends AdminController {

    function Smoke_shops()
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
        $this->smarty->assign('PAGETITLE' ,WEB_TITLE . ' ADMIN - Smoke shops');
    }

    function index()
    {
        $this->data_list();

    }

	function data_list()
    {
        //search var session, make session with this var
		$searchVar['session']="smoke_shops";
		//use search sql method here and use {searchVar} for input
		$searchVar['query']="name LIKE '%{searchVar}%' OR description LIKE '%{searchVar}%'";
		$this->pagnav->addSearch($searchVar);
		$getData=$this->pagnav->pagination("","","business","","is_smoke_shop=1","",ADMIN_PATH."smoke_shops/page/","",$searchVar);		
		$this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
		$this->smarty->assign('list', $rows);
		$this->smarty->assign('data_show', $getData['num_row_total']);
        $this->smarty->display('smoke_shops/list.html');

    }
	
	function page($noPage="1")
    {
        //search var session, make session with this var
		$searchVar['session']="smoke_shops";
		//use search sql method here and use {searchVar} for input
		$searchVar['query']="name LIKE '%{searchVar}%' OR description LIKE '%{searchVar}%'";
		$this->pagnav->addSearch($searchVar);
		$getData=$this->pagnav->pagination($noPage,"","business","","is_smoke_shop=1","",ADMIN_PATH."smoke_shops/page/","",$searchVar);			
		$this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
		$this->smarty->assign('list', $rows);
		$this->smarty->assign('data_show', $getData['num_row_total']);
        $this->smarty->display('smoke_shops/list.html');
    }
	
 	function add()
    {
	$this->all_js->formvalidator(ADMIN_PATH.'smoke_shops/do_add');
        $this->smarty->append("add_JS",$this->all_js->addJS("timepicker"));
        $this->smarty->append("InlineJS", '
        $(document).ready(function(){
           $(".time").timepicker(
                            {
                            "step": "30",
                            "minTime": "0:00am",
                            "maxTime": "23:59",
                            "timeFormat": "H:i",
                            }
                    );	
        });					
        ');
        $this->smarty->display('smoke_shops/add.html');
    }

   function edit( $id )
   {
        $query = $this->db->get_where('business', array('id' => $id));
		$this->smarty->assign($query->row_array());
		$data=$query->row_array();
                $this->smarty->append("add_JS",$this->all_js->addJS("timepicker"));
        $this->smarty->append("InlineJS", '
        $(document).ready(function(){
           $(".time").timepicker(
                            {
                            "step": "30",
                            "minTime": "0:00am",
                            "maxTime": "23:59",
                            "timeFormat": "H:i",
                            }
                    );	
            showhide_custom("'.$data["timing"].'");
        });					
        ');
		$this->all_js->formvalidator(ADMIN_PATH.'smoke_shops/do_edit');  
        $this->smarty->display('smoke_shops/edit.html');
   }    
	
    function view( $id  )
    {
        $query  = $this->db->get_where('business', array('id ' => $id ));
		$this->smarty->assign('item',$query->row_array());
        $this->smarty->display('smoke_shops/view.html');
    }	
			
	function delete($id){
		$this->db->delete('business', array('id' => $id));
		$this->session->set_flashdata('errortxt',"data has been deleted!");
		redirect('admin/smoke_shops', 'refresh');
	}
        
    function highlight($id, $value){
        $this->db->where('id', $id);
        $data = 0;
        if($value == "true"){
         $data =1;   
        }
        $this->db->update('business', array ('highlight' => $data));
        $this->session->set_flashdata('confirmtxt',"data has been updated!");
        redirect('admin/smoke_shops', 'refresh');
    }
    
    function featured($id, $value){
        $this->db->where('id', $id);
        $data = 0;
        if($value == "true"){
         $data =1;   
        }
        $this->db->update('business', array ('featured' => $data));
        $this->session->set_flashdata('confirmtxt',"data has been updated!");
        redirect('admin/smoke_shops', 'refresh');
    }


    function do_add()
    {
        $filename='';
        if(!empty($_FILES['uploadImg']['name'])){
            $config['upload_path'] = PATH_UPLOAD."business/";
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
            'is_dispensary' => $this->input->post('is_dispensary'),
            'is_doctor' => $this->input->post('is_doctor'),
            'is_smoke_shop' => $this->input->post('is_smoke_shop'),
            'latitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude'),
            'days_operation' => $this->input->post('days_operation'),
            'custom_timing_sun' => $this->input->post('custom_timing_sun'),
            'custom_timing_mon' => $this->input->post('custom_timing_mon'),
            'custom_timing_tue' => $this->input->post('custom_timing_tue'),
            'custom_timing_wed' => $this->input->post('custom_timing_wed'),
            'custom_timing_thu' => $this->input->post('custom_timing_thu'),
            'custom_timing_fri' => $this->input->post('custom_timing_fri'),
            'custom_timing_sat' => $this->input->post('custom_timing_sat'),
            'custom_timing_sun_end' => $this->input->post('custom_timing_sun_end'),
            'custom_timing_mon_end' => $this->input->post('custom_timing_mon_end'),
            'custom_timing_tue_end' => $this->input->post('custom_timing_tue_end'),
            'custom_timing_wed_end' => $this->input->post('custom_timing_wed_end'),
            'custom_timing_thu_end' => $this->input->post('custom_timing_thu_end'),
            'custom_timing_fri_end' => $this->input->post('custom_timing_fri_end'),
            'custom_timing_sat_end' => $this->input->post('custom_timing_sat_end'),
            'picture'     => $filename
        );

        $this->db->insert('business', $fields);
        $this->session->set_flashdata('confirmtxt',"new data has been added!");       
        redirect('admin/smoke_shops/', 'refresh');
    }

    function do_edit()
    {
        $filename =$this->input->post('picture');
    	if(!empty($_FILES['uploadImg']['name'])){
                $config['upload_path'] = PATH_UPLOAD."business/";
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;
                $config['max_size']	= 0;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('uploadImg')){
                        $add_error=$this->upload->display_errors();
                }else
                {
                        @unlink(PATH_UPLOAD."business/".$filename);
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
            'is_dispensary' => $this->input->post('is_dispensary'),
            'is_doctor' => $this->input->post('is_doctor'),
            'is_smoke_shop' => $this->input->post('is_smoke_shop'),
            'latitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude'),
            'days_operation' => $this->input->post('days_operation'),
            'custom_timing_sun' => $this->input->post('custom_timing_sun'),
            'custom_timing_mon' => $this->input->post('custom_timing_mon'),
            'custom_timing_tue' => $this->input->post('custom_timing_tue'),
            'custom_timing_wed' => $this->input->post('custom_timing_wed'),
            'custom_timing_thu' => $this->input->post('custom_timing_thu'),
            'custom_timing_fri' => $this->input->post('custom_timing_fri'),
            'custom_timing_sat' => $this->input->post('custom_timing_sat'),
            'custom_timing_sun_end' => $this->input->post('custom_timing_sun_end'),
            'custom_timing_mon_end' => $this->input->post('custom_timing_mon_end'),
            'custom_timing_tue_end' => $this->input->post('custom_timing_tue_end'),
            'custom_timing_wed_end' => $this->input->post('custom_timing_wed_end'),
            'custom_timing_thu_end' => $this->input->post('custom_timing_thu_end'),
            'custom_timing_fri_end' => $this->input->post('custom_timing_fri_end'),
            'custom_timing_sat_end' => $this->input->post('custom_timing_sat_end'),
            'picture'     => $filename
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('business', $fields);
        $this->session->set_flashdata('confirmtxt',"data has been updated!");       
        redirect('admin/smoke_shops/', 'refresh');
    }
}
