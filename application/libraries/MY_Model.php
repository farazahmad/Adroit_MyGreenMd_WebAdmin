<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends Model
{
	
	var $_table;

    function MY_Model()
    {
		parent::Model();
	}
	
	function add($info, $table = '')
	{
		if (is_array($info) || is_object($info))
		{
			if (count($info) > 0)
			{
				$this->db->insert(((empty($table)) ? $this->_table : $table), $info);
				return TRUE;
			}
		}
		return FALSE;
	}

	function update($where, $info, $table = '')
	{
		if (is_array($where))
		{
			if (count($where) > 0)
			{
				$this->db->where($where);
				$this->db->update(((empty($table)) ? $this->_table : $table), $info);
				return TRUE;
			}
		}
		return FALSE;
	}

	function delete($where, $table = '')
	{
		if (is_array($where))
		{
			if (count($where) > 0)
			{
				$this->db->where($where);
				$this->db->delete(((empty($table)) ? $this->_table : $table));
				return TRUE;
			}
		}
		return FALSE;
	}

	function simple_count($table = '', $where = '')
	{
		if (is_array($where))
		{
			if (count($where) > 0)
			{
				$this->db->where($where);
			}
		}
		return $this->db->count_all_results(((empty($table)) ? $this->_table : $table));
	}
	

}
