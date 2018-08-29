<?php
class Tlogin_model extends App_Model {

    CONST TABLE = 'tlogin';

    function get_user($username)
	{
		$where = array('uname' => $username);
		$query = $this->db->where($where)->get(static::getTable());
		
		return $query->row();
	}
	
}