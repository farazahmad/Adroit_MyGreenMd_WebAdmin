<?php

class Initial extends MemberController {

  function Initial() {
    parent::MemberController();
    $this->load->model('pagnav');
    $this->smarty->assign('BASE_URL', BASE_URL);
    $this->smarty->assign('JS_PATH', JS_PATH);
    $this->smarty->assign('PATH_UPLOAD', BASE_URL . 'static/images/');
    $this->smarty->assign('IMG_URL', IMG_PATH);
    $this->smarty->assign('MEMBER_BASE_URL', BASE_URL . 'member/');
    $this->smarty->assign('MEMBER_PATH', MEMBER_PATH);

    if($this->session->userdata('member_username') != '') {
      $this->smarty->assign('MEMBER_USERID', $this->session->userdata('member_id'));
      $this->smarty->assign('MEMBER_USERNAME', $this->session->userdata('member_username'));
      $this->smarty->assign('MEMBER_LOGGED_IN', true);
    } else {
      redirect('signin', 'refresh');
    }
    $this->smarty->append("add_JS",$this->all_js->addJS("rating"));
    $this->smarty->append("InlineJS", '
    $(document).ready(function(){
       $("input.star").rating();
    });					
    '); 
    $this->smarty->assign('WEBTITLE' , "MEMBER AREA");
  }

  function index() {
    $this->smarty->display('members/index.html');
  }
  
  function business() {
    //search var session, make session with this var
    $searchVar['session']="business";
    $member_id=$this->session->userdata('member_id');
    //use search sql method here and use {searchVar} for input
    $searchVar['query']="member_id=$member_id And (name LIKE '%{searchVar}%' OR description LIKE '%{searchVar}%')";
    $this->pagnav->addSearch($searchVar);
    $getData=$this->pagnav->pagination("","","business","","member_id=".$this->session->userdata('member_id'),"",MEMBER_PATH."dispensaries/page/","",$searchVar);		
    $this->smarty->assign("pagination", $getData['paging']);
    $rows   = $getData['result'];
    $this->smarty->assign('list', $rows);
    $this->smarty->assign('data_show', $getData['num_row_total']);
    $this->smarty->display('members/business/list.html');
  }
  
  
 	function add_business()
    {
	$this->all_js->formvalidator(MEMBER_PATH.'do_add_business');
        $this->smarty->display('members/business/add.html');
    }

   function edit_business( $id )
   {
        $query = $this->db->get_where('business', array('id' => $id));
		$this->smarty->assign($query->row_array());
		$data=$query->row_array();
		$this->all_js->formvalidator(MEMBER_PATH.'do_edit_business');  
        $this->smarty->display('members/business/edit.html');
   }    
			
    function delete_business($id){
            $this->db->delete('business', array('id' => $id));
            $this->session->set_flashdata('errortxt',"data has been deleted!");
            redirect(MEMBER_PATH.'business', 'refresh');
    }
        
    function highlight_business($id, $value){
        $this->db->where('id', $id);
        $data = 0;
        if($value == "true"){
         $data =1;   
        }
        $this->db->update('business', array ('highlight' => $data));
        $this->session->set_flashdata('confirmtxt',"data has been updated!");
        redirect(MEMBER_PATH.'business', 'refresh');
    }
    
    function featured_business($id, $value){
        $this->db->where('id', $id);
        $data = 0;
        if($value == "true"){
         $data =1;   
        }
        $this->db->update('business', array ('featured' => $data));
        $this->session->set_flashdata('confirmtxt',"data has been updated!");
        redirect(MEMBER_PATH.'business', 'refresh');
    }


    function do_add_business()
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
            'member_id' => $this->session->userdata('member_id'),
            'picture'     => $filename
        );

