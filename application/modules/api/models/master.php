<?php
/**
 * Description of Mhome
 *
 * @author opq
 */
class Master extends MY_Model {

	var $menus = '';
	var $submenus = '';
    
	function Master()
    {
        parent::MY_Model();
    }

    function get_menu($parent = 'home')
    {
        $query_home = $this->db->get_where('menu', array('parent_menu' => $parent));
		$data = $query_home->result_array();
		
		foreach ($data as $item)
		{
			$menus[] = array('id_menu' => $item['id_menu'],
							 'menu_title' => $item['menu_title'],
							 'menu_title_fk' => strtolower(str_replace(' ','_',$item['menu_title'])),
							 'meta_keywords' => $item['meta_keywords'],
							 'meta_description' => $item['meta_description'],
							 'page_description' => $item['page_description'],
							 'parent_menu' => $item['parent_menu']
							);			
			
		}
		
		$subquery_home = $this->db->get('menu');
		$subdata = $subquery_home->result_array();
		
		foreach ($subdata as $item)
		{
			$submenus[$item['parent_menu']][] = array('id_menu' => $item['id_menu'],
							 'menu_title' => $item['menu_title'],
							 'menu_title_fk' => strtolower(str_replace(' ','_',$item['menu_title'])),
							 'meta_keywords' => $item['meta_keywords'],
							 'meta_description' => $item['meta_description'],
							 'page_description' => $item['page_description'],
							 'parent_menu' => $item['parent_menu']
							);			
			
		}
		
		$this->menus = $menus;
		$this->submenus = $submenus;
    }

}
