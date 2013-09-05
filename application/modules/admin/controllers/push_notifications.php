<?php

class Push_notifications extends AdminController {

    function Push_notifications()
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
        $this->smarty->assign('PAGETITLE' ,WEB_TITLE . ' ADMIN - Push Notifications');
    }

    function index()
    {
	$this->all_js->formvalidator(ADMIN_PATH.'push_notifications/do_push');
        //search var session, make session with this var
        $searchVar['session']="push_notif";
        //use search sql method here and use {searchVar} for input
        $searchVar['query']="message LIKE '%{searchVar}%'";
        $this->pagnav->addSearch($searchVar);
        $getData=$this->pagnav->pagination("","","push_notifications","id DESC","","",ADMIN_PATH."push_notifications/page/","",$searchVar);		
        $this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
        $this->smarty->assign('list', $rows);
        $this->smarty->assign('data_show', $getData['num_row_total']);
        $this->smarty->display('push_notifications/index.html');
    }
    
	
	function page($noPage="1")
    {
        //search var session, make session with this var
        $searchVar['session']="push_notifications";
        //use search sql method here and use {searchVar} for input
        $searchVar['query']="message LIKE '%{searchVar}%'";
        $this->pagnav->addSearch($searchVar);
        $getData=$this->pagnav->pagination($noPage,"","push_notifications","id DESC","","",ADMIN_PATH."push_notifications/page/","",$searchVar);			
        $this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
        $this->smarty->assign('list', $rows);
        $this->smarty->assign('data_show', $getData['num_row_total']);
        $this->smarty->display('packages/index.html');
    }

    function do_push()
    {
        $warning = "";
        $message = $this->input->post('message');
        // save the object
        $fields = array (
            'message'  => $message,
            'datetime' => date("Y-m-d h:i:s")
        );

        $this->db->insert('push_notifications', $fields);
        $warning=$this->send_notif($message);
        $this->session->set_flashdata('confirmtxt', $warning);       
        redirect('push_notifications/', 'refresh');
    }
    
    function resend( $id )
   {
        $query = $this->db->get_where('push_notifications', array('id' => $id));
	$data=$query->row_array();
        $message = $data['message'];
        $warning=$this->send_notif($message);
        $this->session->set_flashdata('confirmtxt',$warning);       
        redirect('push_notifications/', 'refresh');
   }  
   
   function send_notif($message){
       try {
           //Setup notification message
            $body = array();
            $body['aps'] = array('alert' => $message);
            $body['aps']['notifurl'] = 'http://www.mydomain.com';
            $body['aps']['badge'] = 2;

            //Setup stream (connect to Apple Push Server)
            $ctx = stream_context_create();
            stream_context_set_option($ctx, 'ssl', 'passphrase', PASSPHARSE);
            stream_context_set_option($ctx, 'ssl', 'local_cert', 'MyGreenMDCertificate.pem');
            $fp = stream_socket_client('ssl://'.GATEWAY_URL.':2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
            stream_set_blocking ($fp, 0); 
            // This allows fread() to return right away when there are no errors. But it can also miss errors during 
            //  last  seconds of sending, as there is a delay before error is returned. Workaround is to pause briefly 
            // AFTER sending last notification, and then do one more fread() to see if anything else is there.

            if (!$fp) {
             $warning = "Failed to connect (stream_socket_client): $err $errstrn";
            } else {
            // Keep push alive (waiting for delivery) for 90 days
            $apple_expiry = time() + (90 * 24 * 60 * 60); 

            // Loop thru tokens from database
            $query_device_tokens = $this->db->query("SELECT apple_id,token FROM `device_tokens` ORDER BY id");
            $device_tokens = $query_device_tokens->result_array();      
            foreach($device_tokens as $device_token){
                $apple_identifier = $device_token["apple_id"];
                $deviceToken = $device_token["token"];
                $payload = json_encode($body);

                // Enhanced Notification
                $msg = pack("C", 1) . pack("N", $apple_identifier) . pack("N", $apple_expiry) . pack("n", 32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n", strlen($payload)) . $payload; 

                // SEND PUSH
                fwrite($fp, $msg);

                // We can check if an error has been returned while we are sending, but we also need to 
                // check once more after we are done sending in case there was a delay with error response.
                $this->checkAppleErrorResponse($fp); 
            }

            // Workaround to check if there were any errors during the last seconds of sending.
            // Pause for half a second. 
            // Note I tested this with up to a 5 minute pause, and the error message was still available to be retrieved
            usleep(500000); 

            $warning = $this->checkAppleErrorResponse($fp);

            $warning = 'Completed';
            fclose($fp);

            }
        } catch (Exception $e) {
            $warning = "Something went wrong";
        }
        return $warning;
   }
   
    // FUNCTION to check if there is an error response from Apple
    // Returns TRUE if there was and FALSE if there was not
    function checkAppleErrorResponse($fp) {

        //byte1=always 8, byte2=StatusCode, bytes3,4,5,6=identifier(rowID). 
        // Should return nothing if OK.

        //NOTE: Make sure you set stream_set_blocking($fp, 0) or else fread will pause your script and wait 
        // forever when there is no response to be sent. 

        $apple_error_response = fread($fp, 6);

        if ($apple_error_response) {

        // unpack the error response (first byte 'command" should always be 8)
        $error_response = unpack('Ccommand/Cstatus_code/Nidentifier', $apple_error_response); 

        if ($error_response['status_code'] == '0') {
        $error_response['status_code'] = '0-No errors encountered';

        } else if ($error_response['status_code'] == '1') {
        $error_response['status_code'] = '1-Processing error';

        } else if ($error_response['status_code'] == '2') {
        $error_response['status_code'] = '2-Missing device token';

        } else if ($error_response['status_code'] == '3') {
        $error_response['status_code'] = '3-Missing topic';

        } else if ($error_response['status_code'] == '4') {
        $error_response['status_code'] = '4-Missing payload';

        } else if ($error_response['status_code'] == '5') {
        $error_response['status_code'] = '5-Invalid token size';

        } else if ($error_response['status_code'] == '6') {
        $error_response['status_code'] = '6-Invalid topic size';

        } else if ($error_response['status_code'] == '7') {
        $error_response['status_code'] = '7-Invalid payload size';

        } else if ($error_response['status_code'] == '8') {
        $error_response['status_code'] = '8-Invalid token';

        } else if ($error_response['status_code'] == '255') {
        $error_response['status_code'] = '255-None (unknown)';

        } else {
        $error_response['status_code'] = $error_response['status_code'].'-Not listed';

        }

        echo '<br><b>+ + + + + + ERROR</b> Response Command:<b>' . $error_response['command'] . '</b>&nbsp;&nbsp;&nbsp;Identifier:<b>' . $error_response['identifier'] . '</b>&nbsp;&nbsp;&nbsp;Status:<b>' . $error_response['status_code'] . '</b><br>';

        echo 'Identifier is the rowID (index) in the database that caused the problem, and Apple will disconnect you from server. To continue sending Push Notifications, just start at the next rowID after this Identifier.<br>';

        return true;
        }

       return false;
    }
}
