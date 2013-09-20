<?php

class Initial extends ApiController {

  function Initial() {
    parent::ApiController();
    $this->load->model('pagnav');
    $this->load->model('master');
    $this->smarty->assign('BASE_URL', BASE_URL);
    $this->smarty->assign('PATH_UPLOAD', BASE_URL.'static/images/');
    $this->smarty->assign('JS_PATH', JS_PATH);
  }

  function index() {
    redirect(BASE_URL, 'refresh');
  }
  
  function dispensaries(){
    #parameter (page, per_page, search)
    $conditions = "";
    $page = ($this->input->post('page') == '')? 0 : $this->input->post('page');
    $per_page = ($this->input->post('per_page') == '')? 10 : $this->input->post('per_page');
    $keyword = $this->input->post('search');
    $conditions = "WHERE is_dispensary=1 ";
    if($keyword){
      $conditions .= " AND (`name`='%$keyword%' OR address='%$keyword%' OR city='%$keyword%' OR state='%$keyword%' OR zip_code='%$keyword%' OR email='%$keyword%' OR website='%$keyword%' OR description='%$keyword%')";
    }
    $query_dispensaries = $this->db->query("SELECT * FROM `business` {$conditions} ORDER BY id LIMIT {$page},{$per_page}");
    $dispensaries = $query_dispensaries->result_array();   
    $total_record = $query_dispensaries->num_rows();
    $body = array();
    //name 	address 	city 	state 	zip_code 	email 	website 	description 	timing 	open_time 	close_time 	phone 	picture 	counter 	rating 	highlight 	featured
    foreach($dispensaries as $data){
        $detail = array();
        $detail['id'] = $data["id"];
        $detail['name'] = $data["name"];
        $detail['address'] = $data["address"];
        $detail['city'] = $data["city"];
        $detail['state'] = $data["state"];
        $detail['zip_code'] = $data["zip_code"];
        $detail['email'] = $data["email"];
        $detail['website'] = $data["website"];
        $detail['description'] = $data["description"];
        $detail['timing'] = $data["timing"];
        $detail['open_time'] = $data["open_time"];
        $detail['close_time'] = $data["close_time"];
        $detail['phone'] = $data["phone"];
        $detail['picture'] = BASE_URL.'static/images/business/'.$data["picture"];
        $detail['counter'] = $data["counter"];
        $detail['rating'] = $data["rating"];
        $detail['latitude'] = $data["latitude"];
        $detail['longitude'] = $data["longitude"];
        $detail['days_operation'] = $data["days_operation"];
        $detail['highlight'] = $data["highlight"];
        $detail['featured'] = $data["featured"];
        $body['dispensaries'][]= $detail;
    }
    $body['page']= $page;
    $body['per_page']= $per_page;
    $body['total_record']= $total_record;
    if($total_record == 0){
        $message = "No Result found";
        $body['message']= $message;
    }
    
    echo json_encode($body);
  }
  
  function doctors(){
    #parameter (page, per_page, search)
      
    $conditions = "";
    $page = ($this->input->post('page') == '')? 0 : $this->input->post('page');
    $per_page = ($this->input->post('per_page') == '')? 10 : $this->input->post('per_page');
    $keyword = $this->input->post('search');
    $conditions = "WHERE is_doctor=1 ";
    if($keyword){
      $conditions .= " AND (`name`='%$keyword%' OR address='%$keyword%' OR city='%$keyword%' OR state='%$keyword%' OR zip_code='%$keyword%' OR email='%$keyword%' OR website='%$keyword%' OR description='%$keyword%')";
    }
    
    $query_doctors = $this->db->query("SELECT * FROM `business` {$conditions} ORDER BY id LIMIT {$page},{$per_page}");
    $doctors = $query_doctors->result_array();    
    $total_record = $query_doctors->num_rows();
    $body = array();
    //name 	address 	city 	state 	zip_code 	email 	website 	description 	timing 	open_time 	close_time 	phone 	picture 	counter 	rating 	highlight 	featured
    foreach($doctors as $data){
        $detail = array();
        $detail['id'] = $data["id"];
        $detail['name'] = $data["name"];
        $detail['address'] = $data["address"];
        $detail['city'] = $data["city"];
        $detail['state'] = $data["state"];
        $detail['zip_code'] = $data["zip_code"];
        $detail['email'] = $data["email"];
        $detail['website'] = $data["website"];
        $detail['description'] = $data["description"];
        $detail['timing'] = $data["timing"];
        $detail['open_time'] = $data["open_time"];
        $detail['close_time'] = $data["close_time"];
        $detail['phone'] = $data["phone"];
        $detail['picture'] = BASE_URL.'static/images/business/'.$data["picture"];
        $detail['counter'] = $data["counter"];
        $detail['rating'] = $data["rating"];
        $detail['latitude'] = $data["latitude"];
        $detail['longitude'] = $data["longitude"];
        $detail['days_operation'] = $data["days_operation"];
        $detail['highlight'] = $data["highlight"];
        $detail['featured'] = $data["featured"];
        $body['doctors'][]= $detail;
    }
    $body['page']= $page;
    $body['per_page']= $per_page;
    $body['total_record']= $total_record;
    if($total_record == 0){
        $message = "No Result found";
        $body['message']= $message;
    }
    echo json_encode($body);
  }
  
