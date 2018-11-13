<?php
class Rsite_penyewa_model extends App_Model {

    CONST TABLE = 'rsite_penyewa';

    function getTotalTenant()
    {

	    $this->db->select('COUNT(id1) as total_tenant');
	    $this->db->from($this->getTable());

	    return $this->db->get()->row()->total_tenant;

	}

	function getRowsFkAsKey($conn = '', $column = '', $filter = '')
	{
        
        $rs = $this->getRows($conn, $column, $filter);

        $rows = array();
        foreach ( $rs as $key => $v ) 
        {

            $rows[$v['id_rsite']][] = $v;
        
        }

        return $rows;
    }
	
}