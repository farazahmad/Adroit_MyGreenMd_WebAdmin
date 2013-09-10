<?php

class Payments extends AdminController {

    function Payments()
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
        $this->smarty->assign('PAGETITLE' ,WEB_TITLE . ' ADMIN - Payments');
    }

    function index()
    {
        date_default_timezone_set('America/Denver');
        $years = array();
        $year = date("Y");
        $in = 0;
        for($x=$year;$x<=2050;$x++){
          $years[$in]=$x;
          $in++;
        }
        
        $this->smarty->assign('years', $years);
	$this->all_js->formvalidator(ADMIN_PATH.'payments/do_payment');
        $this->smarty->display('payments/index.html');
    }

    function do_payment()
    {
        $cc_number = $this->input->post('cc_number');
        $expiry_month = $this->input->post('expiry_month');
        $expiry_year = $this->input->post('expiry_year');
        $pin = $this->input->post('pin');
        $amount = $this->input->post('amount');
        
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
            date_default_timezone_set('America/Denver');
            // save the object
            $fields = array (
                'cc_number'  => $cc_number,
                'expiry_month' => $expiry_month,
                'expiry_year' => $expiry_year,
                'pin' => $pin,
                'amount' => $amount,
                'created_at' => date("Y-m-d h:i:s")
            );

           $this->db->insert('payments', $fields);
           $this->session->set_flashdata('confirmtxt',$message);     
        }
    
       redirect('admin/payments/', 'refresh');
    }
}