  function smoke_shops(){
    #parameter (page, per_page, search)
    $conditions = "";
    $page = ($this->input->post('page') == '')? 0 : $this->input->post('page');
    $per_page = ($this->input->post('per_page') == '')? 10 : $this->input->post('per_page');
    $keyword = $this->input->post('search');
    $conditions = "WHERE is_smoke_shop=1 ";
    if($keyword){
      $conditions .= " AND (`name`='%$keyword%' OR address='%$keyword%' OR city='%$keyword%' OR state='%$keyword%' OR zip_code='%$keyword%' OR email='%$keyword%' OR website='%$keyword%' OR description='%$keyword%')";
    }
    
    $query_smoke_shops = $this->db->query("SELECT * FROM `business` {$conditions} ORDER BY id LIMIT {$page},{$per_page}");
    $smoke_shops = $query_smoke_shops->result_array();      
    $total_record = $query_smoke_shops->num_rows();
    $body = array();
    //name 	address 	city 	state 	zip_code 	email 	website 	description 	timing 	open_time 	close_time 	phone 	picture 	counter 	rating 	highlight 	featured
    foreach($smoke_shops as $data){
        $detail = array();
        $detail['id'] = $data["id"];
        $detail['name'] = $data["name"];
        $detail['address'] = $data["address"];
        $detail['city'] = $data["city"];
        $detail['state'] = $data["state"];
        $detail['zip_code'] = $data["zip_code"];
        $detail['email'] = $data["email"];
        $detail['website'] = $data["website"];
        $detail['description'] = $data["description"];
        $detail['timing'] = $data["timing"];
        $detail['open_time'] = $data["open_time"];
        $detail['close_time'] = $data["close_time"];
        $detail['phone'] = $data["phone"];
        $detail['picture'] = BASE_URL.'static/images/business/'.$data["picture"];
        $detail['counter'] = $data["counter"];
        $detail['rating'] = $data["rating"];
        $detail['latitude'] = $data["latitude"];
        $detail['longitude'] = $data["longitude"];
        $detail['days_operation'] = $data["days_operation"];
        $detail['highlight'] = $data["highlight"];
        $detail['featured'] = $data["featured"];
        $body['smoke_shops'][]= $detail;
    }
    $body['page']= $page;
    $body['per_page']= $per_page;
    $body['total_record']= $total_record;
    if($total_record == 0){
        $message = "No Result found";
        $body['message']= $message;
    }
    echo json_encode($body);
  }
  
