<?php
class Rsite_penyewa_model extends App_Model {

    CONST TABLE = 'rsite_penyewa';

    function getTotalTenant()
    {

	    $this->db->select('COUNT(id1) as total_tenant');
	    $this->db->from($this->getTable());

	    return $this->db->get()->row()->total_tenant;

	}
	
}