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
        $getData=$this->pagnav->pagination("","","push_notifications","","","",ADMIN_PATH."push_notifications/page/","",$searchVar);		
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
        $getData=$this->pagnav->pagination($noPage,"","push_notifications","","","",ADMIN_PATH."push_notifications/page/","",$searchVar);			
        $this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
        $this->smarty->assign('list', $rows);
        $this->smarty->assign('data_show', $getData['num_row_total']);
        $this->smarty->display('packages/index.html');
    }

    function do_push()
    {
        $message = $this->input->post('message');
        // save the object
        $fields = array (
            'message'  => $message,
            'datetime' => date("Y-m-d h:i:s")
        );

        $this->db->insert('push_notifications', $fields);
        $this->session->set_flashdata('confirmtxt',"message has been sent!");       
        redirect('push_notifications/', 'refresh');
    }
    
    function resend( $id )
   {
        $query = $this->db->get_where('push_notifications', array('id' => $id));
	$data=$query->row_array();
        $message = $data['message'];
        $this->session->set_flashdata('confirmtxt',"message has been resend!");       
        redirect('push_notifications/', 'refresh');
   }  
}
