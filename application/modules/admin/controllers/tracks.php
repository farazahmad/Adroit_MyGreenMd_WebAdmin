<?php

class Tracks extends AdminController {

    function Tracks()
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
        $this->smarty->assign('PAGETITLE' ,WEB_TITLE . ' ADMIN - Tracks');
    }

    function index()
    {
        $this->data_list();

    }

	function data_list()
    {
        //search var session, make session with this var
		$searchVar['session']="tracks";
		//use search sql method here and use {searchVar} for input
		$searchVar['query']="section LIKE '%{searchVar}%' OR activity_type LIKE '%{searchVar}%'";
		$this->pagnav->addSearch($searchVar);
		$getData=$this->pagnav->pagination("","","tracks","","","",ADMIN_PATH."tracks/page/","",$searchVar);		
		$this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
		$this->smarty->assign('list', $rows);
		$this->smarty->assign('data_show', $getData['num_row_total']);
        $this->smarty->display('tracks/list.html');

    }
	
	function page($noPage="1")
    {
        //search var session, make session with this var
		$searchVar['session']="tracks";
		//use search sql method here and use {searchVar} for input
		$searchVar['query']="section LIKE '%{searchVar}%' OR activity_type LIKE '%{searchVar}%'";
		$this->pagnav->addSearch($searchVar);
		$getData=$this->pagnav->pagination($noPage,"","tracks","","","",ADMIN_PATH."tracks/page/","",$searchVar);			
		$this->smarty->assign("pagination", $getData['paging']);
        $rows   = $getData['result'];
		$this->smarty->assign('list', $rows);
		$this->smarty->assign('data_show', $getData['num_row_total']);
        $this->smarty->display('tracks/list.html');
    }
}
