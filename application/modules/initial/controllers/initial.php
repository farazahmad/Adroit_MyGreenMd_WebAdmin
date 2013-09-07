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
      $this->smarty->display('pages/index.html');
   }
      
   function about(){
     $this->content("about_us");
     $this->smarty->assign("link","about");
     $this->smarty->assign("label","About");
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