  function deals(){
    #parameter (type_deal[all,smoke_shop,dispensary,doctor], type_deal_id, page, per_page, search)
      
    $conditions = "";
    $page = ($this->input->post('page') == '')? 0 : $this->input->post('page');
    $per_page = ($this->input->post('per_page') == '')? 10 : $this->input->post('per_page');
    $type_deal = $this->input->post('type_deal');
    $type_id = $this->input->post('type_deal_id');
    #all smoke_shop dispensary doctor
    if($type_deal == 'smoke_shop' || $type_deal == 'dispensary' || $type_deal == 'doctor'){
      $conditions = "WHERE `type_name` = '{$type_deal}'";
      if($type_id){$conditions .= " AND `type_id` = '{$type_id}'";}
    }
    
    $query_deals = $this->db->query("SELECT * FROM `deals` {$conditions} ORDER BY id LIMIT {$page},{$per_page}");
    $deals = $query_deals->result_array();      
    $total_record = $query_deals->num_rows();
    $body = array();
    //name 	description 	expiry
    foreach($deals as $data){
        $detail = array();
        $deal_for = "";
        $data_query = $this->db->get_where("business", array('id' => $data["type_id"]));
        $deal_for = "";
        if($data_query->num_rows() > 0){
           $data_query = $data_query->row_array();
           $deal_for = $data_query["name"];
        }
        
        $detail['deal_for'] = $deal_for;
        $detail['name'] = $data["name"];
        $detail['description'] = $data["description"];
        $detail['expiry'] = $data["expiry"];
        $body['deals'][]= $detail;
    }
    $body['page']= $page;
    $body['per_page']= $per_page;
    $body['total_record']= $total_record;
    echo json_encode($body);
  }

  function dispensary_detail(){
    $message  = "";
    $success = false;
    $id = $this->input->post('id');
    $detail = array();
    if($id){
       $query = $this->db->get_where("business", array('id' => $id));
        $data = $query->row_array();
        $detail['id'] = $data["id"];
        $detail['name'] = $data["name"];
        $detail['address'] = $data["address"];
        $detail['city'] = $data["city"];
        $detail['state'] = $data["state"];
        $detail['zip_code'] = $data["zip_code"];
        $detail['email'] = $data["email"];
        $detail['website'] = $data["website"];
        $detail['description'] = $data["description"];
        $detail['timing'] = $data["timing"];
        $detail['open_time'] = $data["open_time"];
        $detail['close_time'] = $data["close_time"];
        $detail['phone'] = $data["phone"];
        $detail['picture'] = BASE_URL.'static/images/business/'.$data["picture"];
        $detail['counter'] = $data["counter"];
        $detail['rating'] = $data["rating"];
        $detail['latitude'] = $data["latitude"];
        $detail['longitude'] = $data["longitude"];
        $detail['days_operation'] = $data["days_operation"];
        $detail['highlight'] = $data["highlight"];
        $detail['featured'] = $data["featured"];
        $success = true;
        $this->db->query("UPDATE `business` SET `counter` = `counter` + 1 WHERE `id` ={$id}");
    }else{
        $message  = "Please fill all mandatory fields "; 
    }
    $body['success']= $success;
    $body['message']= $message;
    echo json_encode($detail);
  }
  
  function doctor_detail(){
    $message  = "";
    $success = false;
    $id = $this->input->post('id');
    $detail = array();
    if($id){
       $query = $this->db->get_where("business", array('id' => $id));
        $data = $query->row_array();
        $detail['id'] = $data["id"];
        $detail['name'] = $data["name"];
        $detail['address'] = $data["address"];
        $detail['city'] = $data["city"];
        $detail['state'] = $data["state"];
        $detail['zip_code'] = $data["zip_code"];
        $detail['email'] = $data["email"];
        $detail['website'] = $data["website"];
        $detail['description'] = $data["description"];
        $detail['timing'] = $data["timing"];
        $detail['open_time'] = $data["open_time"];
        $detail['close_time'] = $data["close_time"];
        $detail['phone'] = $data["phone"];
        $detail['picture'] = BASE_URL.'static/images/business/'.$data["picture"];
        $detail['counter'] = $data["counter"];
        $detail['rating'] = $data["rating"];
        $detail['latitude'] = $data["latitude"];
        $detail['longitude'] = $data["longitude"];
        $detail['days_operation'] = $data["days_operation"];
        $detail['highlight'] = $data["highlight"];
        $detail['featured'] = $data["featured"];
        $success = true;
        $this->db->query("UPDATE `business` SET `counter` = `counter` + 1 WHERE `id` ={$id}");
    }else{
        $message  = "Please fill all mandatory fields "; 
    }
    $body['success']= $success;
    $body['message']= $message;
    echo json_encode($detail);
  }
  
