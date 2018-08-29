<?php
class Penyewa_keuangan_model extends App_Model {

    CONST TABLE = 'rsite_penyewa_keuangan';

    function generateNoInvoice()
    {

	    $this->db->select('MAX(id1) as no_invoice');
	    $this->db->from($this->getTable());

	    $last_invoice = $this->db->get()->row()->no_invoice;

	    return str_pad((int)$last_invoice+1, 11,'0',STR_PAD_LEFT);

	}

	function generateNoTagihan($id_rsite_penyewa)
	{
		$this->db->select('MAX(tagihan_ke) as tagihan_ke');
        $this->db->from('rsite_penyewa_keuangan');
        $this->db->where('id_rsite_penyewa', $id_rsite_penyewa);
        $get = $this->db->get();

        return (int)$get->row()->tagihan_ke+1;
	}
}