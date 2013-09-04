<?php
/**
 * Description of Mhome
 *
 * @author opq
 */
class Menu extends MY_Model {

	
	function Menu()
    {
        parent::MY_Model();
    }
    
	function showmenu(){
		$BASE_PATH_admin=ADMIN_PATH;
		$this->smarty->append("add_JS",$this->all_js->addJS("boxy"));
		$this->smarty->append("add_JS2",$this->all_js->addJS("jmenu_admin"));
		$BASE_URL=BASE_URL;
                $access_page = $this->get_all_page_permission();
		$thisPage=$this->uri->segment(1);
		$this_basePage=base_url().$this->uri->segment(1)."/";
		$InlineJS=<<<END
		$(document).ready(function() {		
			$('#logout').click(function(){
				$('#title_loading').html('Logout, Please Wait..');
				new Boxy($('#loading_on'),
				{modal:true,center:true});
						$.ajax({
						   type: "POST",
						   url: "{$BASE_URL}admin/logout",
						   data: "",
						   success: function(msg){							
						     if(msg=='success'){
								$('#title_loading').css("color","green");
								$('#title_loading').html('Logout Accepted, Redirecting..');	
								window.location='{$BASE_URL}admin/login';
							 }else
							 {
								$('#title_loading').html('Logout Failed! ');	
								//$('.hidden_link').click();
								window.location='{$BASE_URL}$thisPage';
							 }
						   }
						 });
			});
		});
END;
		$this->smarty->append('InlineJS',$InlineJS);
                $MENU = "";
		$MENU.='
<div id="jmenu" class="jquerycssmenu">
<ul>
    <li ><a href="'.$BASE_PATH_admin.'dashboard.html" id="home" class="button_tab">Dashboard</a></li>';
    $MENU.='<li ><a href="'.$BASE_PATH_admin.'tracks" id="tracks" class="button_box">Tracking</a></li>';   
    $MENU.='<li ><a href="'.$BASE_PATH_admin.'dispenseries" id="dispenseries" class="button_box">Dispenseries</a></li>';   
    $MENU.='<li ><a href="'.$BASE_PATH_admin.'doctors" id="doctors" class="button_box">Doctors</a></li>';   
    $MENU.='<li ><a href="'.$BASE_PATH_admin.'smoke_shops" id="smoke_shops" class="button_box">Smoke Shops</a></li>';  
    $MENU.='<li ><a href="'.$BASE_PATH_admin.'payments" id="payment" class="button_frontpage">Payment</a></li>';  
    $MENU.='<li ><a href="'.$BASE_PATH_admin.'push_notifications" id="push_notifications" class="button_frontpage">Push Notifications</a></li>'; 
    $MENU.='<li ><a id="module" class="button_box">Master Data</a><ul>';
      $MENU.='<li ><a href="'.$BASE_PATH_admin.'claims" id="claims" class="button_box">Manage Claims</a></li>'; 
      $MENU.='<li ><a href="'.$BASE_PATH_admin.'packages" id="packages" class="button_box">Packages</a></li>'; 
      $MENU.='<li ><a href="'.$BASE_PATH_admin.'deals" id="deals" class="button_box">Deals</a></li>';  
      $MENU.='<li ><a href="'.$BASE_PATH_admin.'reviews" id="reviews" class="button_box">Reviews</a></li>';  
    $MENU.='</ul></li>';
    $MENU.='<li ><a id="module" class="button_box">Pages</a><ul>';
      $MENU.='<li ><a href="'.$BASE_PATH_admin.'pages/about_us" id="about_us" class="button_frontpage">About Us</a></li>'; 
      $MENU.='<li ><a href="'.$BASE_PATH_admin.'pages/privacy" id="privacy" class="button_frontpage">Privacy & Policy</a></li>'; 
      $MENU.='<li ><a href="'.$BASE_PATH_admin.'pages/terms" id="terms" class="button_frontpage">Terms & Conditions</a></li>'; 
    $MENU.='</ul></li>';
    $MENU.='<li ><a href="'.$BASE_PATH_admin.'account/password.html" id="module" class="button_lockedit">Change Password</a></li>';
    $MENU.='<li><a href="'.$BASE_PATH_admin.'logout" id="logout" class="button_logout">Logout</a></li>';
$MENU.='</ul>
<br style="clear: left" />
</div>';
		
		return $MENU;
	}
	function FormChecked($dt_assign,$data){
		$data2[$data]="checked=\"checked\"";
		$this->smarty->assign($dt_assign, $data2);
	}
	function orderPosition($data){
		$addText="";
		$addText2="<td></td>";
		$addText3="<td></td>";
		$ADMIN_PATH=ADMIN_PATH;
		//check up
		$cek_up = $this->db->query("SELECT id_menu FROM menu WHERE menu_order < '{$data['menu_order']}' AND parent_menu = '{$data['parent_menu']}'");
		if($cek_up->num_rows()>=1){
			$addText2=<<<END
<td width="30" class="right"><a class="buttonLink3 button_upL" href="{$ADMIN_PATH}menu_data/do_order/up/{$data['id_menu']}"></a></td>
END;
			
		}
		//check down
		$cek_down = $this->db->query("SELECT id_menu FROM menu WHERE menu_order > '{$data['menu_order']}' AND parent_menu = '{$data['parent_menu']}'");
		if($cek_down->num_rows()>=1){
			$addText3=<<<END
<td width="30" class="left"><a class="buttonLink3 button_downL" href="{$ADMIN_PATH}menu_data/do_order/down/{$data['id_menu']}"></a></td>
END;
			
		}
		
		$addText=$this->utility->addText($addText,$addText2," ");
		$addText=$this->utility->addText($addText,$addText3," ");		
		return $addText;
	}
	
