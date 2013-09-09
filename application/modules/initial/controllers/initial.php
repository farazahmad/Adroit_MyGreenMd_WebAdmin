<?php 

class Initial extends InitialController {
    
    function Initial(){
      parent::InitialController();
      $this->load->model('pagnav');
      $this->load->model('master');
      $this->smarty->assign('BASE_URL', BASE_URL);
      $this->smarty->assign('JS_PATH', JS_PATH);
      $this->smarty->assign('PATH_UPLOAD', BASE_URL.'static/images/');
      $this->smarty->assign('IMG_URL', IMG_PATH);
      $this->utility->get_info();
   }
     
   function index(){
      $this->smarty->assign('WEBTITLE' , "Home");	
      $this->smarty->assign('active_menu' , "home");	
      $this->smarty->assign('date' , date("d-m-Y"));	
      $this->smarty->display('pages/index.html');
   }
   
   function advertising(){
      $this->smarty->assign('WEBTITLE' , "Advertising");	
      $this->smarty->assign('active_menu' , "advertising");
      
      $query_packages = $this->db->query("SELECT * FROM `packages`");
      $packages = $query_packages->result_array();   
      $this->smarty->assign('packages' , $packages);
      $this->smarty->display('pages/advertising.html');
   }
   
   function contact(){
      $this->smarty->assign('WEBTITLE' , "Contact");
      $this->smarty->assign('active_menu' , "contact");
      
      $data_post = $this->input->post('data');
      $this->smarty->assign('data_post',$data_post);
      $do_send = $this->input->post('save');

      $this->load->plugin('recaptcha');
      $private_key = "6LcqLecSAAAAAMs5zrxq6QvKxl_W1wmA190vo5NT";
      $publickey = "6LcqLecSAAAAAEXMcOTWoBhNfvshZ1-y5xovHPem";
      if(!empty($do_send)){
         $resp = recaptcha_check_answer($private_key,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

          if ($resp->is_valid) {
                $data_contact = array (	
                        'name' => $data_post['name'],
                        'email' => $data_post['email'],
                        'state' => $data_post['state'],
                        'phone' =>$data_post['phone'],
                        'message' =>$data_post['message']
                );
                if($this->db->insert('contacts', $data_contact)){ 
                        $this->smarty->assign('status_submit',"success");
                }else
                {
                        $this->smarty->assign('status_submit',"failed");
                }
          }else{
           $this->smarty->assign('status_submit',"failed_captcha");
          }
      }
      $this->smarty->assign('recaptcha',recaptcha_get_html($publickey));
      $this->smarty->display('pages/contact.html');
   }
      
   function about(){
     $this->content("about_us");
     $this->smarty->assign("link","about");
     $this->smarty->assign("label","About");
     $this->smarty->assign('active_menu' , "about");
     $this->smarty->display('pages/content.html');
   }
      
   function privacy(){
     $this->content("privacy");
     $this->smarty->assign("link","privacy");
     $this->smarty->assign("label","Privacy");
     $this->smarty->display('pages/content.html');  
   }
   
   function terms_and_condition(){
     $this->content("terms");
     $this->smarty->assign("link","terms_and_condition");
     $this->smarty->assign("label","Terms And Conditions");
     $this->smarty->display('pages/content.html');
   }
      
   function content($page_url){
      $query = $this->db->query("SELECT * FROM pages WHERE url='$page_url'");
      if($query->num_rows() > 0){
       $data=$query->row();
       $this->smarty->assign('PAGE_DESCRIPTION', $data->content);
       $this->smarty->assign('METADESC', $data->meta_description);	
       $this->smarty->assign('METAKEY', $data->meta_keywords);
       $this->smarty->assign('WEBTITLE' ,$data->title);		
       $this->smarty->assign('PAGETITLE' ,$data->title);
     }
    }
}