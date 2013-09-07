<?php
/**
 * Description of Mstatic
 *
 * @author wiz
 */
class Menu extends MY_Model {
	    
	function Menu()
    {
        parent::MY_Model();
    }

	
	function get_top_menu()
	{		
			$query = $this->db->query("SELECT * FROM menu WHERE active_status='Active' AND position LIKE '%top%' AND parent_menu = '0' ORDER BY menu_order");
			if ($query->num_rows() > 0)
			{
				return $query->result_array();
			}
			unset($query);
		
		return FALSE;
	}
	function get_useplugin($varx){
		$query = $this->db->query("SELECT menu_url FROM menu WHERE active_status='Active' AND use_plugin = '$varx'");
			if ($query->num_rows() > 0)
			{
				return $query->row();
			}
			unset($query);
		
		return FALSE;	
	}	
}