        $this->db->insert('business', $fields);
        $this->session->set_flashdata('confirmtxt',"new data has been added!");       
        redirect(MEMBER_PATH.'business', 'refresh');
    }

    function do_edit_business()
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
            'member_id' => $this->session->userdata('member_id'),
            'picture'     => $filename
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('business', $fields);
        $this->session->set_flashdata('confirmtxt',"data has been updated!");       
        redirect(MEMBER_PATH.'business', 'refresh');
    }
    
    
  function deals() {
    //search var session, make session with this var
    $searchVar['session']="member_deals";
    //use search sql method here and use {searchVar} for input
    $member_id=$this->session->userdata('member_id');
    //use search sql method here and use {searchVar} for input
    $searchVar['query']="member_id=$member_id And (name LIKE '%{searchVar}%' OR description LIKE '%{searchVar}%')";
    $this->pagnav->addSearch($searchVar);
    $getData=$this->pagnav->pagination("","","deals","","member_id=".$this->session->userdata('member_id'),"",MEMBER_PATH."deals/page/","",$searchVar);		
    $this->smarty->assign("pagination", $getData['paging']);
    $rows   = $getData['result'];
    $this->smarty->assign('list', $rows);
    $this->smarty->assign('data_show', $getData['num_row_total']);
    $this->smarty->display('members/deals/list.html');
  }
  
  
 	function add_deals()
    {
	$this->all_js->formvalidator(MEMBER_PATH.'do_add_deals');
        $this->smarty->display('members/deals/add.html');
    }

   function edit_deals( $id )
   {
        $query = $this->db->get_where('deals', array('id' => $id));
		$this->smarty->assign($query->row_array());
		$data=$query->row_array();
		$this->all_js->formvalidator(MEMBER_PATH.'do_edit_deals');  
        $this->smarty->display('members/deals/edit.html');
   }    
			
    function delete_deals($id){
            $this->db->delete('deals', array('id' => $id));
            $this->session->set_flashdata('errortxt',"data has been deleted!");
            redirect(MEMBER_PATH.'deals', 'refresh');
    }
        
    function do_add_deals()
    {
        // save the object
        $fields = array (
            'type_name'  => $this->input->post('type_name'),
            'type_id'  => $this->input->post('type_id'),
            'name'  => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'expiry' => $this->input->post('expiry'),
            'member_id' => $this->session->userdata('member_id')
        );

        $this->db->insert('deals', $fields);
        $this->session->set_flashdata('confirmtxt',"new data has been added!");       
        redirect(MEMBER_PATH.'deals', 'refresh');
    }

    function do_edit_deals()
    {
        // save the object
        $fields = array (
            'name'        	=> $this->input->post('name'),
            'description'     => $this->input->post('description'),
            'expiry' => $this->input->post('expiry'),
            'member_id' => $this->session->userdata('member_id')
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('deals', $fields);
        $this->session->set_flashdata('confirmtxt',"data has been updated!");       
        redirect(MEMBER_PATH.'deals', 'refresh');
    }
    
    
    function packages() {
    $member_id = $this->session->userdata('member_id');
    $query = $this->db->get_where('members', array('id' => $member_id));
    $data=$query->row_array();
    $this->smarty->assign('package_id', $data["package_id"]);
    
    $query_price = $this->db->get_where('packages', array('id' => $data["package_id"]));
    $data_price=$query_price->row_array();
    $this->smarty->assign('price', $data_price["price"]);
    
    //search var session, make session with this var
    $searchVar['session']="member_packages";
    //use search sql method here and use {searchVar} for input
    //use search sql method here and use {searchVar} for input
    $searchVar['query']="name LIKE '%{searchVar}%' OR description LIKE '%{searchVar}%'";
    $this->pagnav->addSearch($searchVar);
    $getData=$this->pagnav->pagination("","","packages","","","",MEMBER_PATH."packages/page/","",$searchVar);		
    $this->smarty->assign("pagination", $getData['paging']);
    $rows   = $getData['result'];
    $this->smarty->assign('list', $rows);
    $this->smarty->assign('data_show', $getData['num_row_total']);
    $this->smarty->display('members/packages/list.html');
  }
  
  
     function change_packages($id)
    {
        $query_price = $this->db->get_where('packages', array('id' => $id));
        $data_price=$query_price->row_array();
        $this->smarty->assign('data', $data_price);
    
        date_default_timezone_set('America/Denver');
        $years = array();
        $year = date("Y");
        $in = 0;
        for($x=$year;$x<=2050;$x++){
          $years[$in]=$x;
          $in++;
        }
        
        $this->smarty->assign('years', $years);
        
	$this->all_js->formvalidator(MEMBER_PATH.'do_change_packages');
        $this->smarty->display('members/packages/add.html');
    }

    function do_change_packages()
    {
        $member_id = $this->session->userdata('member_id');
        $cc_number = $this->input->post('cc_number');
        $expiry_month = $this->input->post('expiry_month');
        $expiry_year = $this->input->post('expiry_year');
        $pin = $this->input->post('pin');
        $package_id= $this->input->post('package_id');
        $query_price = $this->db->get_where('packages', array('id' => $package_id));
        $data_price=$query_price->row_array();
        
        $amount = $data_price["price"];
        
        $post_url = AUTHORIZE_URL;

        $post_values = array(

                // the API Login ID and Transaction Key must be replaced with valid values
                "x_login"		=> AUTHORIZE_LOGIN,
                "x_tran_key"		=> AUTHORIZE_TRANS_KEY,
                "x_version"             => "3.1",
                "x_delim_data"		=> "TRUE",
                "x_delim_char"		=> "|",
                "x_relay_response"	=> "FALSE",
                "x_type"                => "AUTH_CAPTURE",
                "x_method"		=> "CC",
                "x_card_num"		=> $cc_number,
                "x_exp_date"		=> $expiry_month.substr($expiry_year, -2),
                "x_amount"		=> $amount,
                "x_description"		=> "My Green MD Transaction",
                "x_first_name"		=> "My Green",
                "x_last_name"		=> "MD",
                "x_address"		=> "1234 Street",
                "x_state"		=> "WA",
                "x_zip"			=> "98004"
        );

        $post_string = "";
        foreach( $post_values as $key => $value )
                { $post_string .= "$key=" . urlencode( $value ) . "&"; }
        $post_string = rtrim( $post_string, "& " );

        $request = curl_init($post_url); // initiate curl object
                curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
                curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
                curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
                curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
                $post_response = curl_exec($request); // execute curl post and store results in $post_response
        curl_close ($request); // close curl object

        $response_array = explode($post_values["x_delim_char"],$post_response);

        // The results are output to the screen in the form of an html numbered list.
        $index = 0;
        $message = "";
        $status_id = "";
        foreach ($response_array as $value)
        {
                if($index == 2){
                    $status_id = $value;
                }
                if($index == 3){
                  $message = $value;
                }
                $index++;
        }
        if($status_id != 1){
           $this->session->set_flashdata('errortxt',$message);    
        }else{
            // save the object
            $fields = array (
                'package_id'        	=> $this->input->post('package_id')
            );

            $this->db->where('id', $member_id);
            $this->db->update('members', $fields);
           $this->session->set_flashdata('confirmtxt',$message);     
        }      
        redirect(MEMBER_PATH.'packages', 'refresh');
    }
}
