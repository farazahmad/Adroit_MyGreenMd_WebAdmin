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
      if($this->session->userdata('member_username') != '') {
          $this->smarty->assign('MEMBER_USERID', $this->session->userdata('member_id'));
          $this->smarty->assign('MEMBER_USERNAME', $this->session->userdata('member_username'));
          $this->smarty->assign('MEMBER_LOGGED_IN', true);
        }
   }
     
   function index(){
      $this->smarty->assign('WEBTITLE' , "Home");	
      $this->smarty->assign('active_menu' , "home");	
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
      $this->smarty->assign('WEBTITLE' , "Contact Us");
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
   
   function signup($package_id=""){
      $this->smarty->assign('WEBTITLE' , "Sign Up");
      $this->smarty->assign('active_menu' , "signup");
      date_default_timezone_set('America/Denver');
        $years = array();
        $year = date("Y");
        $in = 0;
        for($x=$year;$x<=2050;$x++){
          $years[$in]=$x;
          $in++;
        }
        
      $this->smarty->assign('years', $years);
        
      $data_post = $this->input->post('data');
      $this->smarty->assign('data_post',$data_post);
      $this->smarty->assign('package_id',$package_id);
      if($package_id){
        $query = $this->db->query("SELECT * FROM packages WHERE id='$package_id'");
        if($query->num_rows() > 0){
          $data=$query->row();
          $this->smarty->assign('price', $data->price);
          $this->smarty->assign('duration', $data->duration);
        }
      }
      $do_send = $this->input->post('save');
      if(!empty($do_send)){
          if($data_post['password'] == $data_post['confirm_password']){
            $cc_number = $data_post['cc_number'];
            $expiry_month = $data_post['expiry_month'];
            $expiry_year = $data_post['expiry_year'];
            $pin = $data_post['pin'];
            $package_id = $data_post['package_id'];
            $amount = 0;
            $query = $this->db->query("SELECT * FROM packages WHERE id='$package_id'");
            if($query->num_rows() > 0){
              $data=$query->row();
              $package_name = $data->name;
              $amount = $data->price;
            }

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
                    "x_description"		=> "MyGreenmD Transaction - ".$package_name." username: ".$data_post['username'],
                    "x_first_name"		=> $data_post['username'],
                    "x_last_name"		=> " ",
                    "x_address"		=> $data_post['address'],
                    "x_state"		=> "",
                    "x_zip"			=> ""
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
               $this->smarty->assign('status_submit',"failed");
               $this->smarty->assign('error_message',$message);
            }else{
                $data_contact = array (	
                        'username' => $data_post['username'],
                        'email' => $data_post['email'],
                        'address' => $data_post['address'],
                        'password' => md5($data_post['password']),
                    'package_id' => $package_id
                );
                if($this->db->insert('members', $data_contact)){ 
                        $this->smarty->assign('status_submit',"success");
                }else
                {
                        $this->smarty->assign('status_submit',"failed");
                }
            }
          }else{
             $this->smarty->assign('status_submit',"failed_password"); 
          }
      }
      $this->smarty->display('pages/signup.html');
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
   
   function signin(){
    	$data_post = $this->input->post('data');
        $this->smarty->assign('data_post',$data_post);
        $do_send = $this->input->post('save');

        if(!empty($do_send)){
           $username = $data_post["username"];
           $password = $data_post["password"];
            $query_user = $this->db->query("SELECT * FROM `members` WHERE username ='$username' And password = md5('$password')");
            if($query_user->num_rows() > 0){
               $login_user = $query_user->first_row();
               $this->session->set_userdata(array("member_id" => $login_user->id, "member_username" => $login_user->username));
               redirect("member");
            }else{
               $this->smarty->assign('status_submit',"failed");
            }
        }
    	$this->smarty->assign('WEBTITLE' , "Login");
    	$this->smarty->display('pages/signin.html');
    }
    
    function signout(){
      $this->session->unset_userdata("member_id");
      $this->session->unset_userdata("member_username");
      redirect(BASE_URL, 'refresh');
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