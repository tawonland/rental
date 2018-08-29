<?php
class Label_table_model extends App_Model {

	function getlabel($table_name){
		
		$label[$table_name] 				= $table_name;
		$label['rsite_penyewa'] 			= 'Tenant';
		$label['rsite_penyewa_keuangan'] 	= 'Keuangan';
		$label['rsite_pengeluaran'] 		= 'Expenses';

		return $label[$table_name];
	}
}