	function sortData($data, $parent = 0) {
	static $i = 0;
	$tab = str_repeat("&nbsp;&nbsp;|---", $i);
		if (@$data[$parent]) {
			$html = "";
			$i+=1;
			foreach ($data[$parent] as $v) {
				$child = $this->sortData($data, $v["id_menu"]);
				$v['menu_title']=ucfirst($v['menu_title']);
				$v['menu_order']=$this->menu->orderPosition($v);
				if($v['active_status']=="Active"){
					$v['active_status']="<a href=\"".ADMIN_PATH."menu_data/notactive/{$v['id_menu']}\" class=\"Tlink txtgreen\">Active</a>";
				}else
				{
					$v['active_status']="<a href=\"".ADMIN_PATH."menu_data/active/{$v['id_menu']}\" class=\"Tlink txtred\">Not Active</a>";
				}
				if(strlen($v['menu_url'])>25){$v['menu_url']=substr($v['menu_url'],0,25)."...";}
				$ADMIN_PATH=ADMIN_PATH;
				$option_url="";
				if($v['page_url']=="Yes"){
					$option_url=<<<END
					<td width="50">
						<a href="{$ADMIN_PATH}menu_data/edit/{$v['id_menu']}" class="Tlink">Edit</a>
					</td>
					<td width="50">
						<a href="{$ADMIN_PATH}menu_data/page/{$v['id_menu']}" class="Tlink">Edit Page</a>
					</td>
					<td width="50">
						<a href="#" onClick="deleteconfirm('{$ADMIN_PATH}menu_data/delete/{$v['id_menu']}');" class="Tlink">Delete</a>
					</td>

END;
				}else
				{
					$option_url=<<<END
					<td idth="50">
						<a href="{$ADMIN_PATH}menu_data/edit/{$v['id_menu']}" class="Tlink">Edit</a>
					</td>
					<td width="50">
						&nbsp;
					</td>
					<td width="50">
						<a href="#" onClick="deleteconfirm('{$ADMIN_PATH}menu_data/delete/{$v['id_menu']}');" class="Tlink">Delete</a>
					</td>

END;
				}
				$html .= <<<END
						<tr class="trtable2">
							<td >\n&nbsp;$tab{$v['menu_title']}</td>
							<td >{$v['menu_url']}</td>
							<td align="center">{$v['page_url']}</td>
							{$v['menu_order']}
							<td >{$v['position']}</td>
							<td >{$v['active_status']}</td>
							<td width="80" align="center"><a href="{$ADMIN_PATH}menu_data/view/{$v['id_menu']}" class="Tlink">View</a></td>							
							{$option_url}
						</tr>
END;
				if ($child) {
					$i--;
					$html .= $child;
				}
				$html .= '';
			}
			return $html;
		} else {
			return false;
		}
	}
	