  function smoke_shop_detail(){
    $message  = "";
    $success = false;
    $id = $this->input->post('id');
    $detail = array();
    if($id){
       $query = $this->db->get_where("business", array('id' => $id));
        $data = $query->row_array();
        $detail['id'] = $data["id"];
        $detail['name'] = $data["name"];
        $detail['address'] = $data["address"];
        $detail['city'] = $data["city"];
        $detail['state'] = $data["state"];
        $detail['zip_code'] = $data["zip_code"];
        $detail['email'] = $data["email"];
        $detail['website'] = $data["website"];
        $detail['description'] = $data["description"];
        $detail['timing'] = $data["timing"];
        $detail['open_time'] = $data["open_time"];
        $detail['close_time'] = $data["close_time"];
        $detail['phone'] = $data["phone"];
        $detail['picture'] = BASE_URL.'static/images/business/'.$data["picture"];
        $detail['counter'] = $data["counter"];
        $detail['rating'] = $data["rating"];
        $detail['latitude'] = $data["latitude"];
        $detail['longitude'] = $data["longitude"];
        $detail['days_operation'] = $data["days_operation"];
        $detail['highlight'] = $data["highlight"];
        $detail['featured'] = $data["featured"];
        $success = true;
        $this->db->query("UPDATE `business` SET `counter` = `counter` + 1 WHERE `id` ={$id}");
    }else{
        $message  = "Please fill all mandatory fields "; 
    }
    $body['success']= $success;
    $body['message']= $message;
    echo json_encode($detail);
  }
  
  function review(){
    $message  = "";
    $success = false;
    #type_id 	type_name[smoke_shop,dispensary,doctor] 	name 	description 	username 	date
    // save the object
    if($this->input->post('type_name') != '' && $this->input->post('type_id') !='' && $this->input->post('description') !=''){
      if($this->input->post('type_name') == 'smoke_shop' || $this->input->post('type_name') == 'dispensary' || $this->input->post('type_name') == 'doctor'){
          $fields = array (
            'type_name'  => $this->input->post('type_name'),
            'type_id'  => $this->input->post('type_id'),
            'name'  => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'username' => $this->input->post('username'),
            'date' => $this->input->post('date')
          );
          $this->db->insert('reviews', $fields);
          $success = true;
          $message  = "Review successfully added";
      }else{
         $message  = "Type Review not found"; 
      }
    }else{
        $message  = "Please fill all mandatory fields "; 
    }
    $body['success']= $success;
    $body['message']= $message;
    echo json_encode($body);
  }
  
  function claim(){
    $message  = "";
    $success = false;
    #type_id 	type_name[smoke_shop,dispensary,doctor] 	name 	username 	email 	date
    // save the object
    if($this->input->post('type_name') != '' && $this->input->post('type_id') !='' && $this->input->post('name') !=''){
      if($this->input->post('type_name') == 'smoke_shop' || $this->input->post('type_name') == 'dispensary' || $this->input->post('type_name') == 'doctor'){
          // save the object
            $fields = array (
                'type_name'  => $this->input->post('type_name'),
                'type_id'  => $this->input->post('type_id'),
                'name'  => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'date' => $this->input->post('date'),
            );

            $this->db->insert('claims', $fields);
          $success = true;
          $message  = "Claim successfully added";
      }else{
         $message  = "Type Review not found"; 
      }
    }else{
        $message  = "Please fill all mandatory fields "; 
    }
    $body['success']= $success;
    $body['message']= $message;
    echo json_encode($body);
  }
  
  function tracking(){
    $message  = "";
    $success = false;
    #section 	activity_type 	datetime 	ip_address 	username
    // save the object
    if($this->input->post('section') != '' && $this->input->post('activity_type') !='' && $this->input->post('datetime') !=''){
          // save the object
            $fields = array (
                'section'  => $this->input->post('section'),
                'activity_type'  => $this->input->post('activity_type'),
                'datetime'  => $this->input->post('datetime'),
                'ip_address' => $this->input->post('ip_address'),
                'username' => $this->input->post('username')
            );

            $this->db->insert('tracks', $fields);
          $success = true;
          $message  = "Tracking successfully added";
    }else{
        $message  = "Please fill all mandatory fields "; 
    }
    $body['success']= $success;
    $body['message']= $message;
    echo json_encode($body);
  }

}