	function selectParent($data,$parent = 0,$selData="") {
	static $i = 0;
	$tab = str_repeat("-", $i);
	
		if (@$data[$parent]) {
			//print_r(@$data[$parent]);
			//echo "<br>";
			$html = "";
			$i+=3;
			foreach ($data[$parent] as $v) {
				$child = $this->selectParent($data, $v["id_menu"],$selData);				
				$v['menu_title']=ucfirst($v['menu_title']);
				//echo $v['menu_title']."<br>";
				$sel_status="";
				if($selData==$v['id_menu']){
					$sel_status="selected=\"selected\"";
				}
				$html .= <<<END
						<option value="{$v['id_menu']}" {$sel_status}>$tab {$v['menu_title']}</option>
END;
				if ($child) {
					$i--;
					$html .= $child;
				}
				$html .= '';
			}
			return $html;
		} else {
			return false;
		}
	}
        
        function get_all_page_permission(){
          $query_modules = $this->db->query("SELECT modules.* FROM modules");
          $data_modules = $query_modules->result_array();
          $array_response = array();
          foreach ($data_modules as $module){
            $read = false;
            $write = false;
            $delete = false;
            $module_id = $module["id"];
            $tmp_nm = preg_replace("/[^a-zA-Z0-9\s]/", "", $module["name"]);
            $module_name = strtolower(str_replace(" ", "_", $tmp_nm));
            $role_id = $this->session->userdata('role_id');
            
            $query_role = $this->db->get_where('role_modules', array('role_id' => $role_id, 'module_id' => $module_id));
            if($query_role->num_rows() > 0){
              $data_role=$query_role->row_array();
              $read = (($data_role["read"] == 1)? true : false);
              $write = (($data_role["write"] == 1)? true : false);
              $delete = (($data_role["delete"] == 1)? true : false);
            }
            $array_response[$module_name] = array('read' => $read, 'write' => $write, 'delete' => $delete);
          }
          return $array_response;
        }
        
        function get_page_permission($page){
          $query = $this->db->get_where('modules', array('name' => $page));
          $read = false;
          $write = false;
          $delete = false;
          if($query->num_rows() > 0){
            $data=$query->row_array();
            $module_id = $data["id"];
            $role_id = $this->session->userdata('role_id');
            
            $query_role = $this->db->get_where('role_modules', array('role_id' => $role_id, 'module_id' => $module_id));
            if($query_role->num_rows() > 0){
              $data_role=$query_role->row_array();
              $read = (($data_role["read"] == 1)? true : false);
              $write = (($data_role["write"] == 1)? true : false);
              $delete = (($data_role["delete"] == 1)? true : false);
            }
          }
	  return array('read' => $read, 'write' => $write, 'delete' => $delete);
        }
        
        function check_read_access($access, $redirect){
          if($access["read"] == 1){
            return true;
          }else{
            $this->session->set_flashdata('errortxt',"You don't have access for this page!");       
            redirect($redirect, 'refresh');
          }
        }
        
        function check_write_access($access, $redirect){
         if($access["write"] == 1){
            return true;
          }else{
            $this->session->set_flashdata('errortxt',"You don't have write access for this page!");       
         redirect($redirect, 'refresh');
          }
        }
        
        function check_delete_access($access, $redirect){
          if($access["delete"] == 1){
            return true;
          }else{
            $this->session->set_flashdata('errortxt',"You don't have delete access for this page!");       
            redirect($redirect, 'refresh');
          }
        }
}
